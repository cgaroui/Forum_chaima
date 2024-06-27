<?php
namespace Controller;

use App\AbstractController;
use Model\Managers\UserManager;

class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    
    public function register() {

        $userManager = new UserManager();
        //si je soumet le formulaire 
        if(isset($_POST["submit"])) {  

            // Filtrer la saisie des champs 
           $nickname = filter_input(INPUT_POST, 'nickname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
           $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
           $pass1 = filter_input(INPUT_POST, 'password1', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
           $pass2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

           if ($nickname && $email && $pass1 && $pass2) {
                $user = $userManager->getByEmail($email);

               // Vérifier si l'utilisateur existe déjà
            if ($user) {

                header('Location: login.php');exit(); //redirection vers ma page de connexion(login)
     
            }else {
                    // Vérifier si les mots de passe correspondent et sont suffisamment longs
                    if ($pass1 === $pass2 && strlen($pass1) >= 5) {

                        $mdpHache = password_hash($pass1, PASSWORD_DEFAULT);

                         $userManager->add([
                            "nickname" => $nickname,
                            "email"=> $email,
                            "password" => $mdpHache,
                            "role" => "admin"
                        ]);

                        header("Location: index.php?ctrl=security&action=register");
                           
                    } else {
                        echo "Les mots de passe ne sont pas identiques ou sont trop courts";
                    }
                } } else {
                
                echo "Problème de saisie dans les champs du formulaire.";
            }
             
        } else {
            
            return [
                "view" => VIEW_DIR . "forum/register.php",
                "meta_description" => "Register",
                // "data" => [         
                //     "nickname" => $nickname,
                //     "email"=> $email,
                //     "password" => $mdpHache 
                // ]
            ];
            // header("Location: index.php?ctrl=security&action=register");
        }

        
    }
    public function login () {}
    public function logout () {}
}