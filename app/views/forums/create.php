<?php
$view = View::getInstance();
$currentUser = $view->getVariable('currentUser');
$forums = $view->getVariable('forums');
?>
    <div class="main">
        <h2>Fórum létrehozása</h2>
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
            <div>
                <button type="submit" name="create_forum">Fórum létrehozása</button>
            </div>
        </form>
    </div>
<?php $view->moveToDefaultView(); ?>