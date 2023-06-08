<?php
namespace Controllers;
use App\Repository\UserRepository;
use Models\Builders\UserBuilder;
use Models\User;

class Profil extends Controller
{
    public function Index() {
        $user = getConnectedUser();
        $data = [
          'title' => 'Are you blinded ?',
          'user' => $user
        ];

        $this->view('profil', $data);
    }

    public function edit()
    {
        $userRepo = new UserRepository();
        $request = getPostRequest();
        $userId = $request['id'];
        $user = $userRepo->find($userId);

        if (!$user) {
            http_response_code(404);
            echo json_encode('Utilisateur non trouvé.');
            return;
        }

        if (isset($request['name']) && isset($request['email']) && isset($request['password'])) {
            $errors = $this->validateFormFields($request);
            if (!empty($errors)) {
                http_response_code(400);
                echo json_encode($errors);
                return;
            }

            if ($request['password']!= $user->getPassword()) {
                $Password = password_hash($request['password'], PASSWORD_BCRYPT);
                // Mettez à jour le mot de passe hashé dans votre logique de mise à jour de l'utilisateur
            }            
            else
                $Password = $user->getPassword();
            
            $userBuilder = new UserBuilder();
            $updatedUser = $userBuilder
                ->setId($user->getId())
                ->setName($request['name'])
                ->setEmail($request['email'])
                ->setPassword($Password)
                ->setIsAdmin($user->isAdmin())
                ->setAvatar($user->getAvatar())
                ->build();

            try {
                $userRepo->update($updatedUser);
                
                http_response_code(200);
                redirect('/profil');
                //echo json_encode($updatedUser->toArray());
            } catch (Exception $e) {
                http_response_code(500);
            }
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

        return $errors;
    }
    
}