<?php

namespace Model\Entity;

class Movie
{
	private $id; 					//clef primaire
    private $imldbId;
    private $title;
    private $year;
    private $cast;
    private $directors;
    private $writers;
    private $plot;
    private $rating;
    private $votes;
    private $runtime;
    private $trailerUrl;
	private $validationErrors = []; //contient les erreurs de validation

	/**
	 * Retourne un booléen en fonction de si l'entité est valide pour une insertion en bdd
	 */
	public function isValid()
	{
		$isValid = true;

		//valider les données de l'instance ici 

		return $isValid;
	}

	/**
	 * getter pour les erreurs de validation
	 */
	public function getValidationErrors()
	{
		return $this->validationErrors;
	}

	/**
	 * Pas besoin de setter pour l'id, MySQL s'en charge
	 */
	public function getId()
	{
		return $this->id;
	}

    /**
     * @return mixed
     */
    public function getImdbId()
    {
        return $this->imdbId;
    }

    /**
     * @param mixed $imldbId
     */
    public function setImdbId($imldbId)
    {
        $this->imdbId = $imldbId;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getCast()
    {
        return $this->cast;
    }

    /**
     * @param mixed $cast
     */
    public function setCast($cast)
    {
        $this->cast = $cast;
    }

    /**
     * @return mixed
     */
    public function getDirectors()
    {
        return $this->directors;
    }

    /**
     * @param mixed $directors
     */
    public function setDirectors($directors)
    {
        $this->directors = $directors;
    }

    /**
     * @return mixed
     */
    public function getWriters()
    {
        return $this->writers;
    }

    /**
     * @param mixed $writers
     */
    public function setWriters($writers)
    {
        $this->writers = $writers;
    }

    /**
     * @return mixed
     */
    public function getPlot()
    {
        return $this->plot;
    }

    /**
     * @param mixed $plot
     */
    public function setPlot($plot)
    {
        $this->plot = $plot;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return mixed
     */
    public function getVotes()
    {
        return $this->votes;
    }

    /**
     * @param mixed $votes
     */
    public function setVotes($votes)
    {
        $this->votes = $votes;
    }

    /**
     * @return mixed
     */
    public function getRuntime()
    {
        return $this->runtime;
    }

    /**
     * @param mixed $runtime
     */
    public function setRuntime($runtime)
    {
        $this->runtime = $runtime;
    }

    /**
     * @return mixed
     */
    public function getTrailerUrl()
    {
        return $this->trailerUrl;
    }

    /**
     * @param mixed $trailerUrl
     */
    public function setTrailerUrl($trailerUrl)
    {
        $this->trailerUrl = $trailerUrl;
    }

}