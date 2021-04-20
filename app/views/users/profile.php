<?php
$view = View::getInstance();

$errors = $view->getVariable('errors');
$id = $view->getVariable('id');
$currentUser = $_SESSION['current_user'];
$email = $_SESSION['email'];
$view->setVariable('title', 'Profil - ' . $currentUser);
?>
    <div class="main">
        <h2><?php echo $currentUser; ?> profilja</h2>
        <?php echo isset($errors['base']) ? $errors['base'] : ''; ?>
        <form action="<?php echo URLROOT; ?>users/profile/<?php echo $id; ?>" method="POST">
            <div>
                <?php echo isset($errors['username']) ? $errors['username'] . '<br>' : ''; ?>
                <label for="username">
                    <input type="text" name="username" value="<?php echo $currentUser; ?>">
                </label>
            </div>
            <div>
                <?php echo isset($errors['email']) ? $errors['email'] . '<br>' : ''; ?>
                <label for="email">
                    <input class="lbtn" type="email" name="email" value="<?php echo $email; ?>">
                </label>
            </div>
            <div>
                <button type="submit" name="update_profile">Szerkesztés</button>
            </div>
        </form>
    </div>
<?php $view->moveToDefaultView(); ?>