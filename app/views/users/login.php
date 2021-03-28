<?php require_once APPROOT . '/views/includes/header.php'; ?>
    <div class="main">
        <h2>Bejelentkezés</h2>
        <form action="<?php echo URLROOT; ?>users/login" method="POST">
            <div>
                <label for="username">
                    <input type="text" name="username" placeholder="Felhasználónév">
                </label>
                <p><?php echo $datas['usernameError']; ?></p>
            </div>
            <div>
                <label for="password">
                    <input class="lbtn" type="password" name="password" placeholder="Jelszó">
                </label>
                <p><?php echo $datas['passwordError']; ?></p>
            </div>
            <div>
                <button type="submit" name="login_user">Bejelentkezés</button>
            </div>
        </form>
    </div>
<?php require_once APPROOT . '/views/includes/footer.php'; ?>