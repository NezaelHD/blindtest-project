<?php
namespace Controllers;

use App\Repository\UserRepository;
use Models\User;

class Auth extends Controller
{

    public function registerIndex() {
        $this->view('register');
    }

    public function loginIndex() {
        $this->view('login.css');
    }

    public function register() {
        $userRepo = new UserRepository();
        $request = getPostRequest();

        if(isset($request['name']) && isset($request['email']) && isset($request['password']) && isset($request['confirm-password'])){
            $errors = $this->validateFormFields($request);
            if(!empty($errors)) {
                http_response_code(400);
                $this->view('register', $errors);
            }
            else {
                $user = new User($request['email'], $request['name'], $request['password'] , false, '', -1);
                $userRepo->persist($user);
                redirect('/login.css');
                exit;
            }
        }
    }

    public function login() {
        $request = getPostRequest();
        $userRepo = new UserRepository();

        if(isset($request['email']) && isset($request['password'])){
            $user = $userRepo->findBy('email', $request['email'])[0];
            if(password_verify($request['password'], $user->getPassword())){
                $_SESSION['logged_in'] = true;
                $_SESSION['user'] = $user->toArray();
                redirect('/');
            }
            else {
                $this->view('login.css', ['bad-password' => "Identifiants incorrect."]);
            }
        }
    }

    public function logout() {
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

        redirect('/login.css');
        exit;
    }


    private function validateFormFields($request){
        $errors = array();

        if(!filter_var($request['email'], FILTER_VALIDATE_EMAIL)){
            $errors['email'] = "Le format de l'email est incorrect.";
        }
        if (strlen($request['password']) < 6) {
            $errors['password'] = "Le mot de passe n'est pas assez long, il doit faire 6 caractères ou plus.";
        }
        if($request['password'] !== $request['confirm-password']) {
            $errors['confirm-password'] = "Les deux mots de passes rentré sont différents.";
        }

        return $errors;
    }
}