<?php
$view = View::getInstance();
$currentUser = $view->getVariable('currentUser');
$forum = $view->getVariable('forum');
?>
    <div class="main">
        <h2>Szerkesztés</h2>
        <form action="<?php echo URLROOT; ?>forums/create" method="POST">
            <div>
                <label for="title">
                    <input type="text" name="title" placeholder="Cím">
                </label>
            </div>
            <div>
                <label for="body">
                    <input type="text" name="body" placeholder="Leírás">
                </label>
            </div>
            <?php echo $currentUser; ?>
            <div>
                <button type="submit" name="create_forum">Regisztráció</button>
            </div>
        </form>
    </div>
<?php $view->moveToDefaultView(); ?>