<?php

namespace Controller;

use Model\Entity\Movie;
use Model\Entity\MovieGenre;
use Model\Manager\MovieGenreManager;
use Model\Manager\UserManager;
use View\View; //on peut donc utiliser cette classe comme View au lieu de \View\View
use Model\Manager\MovieManager;
use Model\Manager\GenreManager;
class DefaultController
{
	/**
	 * Affiche la page d'accueil
	 */
	public function home()
	{
        //j'instancie mes managers
	    $movieManager = new MovieManager();
        $genreManager = new GenreManager();
        //je retourne les genres pour faire mon form
        $genres = $genreManager->findAll();
        //je retourne les années pour faire mon form
        $years = $movieManager->findYear();

        $message = null;
        // si j'ai recu un $_GET de mon form
        if(!empty($_GET)){
            //si j'ai rempli un genre et une année
            if(!empty($_GET['genre']) && !empty($_GET['year'])){
                //je retourne tous les films du genre et de l'année
                $movies = $movieManager->findAllByGenreAndYear($_GET['genre'], $_GET['year']);
                // si pas de films => message
                if(empty($movies)){
                    $message = "No results, try another research!";
                }
            }
            //si j'ai rempli un genre
            else if(!empty($_GET['genre'])){
                //je retourne tous les films du genre
                $movies = $movieManager->findAllByGenre($_GET['genre']);
            }
            //si j'ai rempli une année
            else if(!empty($_GET['year'])){
                //je retourne tous les films de l'année
                $movies = $movieManager->findAllByYear($_GET['year']);
            }
            // si j'ai fait une recherche
            else if(!empty($_GET['research'])){
                // je retourne les films contenant la recherche dans le titre
                $movies = $movieManager->findByResearch($_GET['research']);
                // si pas de films => message
                if(empty($movies)){
                    $message = "No results, try another research!";
                }
            }
        }
        else{
            // sinon je retourne tous les films triés par note
            //$currentPage = (empty($_GET['page']))?1:$_GET['page'];
            $movies = $movieManager->findAll();
            //var_dump($movies);

        }


        View::show("home.php", "Movie | Accueil", ["movies" =>$movies,
                                                   "message" => $message,
                                                   "genres" =>$genres,
                                                   "years" => $years
                                                /*,"currentPage" => $currentPage*/]);

	}
    public function movieDetails()
    {
        $movieManager = new MovieManager();
        $genreManager = new GenreManager();
        //créé le movie dont l'Id est dans l'URL
        $id = $_GET['id'];
        $movie = $movieManager->findOneById($id);
        $genre = $genreManager->findAllByGenre($id);
        //si le movie n'existe pas erreur 404
        if(empty($movie)){
            return $this->error404();
        }
        //affiche la vue en lui passant le post
        View::show("movie_details.php", $movie->getTitle(), ["movie" =>$movie, "genre" =>$genre]);
    }

	/**
	 * Affiche la page d'erreur 404
	 */
	public function error404()
	{
		//envoie une entête 404 (pour notifier les clients que ça a foiré)
		header("HTTP/1.0 404 Not Found");
		View::show("errors/404.php", "Oups ! Perdu ?");
	}

    public function error403()
    {
        //envoie une entête 403 (pour notifier les clients que ça a foiré)
        header("HTTP/1.0 403 Forbidden");
        View::show("errors/403.php", "Oups ! Forbidden ?");
    }

