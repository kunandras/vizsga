<?php
$view = View::getInstance();
?>
    <div class="main">
        <h2>Admin oldal</h2>
        <ul>
            <li><a href="<?php echo URLROOT; ?>admins/users">Felhasználók</a></li>
            <li><a href="<?php echo URLROOT; ?>admins/forums">Fórumok</a></li>
            <li><a href="<?php echo URLROOT; ?>admins/categories">Kategóriák</a></li>
            <li><a href="<?php echo URLROOT; ?>admins/comments">Kommentek</a></li>
        </ul>
    </div>
<?php $view->moveToDefaultView(); ?>