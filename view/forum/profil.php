

<h1>Mon Profil</h1>

<ul>
    <li>Pseudo: <?= htmlspecialchars($user->getNickName()) ?></li>
    <li>Email: <?= htmlspecialchars($user->getEmail()) ?></li>
    <li>Date d'inscription: <?= htmlspecialchars($user->getCreationDate()) ?></li>
</ul>

<h2>Mes 5 derniers topics</h2>
<?php if (!empty($topics)){?>
    <ul>
        <?php foreach ($topics as $topic): ?>
            <li><?= $topic->getTitle() ?> - <?=$topic->getCreationDate()  ?></li>
        <?php endforeach; ?>
    </ul>
<?php } else{ ?>
    <p>Vous n'avez pas encore créé de topics</p>
<?php }?>