	public function register()
    {
        $errors = [];
        $userManager = new UserManager();
        if (!empty($_POST)){
            //attention aux XSS ici
            $username = strip_tags($_POST['username']);
            $email = strip_tags($_POST['email']);

            $plainPassword = $_POST['password'];
            $passwordBis = $_POST['password_bis'];

            //tous les champs sont requis
            if (empty($username) || empty($email) || empty($plainPassword) || empty($passwordBis)){
                $errors[] = "Veuillez remplir tous les champs.";
            }

            //s'assurer que les 2 mdp concordent
            if ($plainPassword != $passwordBis){
                $errors[] = "les mdps ne concordent pas";
            }

            //email avec filter_var($email, FILTER_VALIDATE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors[] = "Votre email n'est pas valide";
            }

            //vérifie que l'email n'existe pas déjà
            $checkEmail = $userManager->checkEmail($email);

            if (!empty($checkEmail)){
                $errors[] = "Cet email est déjà enregistré ici !";
            }

            //vérifie que le username n'existe pas déjà
            $checkUser = $userManager->checkUser($username);

            if (!empty($checkUser)){
                $errors[] = "Ce pseudo est déjà enregistré ici !";
            }

            if (empty($errors)){

                //hache le mdp
                $passwordHash = password_hash($plainPassword, PASSWORD_DEFAULT);

                //rôle par défaut
                $role = "user";

                //génère une chaîne réellement aléatoire
                //voir https://github.com/ircmaxell/RandomLib
                //utiliser random_bytes() en PHP7
                $factory = new \RandomLib\Factory;
                $generator = $factory->getGenerator(new \SecurityLib\Strength(\SecurityLib\Strength::MEDIUM));
                $token = $generator->generateString(50, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');

                //requête d'insertion en bdd
                $insertUser = $userManager->insertUser($username, $email, $passwordHash, $token, $role);
                //si la requête passe bien...
                if ($insertUser){

                    //on pourrait aussi directement connecter l'utilisateur ici
                    $user = $userManager->getUserByEmailOrUsername($username);
                    $_SESSION['user'] = $user;
                    //redirige sur l'accueil
                    header("Location: ".BASE_URL);
                }
                else {
                    $errors[] = "Oups ! Une erreur est survenue !";
                }
            }
        }
        //affichage du form
        View::show("register.php", "Register page", ["errors" => $errors]);
    }
    public function login()
    {
        $error = null;
        if (!empty($_POST)){

            $usernameOrEmail = $_POST['usernameOrEmail'];
            $userManager = new UserManager();
            //on va chercher le user en fonction du pseudo ou de l'email
            $user = $userManager->getUserByEmailOrUsername($usernameOrEmail);

            //hache le mot de passe et le compare à celui de la bdd
            if (password_verify($_POST['password'], $user['password'])){
                //connectez l'user en stockant une ou des infos dans la session. On vérifiera ces infos sur les pages à sécuriser.
                $_SESSION['user'] = $user;

                //$_COOKIE pour la lecture
                //on stocke le token dans un cookie
                //on ne devrait placer ce cookie que si une case est cochée
                //pour l'instant, ce cookie ne sert à rien !!!
                setcookie("remember_me", $user['token'], strtotime("+ 6 months"), "/");
                //redirige vers le menu
                header("Location: ".BASE_URL);

            }
            else {
                //on garde ça vague pour ne pas donner d'infos aux méchants
                $error = "Mauvais identifiants ou mot de passe";
            }
            //var_dump($_SESSION['user']);

        }
        //affichage du form
        View::show("login.php", "Login page", ["error" => $error]);
    }
    public function logout()
    {

        View::show("logout.php", "Logout page");
    }

    public function adminMenu()
    {
        $userManager = new UserManager();
        if($userManager->adminAllowedOnly()){ //je check si c'est un admin

            //j'instancie mes managers
            $movieManager = new MovieManager();
            $genreManager = new GenreManager();
            //je retourne les genres pour faire mon form
            $genres = $genreManager->findAll();
            //je retourne les années pour faire mon form
            $years = $movieManager->findYear();

            $message = null;
            // si j'ai recu un $_GET de mon form
            if(!empty($_GET)){
                //si j'ai rempli un genre et une année
                if(!empty($_GET['genre']) && !empty($_GET['year'])){
                    //je retourne tous les films du genre et de l'année
                    $movies = $movieManager->findAllByGenreAndYear($_GET['genre'], $_GET['year']);
                    // si pas de films => message
                    if(empty($movies)){
                        $message = "No results, try another research!";
                    }
                }
                //si j'ai rempli un genre
                else if(!empty($_GET['genre'])){
                    //je retourne tous les films du genre
                    $movies = $movieManager->findAllByGenre($_GET['genre']);
                }
                //si j'ai rempli une année
                else if(!empty($_GET['year'])){
                    //je retourne tous les films de l'année
                    $movies = $movieManager->findAllByYear($_GET['year']);
                }
                // si j'ai fait une recherche
                else if(!empty($_GET['research'])){
                    // je retourne les films contenant la recherche dans le titre
                    $movies = $movieManager->findByResearch($_GET['research']);
                    // si pas de films => message
                    if(empty($movies)){
                        $message = "No results, try another research!";
                    }
                }
                else{
                    // sinon je retourne tous les films triés par note
                    //$currentPage = (empty($_GET['page']))?1:$_GET['page'];
                    $movies = $movieManager->findAllByTitle();
                    //var_dump($movies);

                }
            }
        }
        else{
            header("Location: ".BASE_URL."forbidden");
        }



        //var_dump($_GET);
        View::show("admin_menu.php", "Admin | Home", ["movies" =>$movies,
                                                      "message" => $message,
                                                      "genres" =>$genres,
                                                      "years" => $years]);
    }

