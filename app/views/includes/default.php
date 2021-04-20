<?php

$view = View::getInstance();
$currentUser = $view->getVariable('currentUser');

?>
<?php require_once APPROOT . '/views/includes/header.php'; ?>
<?php $view->getView(View::DEFAULT_VIEW); ?>
<?php require_once APPROOT . '/views/includes/footer.php'; ?>