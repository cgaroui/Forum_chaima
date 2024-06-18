<?php
    $topic = $result["data"]['topic']; 
    $posts = $result["data"]['posts'];
?>

<h1>Liste des topics</h1> 
 <a href="index.php?ctrl=forum&action=findPostsByTopic&id=<?= $topic->getId() ?>"><?= $topic->getTitle() ?></a>

<?php foreach($posts as $post) { ?>
    <p>
        par <?= $post->getUser() ?> le <?= $post->getCreationDate() ?>
    </p>
<?php } ?>
