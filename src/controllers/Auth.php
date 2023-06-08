<?php

namespace Controllers;

use App\Repository\ResetPasswordRepository;
use App\Repository\UserRepository;
use Models\Builders\ResetPasswordBuilder;
use Models\Builders\UserBuilder;
use Models\User;
use mysql_xdevapi\Exception;

class Auth extends Controller
{

    public function registerIndex()
    {
        $this->view('register');
    }

    public function loginIndex()
    {
        $this->view('login');
    }

    public function register()
    {
        $userRepo = new UserRepository();
        $request = getPostRequest();

        if (isset($request['name']) && isset($request['email']) && isset($request['password']) && isset($request['confirm-password'])) {
            $errors = $this->validateFormFields($request);
            if (!empty($errors)) {
                http_response_code(400);
                $this->view('register', $errors);
            } else {
                $user = new User($request['email'], $request['name'], $request['password'], false, '', -1);
                $userRepo->persist($user);
                redirect('/login');
                exit;
            }
        }
    }

    public function login()
    {
        $request = getPostRequest();
        $userRepo = new UserRepository();

        if (isset($request['email']) && isset($request['password'])) {
            $user = $userRepo->findBy('email', $request['email'])[0];
            if (password_verify($request['password'], $user->getPassword())) {
                $_SESSION['logged_in'] = true;
                $_SESSION['user'] = $user->toArray();
                redirect('/');
            } else {
                $this->view('login', ['bad-password' => "Identifiants incorrect."]);
            }
        }
    }

    public function logout()
    {
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();

        redirect('/login');
        exit;
    }

    public function resetPassword()
    {
        $request = getPostRequest();

        if($request) {
            $builder = new ResetPasswordBuilder();
            $resetPwdRepo = new ResetPasswordRepository();

            $userEmail = $request["email"];
            $selector = bin2hex(random_bytes(8));
            $token = random_bytes(32);
            $expires = date("U") + 1800;
            $hashedToken = password_hash(bin2hex($token), PASSWORD_DEFAULT);

            $resetPwd = $builder->setEmail($userEmail)->setSelector($selector)->setToken($hashedToken)->setExpires($expires)->build();

            $url = getUrl();
            $urlReset = $url."/createNewPassword/" . $selector . "/" . bin2hex($token);

            try{
                $resetPwdRepo->removeBy('user_email', $userEmail);
                $resetPwdRepo->persist($resetPwd);
            }catch(Exception $e){
                $this->view('resetPass', [
                    'isSuccess'=>false,
                ]);
            }

            $to = $userEmail;

            $subject = mb_encode_mimeheader('Réinitialisez votre mot de passe pour Are You Blinded ?', 'UTF-8');

            $message = '<p>Nous avons reçu votre demande de réinitialisation de mot de passe. Si vous n\'avez pas fait cette demande vous pouvez ignorer cet email.</p>';
            $message .= '<p> Voici votre lien de réinitialisation : </br>';
            $message .= '<a href="'.$urlReset.'">'.$urlReset.'</a></p>';

            $headers = "From : Are You Blinded <info@areyoublinded.alawaysdata.net>\r\n";
            $headers .= "Reply-To : info@areyoublinded.alawaysdata.net\r\n";
            $headers .= "Content-type: text/html\r\n";
            $headers .= "MIME-Version: 1.0\r\n";

            mail($to, $subject, $message, $headers);

            $this->view('resetPass', [
                'isSuccess'=>true,
            ]);
        } else {
            $this->view('resetPass');
        }
    }

    public function createNewPassword($selector, $validator)
    {
        $this->view('createNewPassword', [
            'selector' => $selector,
            'validator' => $validator,
        ]);
    }

    public function createNewPasswordTreatment()
    {
        $request = getPostRequest();
        $resetPwdRepo = new ResetPasswordRepository();
        $userRepo = new UserRepository();
        $builder = new UserBuilder();

        $selector = $request["selector"];
        $validator = $request["validator"];

        if (empty($selector)||empty($validator)){
            echo "Could not validate your request!";
        } else {
            if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){
                $this->view('createNewPassword');
            }
        }
        if ($request){
            $selector = $request["selector"];
            $validator = $request["validator"];
            $password = $request["pwd"];
            $passwordRepeat = $request["pwd-repeat"];

            if (empty($password)||empty($passwordRepeat)){
                $this->view('createNewPassword', [
                    'pwdEmpty'=>true,
                    'pwdNotMatched'=>false,
                    'isSuccess'=>false,
                ]);
            }
            else if ($password != $passwordRepeat){
                $this->view('createNewPassword', [
                    'pwdEmpty'=>false,
                    'pwdNotMatched'=>true,
                    'isSuccess'=>false,
                ]);
            }
                $resetPassword = $resetPwdRepo->findBy('selector',$selector);
                $resetPassword = $resetPassword[0];
                $tokenCheck = password_verify($validator, $resetPassword->getToken());
                if ($tokenCheck === false){
                    echo "Vous devez soumettre une nouvelle demande de réinitialisation de mot de passe.";
                    exit();
                }
                elseif ($tokenCheck === true) {
                    $tokenEmail = $resetPassword->getEmail();
                    $userToModify = $userRepo->findBy('email', $tokenEmail);
                    $userToModify = $userToModify[0];
                    $newPwdHash = hashPassword($password);
                    $newUser = $builder
                        ->setPassword($newPwdHash)
                        ->setId($userToModify->getId())
                        ->setName($userToModify->getName())
                        ->setEmail($userToModify->getEmail())
                        ->setAvatar($userToModify->getAvatar())
                        ->setIsAdmin($userToModify->isAdmin())
                        ->build();
                    $userRepo->update($newUser);
                    $resetPwdRepo->removeBy('user_email',$tokenEmail);
                    $this->view('createNewPassword', [
                        'pwdEmpty'=>false,
                        'pwdNotMatched'=>false,
                        'isSuccess'=>true,
                    ]);
                }
        }
        else {
            $this->view('/');
        }
    }


    private function validateFormFields($request)
    {
        $errors = array();

        if (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Le format de l'email est incorrect.";
        }
        if (strlen($request['password']) < 6) {
            $errors['password'] = "Le mot de passe n'est pas assez long, il doit faire 6 caractères ou plus.";
        }
        if ($request['password'] !== $request['confirm-password']) {
            $errors['confirm-password'] = "Les deux mots de passes rentré sont différents.";
        }

        return $errors;
    }
}