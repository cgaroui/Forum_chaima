<?php
//
$topics = $result["data"]['topics']; 


$user = App\Session::getUser();
// var_dump($user);

?>
<h1>Mon Profil</h1>

<ul>
    <li>Pseudo: <?=$user->getNickName() ?></li>
    <li>Email: <?= $user->getEmail() ?></li>
    <li>Date d'inscription: <?= $user->getCreationDate()->format("d/m/Y")?></li>
</ul>
<h2>Mes 5 derniers topics</h2>
<?php if (!empty($topics)){?>
    <ul>
        <?php foreach ($topics as $topic){?>
            <li><?= $topic->getTitle() ?> - <?=$topic->getCreationDate()->format('d-m-Y H:i')  ?></li>
           <?php } ?>

    </ul>
<?php } else{ ?>
    <p>Vous n'avez pas encore créé de topics</p>
<?php }?>