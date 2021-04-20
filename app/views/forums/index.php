<?php
$view = View::getInstance();
$forums = $view->getVariable('forums');
$forumCount = $view->getVariable('forumCount');
$user = $view->getVariable('user');
?>
    <div class="main">
        <h2>Fórumok</h2>
        <?php if ($forumCount === 0): ?>
        <p>Nincs létrehozva fórum. Fórumot csak az admin hozhat létre.</p>
        <?php else: ?>
        <p>Összes fórum: <?php echo $forumCount; ?></p>
        <?php endif; ?>
        <?php if (Admin::isAdmin($user->getRole())): ?>
        <a href="<?php echo URLROOT; ?>forums/create">Fórum készítése</a><br>
        <?php endif; ?>
        <?php foreach ($forums as $forum): ?>
        <div class="forum_container">
            <div class="forum_id"><b><?php echo $forum->getId(); ?></b></div>
            <div class="forum_title"><a href="<?php echo URLROOT; ?>forums/category/<?php echo $forum->getId(); ?>"><?php echo $forum->getTitle(); ?></a></div>
            <div class="forum_created_at"><?php echo $forum->getCreatedAt(); ?></div>
            <div class="forum_author"><?php echo $forum->getAuthor(); ?></div>
            <div class="forum_body"><?php echo $forum->getBody(); ?></div>
            <?php if (UserHelper::isUser($user->getRole()) && Time::countdown($forum->getCreatedAt()) ||Admin::isAdmin($user->getRole())): ?>
            <div class="forum_edit">
                <form action="<?php echo URLROOT; ?>forums/delete/<?php echo $forum->getId(); ?>" method="POST">
                    <div>
                        <label for="delete">
                            <button type="submit" name="delete_forum" value="<?php echo $forum->getId(); ?>">Törlés</button>
                        </label>
                    </div>
                </form>
                <form action="<?php echo URLROOT; ?>forums/update/<?php echo $forum->getId(); ?>" method="POST">
                    <div>
                        <label for="update">
                            <button type="submit" name="update_forum" value="<?php echo $forum->getId(); ?>">Módosítás</button>
                        </label>
                    </div>
                </form>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
<?php $view->moveToDefaultView(); ?>