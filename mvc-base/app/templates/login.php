<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 22/12/2016
 * Time: 12:09
 */
?>
<main>
    <form method="POST" class="connexion">
        <div class="imgcontainer">
            <img src="<?= BASE_URL ?>/public/img/avatar.jpg" alt="Avatar" class="avatar">
        </div>

        <div class="contain">
            <label><b>Username or email</b></label>
            <input type="text" placeholder="Enter Username" name="usernameOrEmail" id="usernameOrEmail" required>

            <label><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" id="password" required>

            <button type="submit">Login</button>
            <input type="checkbox" checked="checked"> Remember me
        </div>
        <p><?php if (isset($error)) echo $error; ?></p>
        <div class="contain" style="background-color:#f1f1f1">
            <button type="button" class="cancelbtn">Cancel</button>
            <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
    </form>
</main>