<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h1>Liste des topics</h1>


<div></div>

<?php

foreach($topics as $topic ){ 

// $idAuteur = $topic->getUser()->getNickName();
$userId = App\Session::getUser()->getId();
$role = App\Session::getUser()->getRole();
// var_dump($role);die;
?> 

<div class="categorie">
    <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>"><?= $topic->getTitle() ?></a>
     par <?= $topic->getUser() ?><br>
      le <?= $topic->getCreationDate()->format("d/m/y  H:i") ?>
     
    <?php
    //je verifie si idauteur == idUser pour accorder les droit sur topic ou role s'il est admin
        if($topic->getUser()->getId() == $userId || $role == "admin" ) { ?>
            <?php if($topic->getClosed() == 0) { ?>
                <a href="index.php?ctrl=forum&action=closeTopic&id=<?= $topic->getId() ?>">Close</a>
                <?php } else { ?>
                <a href="index.php?ctrl=forum&action=openTopic&id=<?= $topic->getId() ?>">Open</a>
            <?php }
        }else{
            
        }
    ?>

</div>
<?php } ?>

<form action="index.php?ctrl=forum&action=addTopic&id=<?=$category->getId()?>" method="POST">
    <label for="title">Titre Topic: </label>
    <input type="text" name="title" required><br>

    <label for="textarea">Premier post: </label>
    <textarea id="textarea" name="post" rows="4" cols="50" placeholder="entrer le 1er message" required></textarea>
  <br>
    <input type="submit" name="submit" value="ajouter">
    
</form>
