<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 19/12/2016
 * Time: 14:06
 */
//$user = $_SESSION['user'];
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
                    <div class="navbar navbar-inverse navbar-top">
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
                                    <?php if(empty($_SESSION['user'])) {
                                        echo '<li><a href="' . BASE_URL . 'register">Register</a></li>
                                              <li><a href="' . BASE_URL . 'login">Login</a></li>';
                                    } else{
                                        echo '<li><a href="'. BASE_URL .'logout" class="glyphicon glyphicon-off" title="log out"></a></li>';
                                    } ?>

                                    <li><?php if(!empty($_SESSION['user'])){
                                                    if($_SESSION['user']['role'] === 'admin'){ ?>
                                                        <a href="<?= BASE_URL ?>admin/home">Admin</a> <?php
                                                    }
                                                } ?> </li>
                                    <li><?php if (!empty($_SESSION['user'])): ?>
                                            <div class="connected">Connected as <?= $_SESSION['user']['username'] ?> </div>
                                            <?php endif; ?></li>
                                </ul>
                            </div><!--/.nav-collapse -->
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <?php include("app/templates/$page.php") ?>

        <footer>
            <h3>IMIE 2016 &copy; MANOLO-DL17</h3>
        </footer>
    </body>
</html>