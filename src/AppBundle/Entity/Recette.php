<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Recette
 *
 * @ORM\Table(name="recette")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RecetteRepository")
 * @Vich\Uploadable
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
     * @var boolean
     * @ORM\Column(name="publique", type="boolean", unique=false)
     */
    private $publique;

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
     * @var int
     *
     * @ORM\Column(name="temps_de_preparation", type="integer")
     */
    private $tempsDePreparation;

    /**
     * @var int
     *
     * @ORM\Column(name="temps_de_cuisson", type="integer")
     */
    private $tempsDeCuisson;

    /**
     * @var int
     *
     * @ORM\Column(name="difficulte", type="integer")
     */
    private $difficulte;

    /**
     * @var CategorieRecette
     *
     * @ORM\ManyToOne(targetEntity="CategorieRecette")
     */
    private $categorieRecette;

    /**
     * @var QuantiteIngredientRecette
     *
     * @ORM\OneToMany(targetEntity="QuantiteIngredientRecette", mappedBy="recette", cascade={"persist","remove"})
     */
    private $ingredients;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="Etape", mappedBy="recette", cascade={"persist","remove"})
     */
    private $etapes;

    /**
     * @var TagRecette
     *
     * @ORM\ManyToMany(targetEntity="TagRecette", cascade={"persist"})
     */
    private $tags;

    /**
     * @var File
     * 
     * @Vich\UploadableField(mapping="recette_image", fileNameProperty="imageName")
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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

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
     * Constructor
     */
    public function __construct($user)
    {
        $this->user = $user;
        $this->tempsDeCuisson = 0;
        $this->date = new \Datetime();
        $this->ingredients = new \Doctrine\Common\Collections\ArrayCollection();
        $this->etapes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set tempsDePreparation
     *
     * @param integer $tempsDePreparation
     *
     * @return Recette
     */
    public function setTempsDePreparation($tempsDePreparation)
    {
        $this->tempsDePreparation = $tempsDePreparation;

        return $this;
    }

    /**
     * Get tempsDePreparation
     *
     * @return integer
     */
    public function getTempsDePreparation()
    {
        return $this->tempsDePreparation;
    }

    /**
     * Set tempsDeCuisson
     *
     * @param integer $tempsDeCuisson
     *
     * @return Recette
     */
    public function setTempsDeCuisson($tempsDeCuisson)
    {
        $this->tempsDeCuisson = $tempsDeCuisson;

        return $this;
    }

    /**
     * Get tempsDeCuisson
     *
     * @return integer
     */
    public function getTempsDeCuisson()
    {
        return $this->tempsDeCuisson;
    }

    /**
     * Set difficulte
     *
     * @param integer $difficulte
     *
     * @return Recette
     */
    public function setDifficulte($difficulte)
    {
        $this->difficulte = $difficulte;

        return $this;
    }

    /**
     * Get difficulte
     *
     * @return integer
     */
    public function getDifficulte()
    {
        return $this->difficulte;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Recette
     */
    public function setUser(\AppBundle\Entity\User $user = null)
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

    /**
     * Set publique
     *
     * @param boolean $publique
     *
     * @return Recette
     */
    public function setPublique($publique)
    {
        $this->publique = $publique;

        return $this;
    }

    /**
     * Get publique
     *
     * @return boolean
     */
    public function getPublique()
    {
        return $this->publique;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Product
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param string $imageName
     *
     * @return Product
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Recette
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add etape
     *
     * @param \AppBundle\Entity\Etape $etape
     *
     * @return Recette
     */
    public function addEtape(\AppBundle\Entity\Etape $etape)
    {
        $this->etapes[] = $etape;
        $etape->setRecette($this);

        return $this;
    }

    /**
     * Remove etape
     *
     * @param \AppBundle\Entity\Etape $etape
     */
    public function removeEtape(\AppBundle\Entity\Etape $etape)
    {
        $this->etapes->removeElement($etape);
    }

    /**
     * Get etapes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEtapes()
    {
        return $this->etapes;
    }
}
