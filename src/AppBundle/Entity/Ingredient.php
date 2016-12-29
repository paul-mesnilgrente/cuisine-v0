<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

use AppBundle\Entity\Produit;

/**
 * Ingredient
 *
 * @ORM\Table(name="ingredient")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IngredientRepository")
 * @Vich\Uploadable
 */
class Ingredient extends Produit
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
     * @var CategorieIngredient
     *
     * @ORM\ManyToOne(targetEntity="CategorieIngredient", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $categorie;

    /**
     * @var Rayon
     *
     * @ORM\ManyToMany(targetEntity="Rayon", inversedBy="ingredients", cascade={"persist"})
     */
    private $rayons;

    /**
     * @var File
     * 
     * @Vich\UploadableField(mapping="ingredient_image", fileNameProperty="imageName")
     */
    private $imageFile;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

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
     * Set categorie
     *
     * @param \AppBundle\Entity\CategorieIngredient $categorie
     *
     * @return Ingredient
     */
    public function setCategorie(\AppBundle\Entity\CategorieIngredient $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \AppBundle\Entity\CategorieIngredient
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
}
