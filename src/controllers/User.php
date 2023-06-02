<?php
namespace Controllers;

use App\Repository\UserRepository;
use Models\Builders\UserBuilder;
use mysql_xdevapi\Exception;
use Router;

class User extends Controller {

    public function findAll(){
        $userRepo = new UserRepository();
        $users = $userRepo->findAll();
        $response = [];

        if ($users) {
            foreach ($users as $user) {
                $response[] = $user->toArray();
            }
            http_response_code(200);
            echo json_encode($response);

        } else {
            http_response_code(404);
            echo json_encode([
                'error' => 'Utilisateur non trouvé.'
            ]);
        }
    }

    public function find(int $id)
    {
        $userRepo = new UserRepository();
        $user = $userRepo->find($id);
        if ($user) {
            http_response_code(200);
            echo json_encode($user->toArray());

        } else {
            http_response_code(404);
            echo json_encode([
                'error' => 'Utilisateur non trouvé.'
            ]);
        }
    }

    public function delete($id) {
        $userRepo = new UserRepository();
        try{
            $userRepo->remove($id);
            http_response_code(200);
        }catch(Exception $e) {
            http_response_code(500);
        }
    }

    public function edit($id)
    {
        $userRepo = new UserRepository();
        $request = getRequest();
        $user = $userRepo->find($id);
        if (!$user) {
            http_response_code(404);
            echo json_encode('Utilisateur non trouvé.');
        }

        if(isset($request['name']) && isset($request['email']) && isset($request['password'])){
            $errors = $this->validateFormFields($request);
            if(!empty($errors)) {
                http_response_code(400);
                echo json_encode($errors);
            }
            else {
                $userBuilder = new UserBuilder();
                $user = $userBuilder
                    ->setId($id)
                    ->setName($request['name'])
                    ->setEmail($request['email'])
                    ->setPassword($request['password'])
                    ->setIsAdmin($request['isAdmin'])
                    ->setAvatar($request['avatar'] ?? '')
                    ->build();
                try {
                    $userRepo->update($user);
                    http_response_code(200);
                    echo json_encode($user->toArray());
                } catch (Exception $e) {
                    http_response_code(500);
                }
            }
        }
    }

    public function create()
    {
        $userRepo = new UserRepository();
        $request = getRequest();

        if(isset($request['name']) && isset($request['email']) && isset($request['password'])){

            $errors = $this->validateFormFields($request);
            if(!empty($errors)) {
                http_response_code(400);
                echo json_encode($errors);
            }
            else {
                $userBuilder = new UserBuilder();
                $user = $userBuilder
                    ->setId(-1)
                    ->setName($request['name'])
                    ->setEmail($request['email'])
                    ->setPassword($request['password'])
                    ->setIsAdmin($request['isAdmin'])
                    ->setAvatar($request['avatar'] ?? '')
                    ->build();

                try {
                    http_response_code(200);
                    $user = $userRepo->persist($user);
                    echo json_encode($user->toArray());
                } catch (Exception $e) {
                    http_response_code(500);
                }
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