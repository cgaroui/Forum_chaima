<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h1>Liste des topics</h1>

<?php
// $_SESSION[""]

// $userManager = new UserManager();
// $_SESSION["user"]=$user;
// $userId = $user->getId();
// var_dump($user);die;

// $idAuteur = 




foreach($topics as $topic ){ 

// $idAuteur = $topic->getUser()->getNickName();
$userId = App\Session::getUser()->getId();

?> 

<p>
    <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>"><?= $topic->getTitle() ?></a>
     par <?= $topic->getUser() ?>
      le <?= $topic->getCreationDate()->format("d/m/y  H:i") ?>
     
    <?php
    //je verifie si idauteur == idUser pour accorder les droit sur topic ou role ==  admin
        if($topic->getUser()->getId() == $userId  ) { ?>
            <?php if($topic->getClosed() == 0) { ?>
                <a href="index.php?ctrl=forum&action=closeTopic&id=<?= $topic->getId() ?>">Close</a>
                <?php } else { ?>
                <a href="index.php?ctrl=forum&action=openTopic&id=<?= $topic->getId() ?>">Open</a>
            <?php }
        }else{

        }
    ?>
</p>

<?php } ?>

<form action="index.php?ctrl=forum&action=addTopic&id=<?=$category->getId()?>" method="POST">
    <label for="title">Titre Topic: </label>
    <input type="text" name="title" required><br>

    <label for="textarea">Premier post: </label>
    <textarea id="textarea" name="post" rows="4" cols="50" placeholder="entrer le 1er message" required></textarea>
  <br>
    <input type="submit" name="submit" value="ajouter">
</form>
