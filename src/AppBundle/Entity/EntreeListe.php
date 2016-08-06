<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EntreeListe
 *
 * @ORM\Table(name="entree_liste")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EntreeListeRepository")
 */
class EntreeListe
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
     * @var Produit
     *
     * @ORM\ManyToOne(targetEntity="Produit")
     */
    private $produit;

    /**
     * @var Rayon
     *
     * @ORM\ManyToOne(targetEntity="Rayon")
     */
    private $rayon;
    
    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer", nullable=true)
     */
    private $quantite;
    
    /**
     * @var Unite
     *
     * @ORM\ManyToOne(targetEntity="Unite", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $unite;

    /**
     * @var ListeDeCourse
     *
     * @ORM\ManyToOne(targetEntity="ListeDeCourse", inversedBy="entrees")
     */
    private $liste;

    public function __construct($liste) {
        $this->produit = null;
        $this->ingredient = null;
        $this->liste = $liste;
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
     * Set ingredient
     *
     * @param \AppBundle\Entity\Ingredient $ingredient
     *
     * @return EntreeListe
     */
    public function setIngredient(\AppBundle\Entity\Ingredient $ingredient = null)
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
     * Set produit
     *
     * @param \AppBundle\Entity\Produit $produit
     *
     * @return EntreeListe
     */
    public function setProduit(\AppBundle\Entity\Produit $produit = null)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get produit
     *
     * @return \AppBundle\Entity\Produit
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * Set rayon
     *
     * @param \AppBundle\Entity\Rayon $rayon
     *
     * @return EntreeListe
     */
    public function setRayon(\AppBundle\Entity\Rayon $rayon = null)
    {
        $this->rayon = $rayon;

        return $this;
    }

    /**
     * Get rayon
     *
     * @return \AppBundle\Entity\Rayon
     */
    public function getRayon()
    {
        return $this->rayon;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return EntreeListe
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set unite
     *
     * @param \AppBundle\Entity\Unite $unite
     *
     * @return EntreeListe
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
     * Set liste
     *
     * @param \AppBundle\Entity\ListeDeCourse $liste
     *
     * @return EntreeListe
     */
    public function setListe(\AppBundle\Entity\ListeDeCourse $liste = null)
    {
        $this->liste = $liste;

        return $this;
    }

    /**
     * Get liste
     *
     * @return \AppBundle\Entity\ListeDeCourse
     */
    public function getListe()
    {
        return $this->liste;
    }
}
