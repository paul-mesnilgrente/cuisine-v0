<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuantiteIngredientListeDeCourse
 *
 * @ORM\Table(name="quantite_ingredient_liste_de_course")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QuantiteIngredientListeDeCourseRepository")
 */
class QuantiteIngredientListeDeCourse
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;

    /**
     * @var Unite
     *
     * @ORM\ManyToOne(targetEntity="Unite")
     */
    private $unite;

    /**
     * @var Ingredient
     *
     * @ORM\ManyToOne(targetEntity="Ingredient")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ingredient;

    /**
     * @var ListeDeCourse
     *
     * @ORM\ManyToOne(targetEntity="ListeDeCourse", inversedBy="ingredients", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $listeDeCourse;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return QuantiteIngredientListeDeCourse
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set recette
     *
     * @param \AppBundle\Entity\ListeDeCourse $recette
     *
     * @return QuantiteIngredientListeDeCourse
     */
    public function setRecette(\AppBundle\Entity\ListeDeCourse $recette)
    {
        $this->recette = $recette;

        return $this;
    }

    /**
     * Get recette
     *
     * @return \AppBundle\Entity\ListeDeCourse
     */
    public function getRecette()
    {
        return $this->recette;
    }

    /**
     * Set unite
     *
     * @param \AppBundle\Entity\Unite $unite
     *
     * @return QuantiteIngredientListeDeCourse
     */
    public function setUnite(\AppBundle\Entity\Unite $unite = null)
    {
        $this->unite = $unite;

        return $this;
    }

    /**
     * Get unite
     *
     * @return \AppBundle\Entity\Unite
     */
    public function getUnite()
    {
        return $this->unite;
    }

    /**
     * Set ingredient
     *
     * @param \AppBundle\Entity\Ingredient $ingredient
     *
     * @return QuantiteIngredientListeDeCourse
     */
    public function setIngredient(\AppBundle\Entity\Ingredient $ingredient)
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    /**
     * Get ingredient
     *
     * @return \AppBundle\Entity\Ingredient
     */
    public function getIngredient()
    {
        return $this->ingredient;
    }

    /**
     * Set listeDeCourse
     *
     * @param \AppBundle\Entity\ListeDeCourse $listeDeCourse
     *
     * @return QuantiteIngredientListeDeCourse
     */
    public function setListeDeCourse(\AppBundle\Entity\ListeDeCourse $listeDeCourse)
    {
        $this->listeDeCourse = $listeDeCourse;

        return $this;
    }

    /**
     * Get listeDeCourse
     *
     * @return \AppBundle\Entity\ListeDeCourse
     */
    public function getListeDeCourse()
    {
        return $this->listeDeCourse;
    }

    public function __toString() {
        $var = '';
        if ($this->unite === null && $this->quantite > 1) {
            $var = $var.$this->quantite.' ';
        }
        $var = $var.$this->ingredient->getNom();
        if ($this->unite !== null) {
            $var = $var.' : '.$this->quantite.' '.$this->unite->getNom();
        }
        return $var;
    }
}
