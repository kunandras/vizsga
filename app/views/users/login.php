<?php
$view = View::getInstance();
$view->setVariable('title', 'Bejelentkezés');
$errors = $view->getVariable('errors');
?>
<div class="main">
    <h2>Bejelentkezés</h2>
    <?php echo isset($errors['base']) ? $errors['base'] : ''; ?>
    <form action="<?php echo URLROOT; ?>users/login" method="POST">
        <div>
            <label for="username">
                <input type="text" name="username" placeholder="Felhasználónév">
            </label>
        </div>
        <div>
            <label for="password">
                <input class="lbtn" type="password" name="password" placeholder="Jelszó">
            </label>
        </div>
        <div>
            <button type="submit" name="login_user">Bejelentkezés</button>
        </div>
    </form>
</div>
<?php $view->moveToDefaultView(); ?>