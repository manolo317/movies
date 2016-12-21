<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 21/12/2016
 * Time: 15:52
 */

namespace Model\Entity;


class Genre
{
    private $id;
    private $name;
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
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }



}