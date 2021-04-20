<?php

$view = View::getInstance();
$id = $_SESSION['id'];

?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/style/style.css">
    <title><?php echo $view->getVariable('title', 'MVC Fórum');  ?></title>
</head>
    <body>
        <header>
        <ul>
            <li><a href="<?php echo URLROOT; ?>users/index">Kezdőlap</a></li>
            <?php if (!isset($_SESSION['current_user'])): ?>
            <li><a href="<?php echo URLROOT; ?>users/register">Regisztráció</a></li>
            <li><a href="<?php echo URLROOT; ?>users/login">Bejelentkezés</a></li>
            <?php else: ?>
                <?php if($_SESSION['role'] === 'admin'): ?>
                <li><a href="<?php echo URLROOT; ?>admins/index">Admin oldal</a></li>
                <?php endif; ?>
                <li><a href="<?php echo URLROOT; ?>users/profile/<?php echo $id; ?>">Profil</a></li>
                <li><a href="<?php echo URLROOT; ?>forums/index">Fórumok</a></li>
            <li><a href="<?php echo URLROOT; ?>users/logout">Kijelentkezés</a></li>
            <?php endif; ?>
        </ul>
        </header>