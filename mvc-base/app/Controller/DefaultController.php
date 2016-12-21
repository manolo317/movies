<?php

namespace Controller;

use View\View; //on peut donc utiliser cette classe comme View au lieu de \View\View
use Model\Manager\MovieManager;
class DefaultController 
{
	/**
	 * Affiche la page d'accueil
	 */
	public function home()
	{
        $movieManager = new MovieManager();
        $movies = $movieManager->findAll();
        //var_dump($movies);

        View::show("home.php", "Movie | Accueil", ["movies" =>$movies]);

	}
    public function movieDetails()
    {
        $movieManager = new MovieManager();
        //créé le movie dont l'Id est dans l'URL
        $id = $_GET['id'];
        $movie = $movieManager->findOneById($id);
        //si le movie n'existe pas erreur 404
        if(empty($movie)){
            return $this->error404();
        }
        //affiche la vue en lui passant le post
        View::show("movie_details.php", $movie->getTitle(), ["movie" =>$movie]);
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
}

