<?php
    $categories = $result["data"]['categories']; 
?>

<h1>Liste des catégories</h1>
<div class="wrap">
    <?php
    foreach($categories as $category ){ ?>
        <div class="categorie"><a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId() ?>"><?= $category->getName() ?></a></div>
    <?php }?>
</div>




