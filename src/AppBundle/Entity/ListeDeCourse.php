<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ListeDeCourse
 *
 * @ORM\Table(name="liste_de_course")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ListeDeCourseRepository")
 */
class ListeDeCourse
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
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;
    
    /**
     * @var Datetime
     *
     * @ORM\Column(name="date", type="date", unique=false)
     */
    private $date;

    /**
     * @var QuantiteIngredientRecette
     *
     * @ORM\OneToMany(targetEntity="QuantiteIngredientListeDeCourse", mappedBy="ingredient", cascade={"persist"})
     */
    private $ingredients;

    /**
     * @var QuantiteProduit
     *
     * @ORM\OneToMany(targetEntity="QuantiteProduit", mappedBy="produit", cascade={"persist"})
     */
    private $produits;

    /**
     * Constructor
     */
    public function __construct($user)
    {
        $this->user = $user;
        $this->date = new \Datetime();
        $this->ingredients = new \Doctrine\Common\Collections\ArrayCollection();
        $this->produits = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return ListeDeCourse
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Add ingredient
     *
     * @param \AppBundle\Entity\QuantiteIngredientListeDeCourse $ingredient
     *
     * @return ListeDeCourse
     */
    public function addIngredient(\AppBundle\Entity\QuantiteIngredientListeDeCourse $ingredient)
    {
        $this->ingredients[] = $ingredient;

        return $this;
    }

    /**
     * Remove ingredient
     *
     * @param \AppBundle\Entity\QuantiteIngredientListeDeCourse $ingredient
     */
    public function removeIngredient(\AppBundle\Entity\QuantiteIngredientListeDeCourse $ingredient)
    {
        $this->ingredients->removeElement($ingredient);
    }

    /**
     * Get ingredients
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * Add produit
     *
     * @param \AppBundle\Entity\QuantiteProduit $produit
     *
     * @return ListeDeCourse
     */
    public function addProduit(\AppBundle\Entity\QuantiteProduit $produit)
    {
        $this->produits[] = $produit;

        return $this;
    }

    /**
     * Remove produit
     *
     * @param \AppBundle\Entity\QuantiteProduit $produit
     */
    public function removeProduit(\AppBundle\Entity\QuantiteProduit $produit)
    {
        $this->produits->removeElement($produit);
    }

    /**
     * Get produits
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProduits()
    {
        return $this->produits;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return ListeDeCourse
     */
    public function setUser(\AppBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
