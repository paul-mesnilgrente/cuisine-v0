<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProduitRepository")
 */
class Produit
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
     * @var Rayon
     *
     * @ORM\ManyToMany(targetEntity="Rayon", inversedBy="produits", cascade={"persist"})
     */
    private $rayons;

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
     * Set nom
     *
     * @param string $nom
     *
     * @return Produit
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
     * Constructor
     */
    public function __construct()
    {
        $this->rayons = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add rayon
     *
     * @param \AppBundle\Entity\Rayon $rayon
     *
     * @return Produit
     */
    public function addRayon(\AppBundle\Entity\Rayon $rayon)
    {
        $this->rayons[] = $rayon;

        return $this;
    }

    /**
     * Remove rayon
     *
     * @param \AppBundle\Entity\Rayon $rayon
     */
    public function removeRayon(\AppBundle\Entity\Rayon $rayon)
    {
        $this->rayons->removeElement($rayon);
    }

    /**
     * Get rayons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRayons()
    {
        return $this->rayons;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Produit
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
}
