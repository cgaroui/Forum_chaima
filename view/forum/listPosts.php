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
            $role = App\Session::getUser() ? App\Session::getUser()->getRole() : null;
            if($userId){ ?>
                <div class="un-post">
                    <!-- photo de profil rond + pseudo en dessous -->
                    <div class="post-profil">
                        <div class="post-img">
                            <img src="profil.png" alt="photo de profil">
                        </div>
                        <?="\n" .$post->getUser() ?><br>
                    </div>

                    <div class="contenu-post">
                        le <?= $post->getCreationDate()->format("d/m/Y H:i") ?>
                        <div class="text-post">
                            <?=$post->getText()?><br>
                        </div>
                    </div>
                    
                    <div class="supp-post">
                    <?php if($role == "admin" || $post->getUser()->getId() == $userId) { ?>
                        <a href="index.php?ctrl=forum&action=supprimerPost&id=<?= $post->getId()?>">supprimer</a><br>
                    <?php } ?>
                    </div>
                </div>    
            <?php } else { ?>
                <div class="un-post">
                    <div class="post-profil">
                        <div class="post-img">
                            <img src="profil.png" alt="photo de profil">
                        </div>
                        <?="\n" .$post->getUser() ?><br>
                    </div>

                    <div class="contenu-post">
                        le <?= $post->getCreationDate()->format("d/m/Y H:i") ?>
                        <div class="text-post">
                            <?=$post->getText()?><br>
                        </div>
                    </div>
                </div>    
            <?php } ?>
        <?php } ?>
    </div>

    <div class="ajout-post">
        <?php if($userId && $topic->getClosed() == 0) { ?>
            <h3>ajouter un post</h3>
            <form action="index.php?ctrl=forum&action=addPost&id=<?= $topic->getId() ?>" method="POST">
                <textarea id="textarea" name="post" rows="1" cols="50" placeholder="ajouter votre texte ici" required></textarea>
                <br>
                <input type="submit" name="submit" value="envoyer" class="btn">
            </form>
        <?php } else if($topic->getClosed() != 0) {
            echo "Ce topic est fermé, vous ne pouvez pas rajouter de post!";
        } ?>
    </div>
<?php } ?>
