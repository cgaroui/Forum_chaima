<?php
namespace Controller;

// session_start();

use App\AbstractController;
use Model\Managers\UserManager;
use App\Session;

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

                header('Location: index.php?ctrl=security&action=login');exit(); //redirection vers ma page de connexion(login)
     
            }else {
                    // Vérifier si les mots de passe correspondent et sont suffisamment longs
                    if ($pass1 === $pass2 && strlen($pass1) >= 5) {

                        $mdpHache = password_hash($pass1, PASSWORD_DEFAULT);

                         $userManager->add([
                            "nickname" => $nickname,
                            "email"=> $email,
                            "password" => $mdpHache,
                            "role" => "user"
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
    public function login () {

        $userManager = new UserManager();

        if(isset($_POST["submit"])){
          
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST,'password', FILTER_SANITIZE_SPECIAL_CHARS);

            //je vérifie si mes données ont bien été renseigné 
            if( $email && $password){ 
                //verifier si l'utilisateur existe deja avec son email
                $user = $userManager->getByEmail($email);
                
                if($user){
                    //on verifie si le mdp entréé est le mm que celui en bdd
                    $hash = $user->getPassword();
                    //$hash représente le mot de passe haché stocké en base de données, et $password est le mot de passe saisi dans le formulaire. password_verify vérifie si les deux mots de passe correspondent
                    if(password_verify($password, $hash)){
                        // var_dump("okh");die;
                        $_SESSION['user'] = $user;
                        echo "bienvenu ".$user->getNickName();

                        header("Location: index.php?ctrl=home&action=home"); exit;
                   }else{
                        echo "identifiant ou mot de passe incorrect !";
                   }

                }else{
                    echo "utilisateur inconu";
                    header("Location: index.php?ctrl=security&action=register");exit();
                }
            }else{
                echo " une erreur s'est produite lors de la saisie ";
            }
        }else {
            return [
                "view" => VIEW_DIR . "forum/login.php",
                "meta_description" => "login",];

        }

    }
    public function logout () {
        
        unset($_SESSION["user"]);
        header("Location: index.php?ctrl=security&action=login");exit();
    }


    // public function profile ($id){
    //     $userManager = new UserManager();
    //     //afficher informations personnelles 
    //     //afficher ses 5 dernier topics du plus order by desc
    //     $user = Session::getUser();
    //     var_dump($user);
    //     $pseudo = $user->getNickname();
    //     $email = $user->getEmail(); 
    //     $inscription = $user->getCreationDate();
    
    //     header("Location: index.php?ctrl=security&action=profile=$id");

    // }
    public function profile() {
    
    
        $userManager = new UserManager();
    
        // Récupérer les informations de l'utilisateur connecté
        $user = Session::getUser();
        $userId = $user->getId();
  
            
            
   
        
        // Afficher les informations personnelles de l'utilisateur
        $pseudo = $user->getNickname();
        $email = $user->getEmail();
        $inscription = $user->getCreationDate(); 
    
        // Récupérer les 5 derniers topics de l'utilisateur, triés par date de création décroissante
    //     $topics[] = $userManager->getLastFiveTopics($userId);
    // var_dump($topics);die;
        // Inclure la vue du profil utilisateur
      
        header("Location: index.php?ctrl=security&action=profile");
    }
    

}



























