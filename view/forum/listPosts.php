<?php
    $topic = $result["data"]['topic']; 
    $posts = $result["data"]['posts'];
?>

<h1>Liste des posts de "<?= $topic->getTitle() ?>"</h1> 
<h2> Auteur : <?=$topic->getUser()->getNickname()?><br>Publiée le : <?=$topic->getCreationDate()->format("d/m/Y H:i") ?></h2>

<?php if (empty($posts)) { ?>
    <p>Aucun post à afficher pour ce sujet.</p>
<?php } else { ?>
    <div class="tous-post">
        <?php foreach($posts as $post) { 
            $userId = App\Session::getUser() ? App\Session::getUser()->getId() : null;
            $role = App\Session::getUser() ? App\Session::getUser()->getRole() : null; ?>
            
            <div class="un-post">
                <div class="post-profil">
                    <div class="post-img">
                        <img src="profil.png" alt="photo de profil">
                    </div>
                    <?= "\n" . $post->getUser() ?><br>
                </div>

                <div class="contenu-post">
                    le <?= $post->getCreationDate()->format("d/m/Y H:i") ?>
                    <div class="text-post">
                        <?= $post->getText() ?><br>
                    </div>
                </div>

                <?php if($userId && ($role == "admin" || $post->getUser()->getId() == $userId)) { ?>
                    <div class="supp-post">
                        <a href="index.php?ctrl=forum&action=supprimerPost&id=<?= $post->getId() ?>">supprimer</a><br>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
<?php } ?>

<?php if($userId && $topic->getClosed() == 0) { ?>
    <div class="ajout-post">
        <h3>ajouter un post</h3>
        <form action="index.php?ctrl=forum&action=addPost&id=<?= $topic->getId() ?>" method="POST">
            <textarea id="textarea" name="post" rows="1" cols="50" placeholder="ajouter votre texte ici" required></textarea>
            <br>
            <input type="submit" name="submit" value="envoyer" class="btn">
        </form>
    </div>
<?php } else if($userId && $topic->getClosed() != 0) {
    echo "<p>Ce topic est fermé, vous ne pouvez pas rajouter de post!</p>";
} ?>
