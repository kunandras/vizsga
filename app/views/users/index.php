<?php
$view = View::getInstance();
?>
    <div class="main">
        <h2>Kezdőlap</h2>
        <p>- Regisztráció:</p>
        <?php echo $_SESSION['current_user']; ?>
    </div>
<?php $view->moveToDefaultView(); ?>