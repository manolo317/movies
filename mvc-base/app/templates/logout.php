<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 22/12/2016
 * Time: 12:09
 */
//efface la donnée qui permet d'identifier l'utilisateur
unset($_SESSION['user']);

//redirige vers menu
header("Location: ".BASE_URL);