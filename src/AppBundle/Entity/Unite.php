<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Unite
 *
 * @ORM\Table(name="unite")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UniteRepository")
 */
class Unite
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
     * @var string
     *
     * @ORM\Column(name="pluriel", type="string", length=255, unique=true)
     */
    private $pluriel;

    /**
     * @var string
     *
     * @ORM\Column(name="abrege", type="string", length=10, unique=true)
     */
    private $abrege;

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
     * @return Unite
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
     * Set abrege
     *
     * @param string $abrege
     *
     * @return Unite
     */
    public function setAbrege($abrege)
    {
        $this->abrege = $abrege;

        return $this;
    }

    /**
     * Get abrege
     *
     * @return string
     */
    public function getAbrege()
    {
        return $this->abrege;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Unite
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
     * Set pluriel
     *
     * @param string $pluriel
     *
     * @return Unite
     */
    public function setPluriel($pluriel)
    {
        $this->pluriel = $pluriel;

        return $this;
    }

    /**
     * Get pluriel
     *
     * @return string
     */
    public function getPluriel()
    {
        return $this->pluriel;
    }
}
