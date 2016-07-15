<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @var Rayon
     *
     * @ORM\ManyToMany(targetEntity="Rayon", mappedBy="ingredients")
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
}