    public function adminDeleteMovie()
    {
        $userManager = new UserManager();
        if($userManager->adminAllowedOnly()) { //je check si c'est un admin

            $movieManager = new MovieManager();
            //supprime le movie dont l'Id est dans l'URL
            $id = $_GET['id'];
            $movieManager->deleteMovie($id);

            View::show("delete_movie.php", "Admin | Delete");
        }
        else{
            header("Location: ".BASE_URL."forbidden");
        }
    }

    public function adminCreateMovie()
    {
        $userManager = new UserManager();
        if($userManager->adminAllowedOnly()) { //je check si c'est un admin

            //crée une nouvelle instance de film
            $movie = new Movie();
            $movieGenre = new MovieGenre();

            $message = NULL;
            $postErrors = NULL;
            //j'instancie mes managers
            $genreManager = new GenreManager();
            $movieManager = new MovieManager();
            //je retourne les genres pour faire mon form
            $genres = $genreManager->findAll();

            // si le formulaire est soumis
            if(!empty($_POST)){
                //les infos de l'image
                //var_dump($_FILES);

                //validation si le film n'existe pas deja
                $titleMovie = $_POST['title'];
                $checkMovie = $movieManager->checkMovie($titleMovie);
                if(empty($checkMovie)){
                    //validation du fichier upload si un fichier a bien été envoyé
                    if($_FILES['imdbId']['error'] != 4){
                        $uploadError = null;

                        //type mime
                        $file = $_FILES['imdbId']['tmp_name'];
                        $finfo = finfo_open(FILEINFO_MIME_TYPE);
                        $mime = finfo_file($finfo, $file);
                        finfo_close($finfo);
                        //echo $mime;


                        if(substr($mime, 0, 5) != "image"){
                            $uploadError = "MimeType invalide";
                        }
                        //taille
                        if($_FILES['imdbId']['size'] > 1000000){
                            $uploadError = "Fichier trop lourd";
                        }
                        //vérifier les erreurs d'upload
                        if($_FILES['imdbId']['error'] !== 0){
                            $uploadError = "Une erreur est survenue";
                        }
                        //si on a pas d'erreur ...
                        if($uploadError == null){
                            //si ok on déplace/ on redimensionne / on convertie en jpg
                            $img = new \abeautifulsite\SimpleImage($file);
                            $imdbId = uniqid();
                            $destination = $imdbId. ".jpg";
                            $img->best_fit(350, 520)->save(UPLOAD_DIR. $destination);
                            //on hydrate la propriété dans l'objet
                            $movie->setImdbId($imdbId);
                        }

                    }

                    //hydrate l'instance à partir des données du form
                    $movie->setTitle($_POST['title']);
                    $movie->setYear(intval($_POST['year'])); //je type en integer
                    $movie->setCast($_POST['cast']);
                    $movie->setDirectors($_POST['directors']);
                    $movie->setWriters($_POST['writers']);
                    $movie->setPlot($_POST['plot']);
                    $movie->setRuntime($_POST['runtime']);
                    $movie->setTrailerUrl($_POST['trailerUrl']);



                    //déclenche la validation de l'article, retourne true ou false
                    if($movie->isValid()){

                        //demande au manager de sauvegarder l'instance
                        $newMovie = $movieManager->create($movie);
                        $newMovieId = $newMovie->getId();

                        //je récupère l'id du nouveau film et les genres du form
                        $genreId = ($_POST['genre']);
                        //var_dump($_POST['genre']);
                        //j'inscris en Db les genres du nouveau film
                        $movieGenreManager = new MovieGenreManager();
                        foreach ($genreId as $value){
                            $movieGenreManager->setGenreMovie($newMovieId, $value);
                        }
                        $message = "Your movie was well created";


                    }
                    else{
                        $postErrors = $movie->getValidationErrors();

                    }
                }
                else{
                    $message = "Your movie title already exist";
                }

            }

        }
        else {
            header("Location: " . BASE_URL . "forbidden");
        }

        View::show("create.php", "Admin | Create", ["genres" =>$genres,
                                                    "message" =>$message,
                                                    "postErrors" =>$postErrors]);
    }

