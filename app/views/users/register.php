<?php require_once APPROOT . '/views/includes/header.php'; ?>
    <div class="main">
        <h2>Regisztráció</h2>
        <form action="<?php echo URLROOT; ?>users/register" method="POST">
            <div>
                <label for="username">
                    <input type="text" name="username" placeholder="Felhasználónév">
                </label>
                <p><?php echo $datas['usernameError']; ?></p>
            </div>
            <div>
                <label for="email">
                    <input type="text" name="email" placeholder="E-mail cím">
                </label>
                <p><?php echo $datas['emailError']; ?></p>
            </div>
            <div>
                <label for="password">
                    <input class="lbtn" type="password" name="password" placeholder="Jelszó">
                </label>
                <p><?php echo $datas['passwordError']; ?></p>
            </div>
            <div>
                <label for="repassword">
                    <input type="password" name="repassword" placeholder="Jelszó újra">
                </label>
            </div>
            <div>
                <button type="submit" name="register_user">Regisztráció</button>
            </div>
        </form>
    </div>
<?php require_once APPROOT . '/views/includes/footer.php'; ?>