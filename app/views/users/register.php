<?php
$view = View::getInstance();
$view->setVariable('title', 'Regisztráció');
$user = $view->getVariable('user');
$errors = $view->getVariable('errors');
?>
    <div class="main">
        <h2>Regisztráció</h2>
        <form action="<?php echo URLROOT; ?>users/register" method="POST">
            <?php echo isset($errors['base']) ? $errors['base'] . '<br>' : ''; ?>
            <div>
                <label for="username">
                    <?php echo isset($errors['username']) ? $errors['username'] . '<br>' : ''; ?>
                    <input type="text" name="username" placeholder="Felhasználónév" value="<?php echo $user->getUsername(); ?>">
                </label>
            </div>
            <div>
                <label for="email">
                    <?php echo isset($errors['email']) ? $errors['email'] . '<br>' : ''; ?>
                    <input type="text" name="email" placeholder="E-mail cím" value="<?php echo $user->getEmail(); ?>">
                </label>
            </div>
            <div>
                <label for="password">
                    <?php echo isset($errors['password']) ? $errors['password'] . '<br>' : ''; ?>
                    <input class="lbtn" type="password" name="password" placeholder="Jelszó">
                </label>
            </div>
            <div>
                <button type="submit" name="register_user">Regisztráció</button>
            </div>
        </form>
    </div>
<?php $view->moveToDefaultView(); ?>