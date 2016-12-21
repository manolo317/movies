<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 19/12/2016
 * Time: 14:06
 */
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/public/css/style.css"/>
        <title><?= $title ?></title>
    </head>
    <body>

        <header>
            <div class="container">
                <div class="row">
                    <div class="navbar navbar-inverse navbar-top col-md-8">
                        <div class="container">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="#">Movie</a>
                            </div>
                            <div id="navbar" class="collapse navbar-collapse">
                                <ul class="nav navbar-nav">
                                    <li><a href="<?= BASE_URL ?>" class="glyphicon glyphicon-home"></a></li>
                                    <li><a href="#">FAQ</a></li>
                                    <li><a href="#">Contact</a></li>
                                    <li><a href="#">Admin</a></li>
                                </ul>
                            </div><!--/.nav-collapse -->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <form class="form-signin">
                            <h2 class="form-signin-heading">Please sign in</h2>
                            <label for="inputEmail" class="sr-only">Email address</label>
                            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                            <label for="inputPassword" class="sr-only">Password</label>
                            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="remember-me"> Remember me
                                </label>
                            </div>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                        </form>
                    </div>
                </div>
            </div>

        </header>

        <?php include("app/templates/$page.php") ?>

        <footer>
            <h2>IMIE 2016 &copy; MANOLO-DL17</h2>
        </footer>
        </div>
    </body>
</html>
