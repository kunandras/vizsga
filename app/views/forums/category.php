<?php
$view = View::getInstance();
$currentUser = $view->getVariable('currentUser');
$forumId = $view->getVariable('forumId');
$categories = $view->getVariable('categories');
?>
    <div class="main">
        <?php foreach ($categories as $category): ?>
            <div class="forum_container">
                <div class="forum_id"><b><?php echo $category->getId(); ?></b></div>
                <div class="forum_title"><a href="<?php echo URLROOT; ?>categories/category/<?php echo $category->getId(); ?>"><?php echo $category->getTitle(); ?></a></div>
                <div class="forum_created_at"><?php echo $category->getCreatedAt(); ?></div>
                <div class="forum_author"><?php echo $category->getAuthor(); ?></div>
                <div class="forum_body"><?php echo $category->getBody(); ?></div>
            </div>
        <?php endforeach; ?>
    </div>
<?php $view->moveToDefaultView(); ?>