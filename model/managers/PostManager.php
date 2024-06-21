<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class PostManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Post";
    protected $tableName = "post";

    public function __construct(){
        parent::connect();
    }

    // Pour récupérer tous les posts pour un topic spécifique (par son id)
    public function findPostsByTopic($topicId) {
        $sql = "SELECT * 
                FROM {$this->tableName} p 
                WHERE p.topic_id = :topic_id
                ORDER BY p.creationDate ASC ";
                
                

        return $this->getMultipleResults(
            DAO::select($sql, ['topic_id' => $topicId]),
            $this->className
        );
    }


}
