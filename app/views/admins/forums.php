<?php
$view = View::getInstance();
$forums = $view->getVariable('forums');
?>
    <div class="main">
        <h2>Összes fórum</h2>
        <div class="forum_container">
            <div class="forum_id"><b>#</b></div>
            <div class="forum_title"><b>Fórum neve</b></div>
            <div class="forum_created_at"><b>Fórum készítése</b></div>
            <div class="forum_edit"><b>Szerkesztés</b></div>
        </div>
        <?php foreach($forums as $forum): ?>
        <div class="forum_container">
            <div class="forum_id"><?php echo $forum->getId(); ?></div>
            <div class="forum_title"><?php echo $forum->getTitle(); ?></div>
            <div class="forum_created_at"><?php echo $forum->getCreatedAt(); ?></div>
            <div class="forum_edit">Törlés Módosítás</div>
        </div>
        <?php endforeach; ?>
    </div>
<?php $view->moveToDefaultView(); ?>