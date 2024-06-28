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
 
    <a href="index.php?ctrl=forum&action=supprimerPost&id=<?= $post->getId()?>">supprimer</a>
    
<?php } }

if($topic->getClosed() == 0 ){?>

    <h3>ajouter un post</h3>

    <form action="index.php?ctrl=forum&action=addPost&id=<?= $topic->getId() ?>" method="POST">
    <textarea id="textarea" name="post" rows="4" cols="50" placeholder="ajouter votre text ici" required></textarea>
    <br>
    <input type="submit" name = "submit" value="envoyer">
   
<?php
 }else {
    echo "ce topic est fermé vous ne pouvez pas rajouter de post!";
 }

