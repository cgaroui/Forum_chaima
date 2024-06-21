<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h1>Liste des topics</h1>

<?php
$idAuteur = 3;

foreach($topics as $topic ){ 
    
    if($topic->getUser()->getId() == $idAuteur) { ?>
        <p><a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>"><?= $topic->getTitle() ?></a> par <?= $topic->getUser() ?> le <?= $topic->getCreationDate()->format("d/m/y  H:i") ?><a href="http://">lien closed</a>
            </p> 
            <?php $topic->setClosed(1); 
    }else { ?>

        <p><a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>"><?= $topic->getTitle() ?></a> par <?= $topic->getUser() ?> le <?= $topic->getCreationDate()->format("d/m/y  H:i") ?>
        <?php }
}?>

<form action="index.php?ctrl=forum&action=addTopic&id=<?=$category->getId()?>" method="POST">
    <label for="title">Titre Topic: </label>
    <input type="text" name="title" required><br>

    <label for="textarea">Premier post: </label>
    <textarea id="textarea" name="post" rows="4" cols="50" placeholder="entrer le 1er message" required></textarea>
  <br>
    <input type="submit" name="submit" value="ajouter">
</form>
