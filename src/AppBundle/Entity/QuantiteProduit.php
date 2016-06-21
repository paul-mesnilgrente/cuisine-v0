<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuantiteProduit
 *
 * @ORM\Table(name="quantite_produit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QuantiteProduitRepository")
 */
class QuantiteProduit
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
     * @ORM\Column(name="quantite", type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @var Produit
     *
     * @ORM\ManyToOne(targetEntity="Produit", cascade={"persist"})
     */
    private $produit;

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
     * @ORM\ManyToOne(targetEntity="ListeDeCourse", inversedBy="produits")
     */
    private $listeDeCourse;

    public function __construct()
    {
        $this->quantite = 1;
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
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return QuantiteProduit
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
     * Set produit
     *
     * @param \AppBundle\Entity\Produit $produit
     *
     * @return QuantiteProduit
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
     * Set unite
     *
     * @param \AppBundle\Entity\Unite $unite
     *
     * @return QuantiteProduit
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
     * Set listeDeCourse
     *
     * @param \AppBundle\Entity\ListeDeCourse $listeDeCourse
     *
     * @return QuantiteProduit
     */
    public function setListeDeCourse(\AppBundle\Entity\ListeDeCourse $listeDeCourse = null)
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
}
