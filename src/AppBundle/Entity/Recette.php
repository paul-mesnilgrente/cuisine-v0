<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Recette
 *
 * @ORM\Table(name="recette")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RecetteRepository")
 */
class Recette
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"nom"})
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @var Datetime
     *
     * @ORM\Column(name="date", type="datetime", unique=false)
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="note", type="integer")
     */
    private $note;

    /**
     * @var CategorieRecette
     *
     * @ORM\ManyToOne(targetEntity="CategorieRecette")
     */
    private $categorieRecette;

    /**
     * @var QuantiteIngredientRecette
     *
     * @ORM\OneToMany(targetEntity="QuantiteIngredientRecette", mappedBy="recette", cascade={"persist"})
     */
    private $ingredients;

    /**
     * @var string
     *
     * @ORM\Column(name="etapes", type="simple_array")
     */
    private $etapes;

    /**
     * @var TagRecette
     *
     * @ORM\ManyToMany(targetEntity="TagRecette")
     */
    private $tags;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Recette
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Recette
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Recette
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
     * Set note
     *
     * @param integer $note
     *
     * @return Recette
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return integer
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set etapes
     *
     * @param array $etapes
     *
     * @return Recette
     */
    public function setEtapes($etapes)
    {
        $this->etapes = $etapes;

        return $this;
    }

    /**
     * Get etapes
     *
     * @return array
     */
    public function getEtapes()
    {
        return $this->etapes;
    }

    /**
     * Set categorieRecette
     *
     * @param \AppBundle\Entity\CategorieRecette $categorieRecette
     *
     * @return Recette
     */
    public function setCategorieRecette(\AppBundle\Entity\CategorieRecette $categorieRecette = null)
    {
        $this->categorieRecette = $categorieRecette;

        return $this;
    }

    /**
     * Get categorieRecette
     *
     * @return \AppBundle\Entity\CategorieRecette
     */
    public function getCategorieRecette()
    {
        return $this->categorieRecette;
    }

    /**
     * Add ingredient
     *
     * @param \AppBundle\Entity\QuantiteIngredientRecette $ingredient
     *
     * @return Recette
     */
    public function addIngredient(\AppBundle\Entity\QuantiteIngredientRecette $ingredient)
    {
        $this->ingredients[] = $ingredient;
        $ingredient->setRecette($this);

        return $this;
    }

    /**
     * Remove ingredient
     *
     * @param \AppBundle\Entity\QuantiteIngredientRecette $ingredient
     */
    public function removeIngredient(\AppBundle\Entity\QuantiteIngredientRecette $ingredient)
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
     * Add tag
     *
     * @param \AppBundle\Entity\TagRecette $tag
     *
     * @return Recette
     */
    public function addTag(\AppBundle\Entity\TagRecette $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \AppBundle\Entity\TagRecette $tag
     */
    public function removeTag(\AppBundle\Entity\TagRecette $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->date = new \Datetime();
        $this->ingredients = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }
}
