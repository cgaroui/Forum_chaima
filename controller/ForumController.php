<?php
namespace Controller;

use App\Session;
use App\DAO;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;


class ForumController extends AbstractController implements ControllerInterface{

    public function index() {
        
        // créer une nouvelle instance de CategoryManager
        $categoryManager = new CategoryManager();
        // récupérer la liste de toutes les catégories grâce à la méthode findAll de Manager.php (triés par nom)
        $categories = $categoryManager->findAll(["name", "ASC"]);

        // le controller communique avec la vue "listCategories" (view) pour lui envoyer la liste des catégories (data)
        return [
            "view" => VIEW_DIR."forum/listCategories.php",
            "meta_description" => "Liste des catégories du forum",
            "data" => [
                "categories" => $categories
            ]
        ];
    }

    public function listTopicsByCategory($id) {

        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();
        $category = $categoryManager->findOneById($id);
        $topics = $topicManager->findTopicsByCategory($id);

        return [
            "view" => VIEW_DIR."forum/listTopics.php",
            "meta_description" => "Liste des topics par catégorie : ".$category,
            "data" => [
                "category" => $category,
                "topics" => $topics,
            ]
        ];
    }

    public function listPostsByTopic($id) {
        $topicManager = new TopicManager();
        $postManager = new PostManager();
        
        $topic = $topicManager->findOneById($id); // pour récupérer le topic spécifique
        $posts = $postManager->findPostsByTopic($id); // pour récupérer les posts associés à ce topic
        
        return [
            "view" => VIEW_DIR . "forum/listPosts.php",
            "meta_description" => "Affichage des posts du topic : " . $topic->getTitle(),
            "data" => [
                "topic" => $topic,
                "posts" => $posts
            ]
        ];
    }

    // $id = id du topic dans lequel on ajoute le post
    public function addPost($id) {

        $postManager = new PostManager();

        // si je soumet le formulaire
        if(isset($_POST["submit"])) {
            
            // faille XSS
            $post = filter_input(INPUT_POST, "post", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            // on utilise la methode add qui est predefini dans le Framework pour éviter de mettre select etc.. donc un tableau : "nom dans la bdd" => $nom de la var dans le controleur 
            if($post) {
                $postManager->add([
                    "text" => $post,
                    "user_id" => Session::getUser()->getId(),
                    "topic_id" => $id
                ]);

                header("Location: index.php?ctrl=forum&action=listPostsByTopic&id=$id");// redirection vers la meme page pour voir le post s'ajouter 
            }
        }

    }

    //ici id = id de la categorie dans laquelle on ajoute le topic 
    public function addTopic($id){

        $topicManager = new TopicManager();
        $postManager = new PostManager();
        
        // si je soumet le formulaire
        if(isset($_POST["submit"])) {

            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $post = filter_input(INPUT_POST, "post", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($title && $post) {
                $idtopic = $topicManager->add([
                    "title" => $title,
                    "category_id" => $id,
                    "user_id"=> Session::getUser()->getId()
                ]);

            //pour ajouter egalement le 1 er message 
                $postManager->add([
                    "text" => $post,
                    "user_id" => Session::getUser()->getId(),
                    "topic_id" => $idtopic
                ]);
  
                header("Location: index.php?ctrl=forum&action=listTopicsByCategory&id=$id");
            }
        }
    }

    public function closeTopic($id) {
        $topicManager = new TopicManager();
     
        // Récupérer le topic via l'ID
        $topic = $topicManager->findOneById($id);
        
        if ($topic) {
            $idCat = $topic->getCategory()->getId();
            $userId = Session::getUser()->getId();
            // Vérifier si l'utilisateur est l'auteur du topic
            if ($topic->getUser()->getId() === $userId ) {
                // Inverser l'état du topic (ouvert/fermé)
                $nvEtat = $topic->getclosed(); // Inverse l'état actuel
                
                // Mettre à jour l'état du topic dans la BDD
                $topicManager->closeTopic($id);
    
                // Redirection vers la page du topic
                header("Location: index.php?ctrl=forum&action=listTopicsByCategory&id=$idCat");
                exit ;
            } else {
                // afficher un message d'erreur
                echo "Vous n'êtes pas autorisé à modifier ce topic" ;
            }
        } else {
            // afficher un message si le topic n'existe pas
            echo "Le topic spécifié n'existe pas";
        }
    }

    public function openTopic($id){
        $topicManager = new TopicManager();
        $userId = Session::getUser()->getId();

        $topic = $topicManager->findOneById($id);

        if($topic) {
            $idCat = $topic->getCategory()->getId();

            if($topic->getUser()->getId() == $userId ){
                $nvEtat = !$topic->getclosed();
                $topicManager->openTopic($id);
              
                // Redirection vers la page du topic
                header("Location: index.php?ctrl=forum&action=listTopicsByCategory&id=$idCat");
                exit ;
            } else {
                // afficher un message d'erreur
                echo "Vous n'êtes pas autorisé à modifier ce topic" ;
            }
        } else {
            // afficher un message si le topic n'existe pas
            echo "Le topic spécifié n'existe pas";
        }
    }
 }
 