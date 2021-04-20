<?php //echo $_SESSION['username']; ?>
<?php var_dump($_SESSION); ?>
<?php var_dump($datas['user']); ?>
<?php foreach ($datas['user'] as $user): ?>
    <?php
    /*if ($user->getRole() === 'admin') {
        echo 'admin vagy';
    }*/
    ?>
<?php endforeach; ?>