<?php
    $topic = $result["data"]['topic']; 
    $posts = $result["data"]['posts'];
?>

<h1>Liste des posts de "<?= $topic->getTitle() ?>"</h1> 

<?php if (empty($posts)) { ?>
    <p>Aucun post à afficher pour ce sujet.</p>
<?php } else { ?>
    <?php foreach($posts as $post) { ?>
        <p>
    <br><?=$post->getText()?><br> par <?="\n" .$post->getUser() ?><br> le <?= $post->getCreationDate()->format("d/m/Y H:i") ?>
    </p>

    
<?php } }?>

    <h3>ajouter un post</h3>

<form action="index.php?ctrl=forum&action=addPost&id=<?= $topic->getId() ?>" method="POST">
  <textarea id="textarea" name="post" rows="4" cols="50">ajouter votre text ici</textarea>
  <br>
  <input type="submit" name = "submit" value="envoyer">
</form>

    