    public function AdminUpdateMovie()
    {
        //récupère  l'Id de l'article dans l'URL
        $id = $_GET['id'];

        //j'instancie mes managers
        $genreManager = new GenreManager();
        $movieManager = new MovieManager();

        //j'instancie un nouveau film, Trouve le film

        $updateMovie = $movieManager->findOneById($id);

        $message = NULL;
        $postErrors = NULL;

        //je retourne les genres pour faire mon form
        $genres = $genreManager->findAll();


        // si le formulaire est soumis
        if(!empty($_POST)){
            //les infos de l'image
            //var_dump($_FILES);


            //validation du fichier upload si un fichier a bien été envoyé
            if($_FILES['imdbId']['error'] != 4){
                $uploadError = null;

                //type mime
                $file = $_FILES['imdbId']['tmp_name'];
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, $file);
                finfo_close($finfo);
                //echo $mime;


                if(substr($mime, 0, 5) != "image"){
                    $uploadError = "MimeType invalide";
                }
                //taille
                if($_FILES['imdbId']['size'] > 1000000){
                    $uploadError = "Fichier trop lourd";
                }
                //vérifier les erreurs d'upload
                if($_FILES['imdbId']['error'] !== 0){
                    $uploadError = "Une erreur est survenue";
                }
                //si on a pas d'erreur ...
                if($uploadError == null){
                    //si ok on déplace/ on redimensionne / on convertie en jpg
                    $img = new \abeautifulsite\SimpleImage($file);
                    $imdbId = uniqid();
                    $destination = $imdbId. ".jpg";
                    $img->best_fit(350, 520)->save(UPLOAD_DIR. $destination);
                    //on hydrate la propriété dans l'objet
                    $updateMovie->setImdbId($imdbId);
                }

            }

            //hydrate l'instance à partir des données du form
            $updateMovie->setTitle($_POST['title']);
            $updateMovie->setYear(intval($_POST['year'])); //je type en integer
            $updateMovie->setCast($_POST['cast']);
            $updateMovie->setDirectors($_POST['directors']);
            $updateMovie->setWriters($_POST['writers']);
            $updateMovie->setPlot($_POST['plot']);
            $updateMovie->setRuntime($_POST['runtime']);
            $updateMovie->setTrailerUrl($_POST['trailerUrl']);


            //déclenche la validation du film, retourne true ou false
            if($updateMovie->isValid()){

                //demande au manager de sauvegarder l'instance
                $newMovieId = $movieManager->update($updateMovie);

                //je récupère l'id du nouveau film et les genres du form
                $genreId = ($_POST['genre']);
                //var_dump($_POST['genre']);
                //j'inscris en Db les genres du nouveau film
                $movieGenreManager = new MovieGenreManager();
                foreach ($genreId as $value){
                    $movieGenreManager->setGenreMovie($newMovieId, $value);
                }
                $message = "Your movie was well updated";

            }
            else{
                $postErrors = $updateMovie->getValidationErrors();

            }

        }
        View::show("update_movie.php", "Admin | Update Movie", ["updateMovie" => $updateMovie,
                                                                "genres" =>$genres,
                                                                "message" =>$message,
                                                                "postErrors" =>$postErrors]);
    }

    public function addMovieToWishlist()
    {

    }

    public function testBaseAlternative()
    {
        $layout = "base_alternative.php";
        View::show("home.php", "Movie | Accueil", ["layout" => $layout]);
    }
}

