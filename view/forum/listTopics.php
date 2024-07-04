<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h1>Liste des topics</h1>

<div class="wrap">
    <?php
    foreach($topics as $topic) { 
        //on verifie si l'utilisateur est connecté on stocke son id/role dans la variable sinon on renvoie null
        $userId = App\Session::getUser() ? App\Session::getUser()->getId() : null;
        $role = App\Session::getUser() ? App\Session::getUser()->getRole() : null;
    ?>
        <div class="categorie">
            <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>"><?= $topic->getTitle() ?></a>
            par <?= $topic->getUser() ?><br>
            le <?= $topic->getCreationDate()->format("d/m/y H:i") ?>
            
            <?php
            // Vérifie si l'auteur du topic est l'utilisateur connecté ou si l'utilisateur est un admin
            if($userId && ($topic->getUser()->getId() == $userId || $role == "admin")) {
                if($topic->getClosed() == 0) { ?>
                    <a href="index.php?ctrl=forum&action=closeTopic&id=<?= $topic->getId() ?>">Close</a>
                <?php } else { ?>
                    <a href="index.php?ctrl=forum&action=openTopic&id=<?= $topic->getId() ?>">Open</a>
                <?php }
            }
            ?>
        </div>
    <?php } ?>

    <?php if($userId) { ?>
        <div class="ajout-topic">
            <form action="index.php?ctrl=forum&action=addTopic&id=<?= $category->getId() ?>" method="POST">
                <label for="title">Titre Topic: </label>
                <input type="text" name="title" required><br>

                <label for="textarea">Premier post: </label>
                <textarea id="textarea" name="post" rows="4" cols="50" placeholder="entrer le 1er message" required></textarea>
                <br>
                <input type="submit" name="submit" value="ajouter">
            </form>
        </div>
    <?php } ?>
</div>
