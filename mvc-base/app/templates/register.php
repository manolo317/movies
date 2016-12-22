<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 22/12/2016
 * Time: 12:08
 */
?>

<main>
    <form method="POST" class="connexion">
        <div class="imgcontainer">
            <img src="<?= BASE_URL ?>/public/img/avatar.jpg" alt="Avatar" class="avatar">
        </div>

        <div class="contain">
            <label><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" id="username" value="" required>

            <label><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" id="email" value="" required>

            <label><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" id="password" value="" required>

            <label><b>Password bis</b></label>
            <input type="password" placeholder="Enter Password" name="password_bis" id="password_bis" value="" required>

            <button type="submit">Login</button>
            <input type="checkbox" checked="checked"> Remember me
        </div>
        <?php foreach($errors as $error): ?>
            <p><?= $error ?></p>
        <?php endforeach; ?>
        <div class="contain" style="background-color:#f1f1f1">
            <button type="button" class="cancelbtn">Cancel</button>
            <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
    </form>
</main>
