<?php
namespace Controller;

use App\AbstractController;
use Model\Managers\UserManager;

class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    
    public function register() {

        
        $userManager = new UserManager;
        //si je soumet le formulaire 
        if(isset($_POST["submit"])) {
            // Filtrer la saisie des champs 
            $nickname = filter_input(INPUT_POST, 'nickname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $pass1 = filter_input(INPUT_POST, 'pass1', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pass2 = filter_input(INPUT_POST, 'pass2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if ($nickname && $email && $pass1 && $pass2) {
                // Vérifier si l'utilisateur existe déjà
                $user = $userManager->getByEmail($email);
                
                if ($user) {
                    header('Location: login.php');
                    exit();
                } else {
                    // Vérifier si les mots de passe correspondent et sont suffisamment longs
                    if ($pass1 === $pass2 && strlen($pass1) >= 5) {
                        $user = new user($nickname, $email, $pass1);
                        if ($userManager->nvUser($user)) {
                            header('Location: login.php');
                            exit();
                        } else {
                            echo "Erreur lors de l'inscription";
                        }
                    } else {
                        echo "Les mots de passe ne sont pas identiques ou sont trop courts";
                    }
                }
            } else {
                echo "Problème de saisie dans les champs du formulaire.";
            }
        } else {
            // Affichage du formulaire d'inscription
            header("Location: view/forum/register.php");
        }
    }
    public function login () {}
    public function logout () {}
}