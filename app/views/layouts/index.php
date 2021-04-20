<?php
$view = View::getInstance();
$currentUser = $view->getVariable('currentUser');
?>
<?php require APPROOT . '/views/includes/header.php'; ?>
<?php echo $view->addFlash() . '<br>'; ?>
<?php echo $view->getView(View::DEFAULT_VIEW); ?>
<?php require APPROOT . '/views/includes/footer.php'; ?>
