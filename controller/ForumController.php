<?php
namespace Controller;

use App\Session;
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
                    "user_id" => 4,
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
                    "user_id"=> 5
                ]);

            //pour ajouter egalement le 1 er message 
                $postManager->add([
                    "text" => $post,
                    "user_id" => 5,
                    "topic_id" => $idtopic
                ]);
  
                header("Location: index.php?ctrl=forum&action=listTopicsByCategory&id=$id");
            }
        }
    }

    public function closed(){

        $topicManager = new TopicManager();
        $userId = 3;
   
 
    
        // Récupére le topic
        $topic = filter_input(INPUT_POST, "post", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    
        // Vérifie si l'utilisateur est l'auteur du topic
         if($topic->getUser()->getId() == $userId){
            $topic->getclosed()

         }
            // Changer l'état du topic (ouvert/fermé)
            // Supposons que getIsClosed() renvoie 0 ou 1
            // Inverser l'état
    
            // Mettre à jour l'état du topic
          
    
            // Redirection vers la page des topics de la catégorie du topic
        
      
            // Si l'utilisateur n'est pas l'auteur, on peut rediriger vers une page d'erreur ou afficher un message
      
      
     }
    
    
    
   
}
