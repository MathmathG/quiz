<?php
namespace Oquiz\Controllers;

use\Oquiz\Models\UserModel;
use\Oquiz\Utils\User;


class UserController extends CoreController{

    public function signup(){
        $errorList = array();

        if (!empty($_POST)){
        $first_name = isset($_POST['first_name']) ? trim($_POST['first_name']) : '';
        $last_name = isset($_POST['last_name']) ? trim($_POST['last_name']) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';
        $confirmPassword = isset($_POST['confirmPassword']) ? trim($_POST['confirmPassword']) : '';

        $first_name = htmlentities($first_name);
        $last_name = htmlentities($last_name);



        if (empty($first_name)){
            $errorList[] = 'Le nom doit être renseignée';
        }
        if (empty($last_name)){
            $errorList[] = 'Le prénom doit être renseignée';
        }

        if (empty($email)) {
                $errorList[] = 'L\'adresse email doit être renseignée';
            }
            // Vérfification par un filtre de PHP que l'email est correct
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $errorList[] = 'L\'adresse email n\'est pas correcte';
            }

        if (empty($password)) {
                $errorList[] = 'Le mot de passe doit être renseigné';
            }
            if ($password != $confirmPassword) {
                $errorList[] = 'Les 2 mots de passe doivent être égaux';
            }
            if (strlen($password) < 8) {
                $errorList[] = 'Le mot de passe doit faire au moins 8 caractères';
            }

                // J'encode, je hash le mot de passe avant de le stocker en DB
                if (count($errorList) == 0){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                // Pour sauvegarder en DB, je dois d'abord créer le Model
                $userModel = new UserModel();
                // Puis donner une valeur à chaque propriété (besoin des setters)
                $userModel->setFirst_name($first_name);
                $userModel->setLast_name($last_name);
                $userModel->setEmail($email);
                $userModel->setPassword($hash);

                $insertedRows = $userModel->save();

                if ($insertedRows > 0){
                    $this->redirectToRoute('main_home');
                }
                else {
                    $errorList[] = 'Erreur dans l\'ajout à la DB';
                }
            }
        }
        echo $this->templates->render('user/signup', [
            'errorList' => $errorList
        ]);
    }

    public function signin(){

        $errorList = array();

        if (!empty($_POST)){
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';

        if (empty($email)) {
                $errorList[] = 'L\'adresse email doit être renseignée';
            }

        if (empty($password)) {
                $errorList[] = 'Le mot de passe doit être renseigné';
            }

        if (count($errorList) == 0){

                $userModel = new UserModel;
                $userModel->setEmail($email);
                $userModel->setPassword($password);

                //On stock le user en session
                $_SESSION['user'] = $userModel;
                if (count($errorList) == 0) {
                    // Je peux rediriger car tout est ok
                    $this->redirectToRoute('main_home');

                }
                else {
                    $errorList[] = 'Erreur dans l\'ajout à la DB';
                }
                }
                }
        echo $this->templates->render('user/signin');
    }


    public function login(){
        $userModel = new UserModel;
        $userList = $userModel->findAll();
        //dump($userList);
        //exit;
        $connectedUser = User::getUser();

        if ($connectedUser !== false) {
            echo $this->templates->render('user/login',
        [
        'userList'=>$userList
    ]);

    }
      }
    public function logout() {
        // On doit être connecté pour se déconnecter
        if (User::isConnected()) {
            // On appelle la méthode de la librairie User, permettant de déconnecter
            User::logout();

            // Puis je redirige vers la home
            $this->redirectToRoute('main_home');
        }
        else {
            // Utilisateur non connecté => redirection vers la page de connexion
            $this->redirectToRoute('main_signin');
        }
    }


}
