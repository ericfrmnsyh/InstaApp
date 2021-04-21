<fieldset>
    <h1>User Sign Up</h1>
    <div class='form'>
        <form name='myform' action="register.php" method="POST">
            <div class="field">
                <label>Username</label>
                <div>
                    <input name="username" type="text" class="kontrol-form" value="<?php echo htmlspecialchars($username) ?>">
                    <?php if (isset($username_error)) { ?>
                        <p><?php echo $username_error ?></p>
                    <?php } ?>
                </div>
            </div>

            <div class="field">
                <label>Nama</label>
                <div>
                    <input name="nama" type="text" class="kontrol-form" value="<?php echo htmlspecialchars($nama) ?>">
                    <?php if (isset($nama_error)) { ?>
                        <p><?php echo $nama_error ?></p>
                    <?php } ?>
                </div>
            </div>

            <div class="field">
                <label>Phone</label>
                <div>
                    <input name="phone" type="text" class="kontrol-form" value="<?php echo htmlspecialchars($phone) ?>">
                    <?php if (isset($phone_error)) { ?>
                        <p><?php echo $phone_error ?></p>
                    <?php } ?>
                </div>
            </div>

            <div class="field">
                <label>Email</label>
                <div>
                    <input name="email" type="text" class="kontrol-form" value="<?php echo htmlspecialchars($email) ?>">
                    <?php if (isset($email_error)) { ?>
                        <p><?php echo $email_error ?></p>
                    <?php } ?>
                </div>
            </div>

            <div class="field">
                <label>Password</label>
                <div>
                    <input name="pass" type="password" class="kontrol-form" value="<?php echo htmlspecialchars($pass) ?>">
                    <?php if (isset($pass_error)) { ?>
                        <p><?php echo $pass_error ?></p>
                    <?php } ?>
                </div>
            </div>

            <div class="field">
                <label>Confirm Password</label>
                <div>
                    <input name="confirm" type="password" class="kontrol-form" value="<?php echo htmlspecialchars($confirm) ?>">
                    <?php if (isset($confirm_error)) { ?>
                        <p><?php echo $confirm_error ?></p>
                    <?php } ?>
                </div>
            </div>

            <div class="box">
                Already had account?
                <a href="login.php">Sign In</a>
            </div>

            <div class="button">
                <input name="add" type="submit" class="kontrol-form" value="SUBMIT">
                <input type="reset" class="kontrol-form" value="RESET">
            </div>
        </form>
    </div>
</fieldset>