<?php
$view = View::getInstance();
$users = $view->getVariable('users');
?>
    <div class="main">
        <h2>Összes felhasználó</h2>
        <?php foreach ($users as $user): ?>
        <div class="flex_container">
            <div class="flex_id"><?php echo $user->getId(); ?></div>
            <div class="flex_name"><?php echo $user->getUsername(); ?></div>
            <div class="flex_email"><?php echo $user->getEmail(); ?></div>
            <div class="flex_edit"><b>Szerkesztés</b></div>
        </div>
        <?php endforeach; ?>
    </div>
<?php $view->moveToDefaultView(); ?>