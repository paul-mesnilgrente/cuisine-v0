<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EntreePlanning
 *
 * @ORM\Table(name="entree_planning")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EntreePlanningRepository")
 */
class EntreePlanning
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
     * @var bool
     *
     * @ORM\Column(name="midi", type="boolean")
     */
    private $midi;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var Recette
     * 
     * @ORM\ManyToMany(targetEntity="Recette", cascade={"persist"})
     */
    private $recettes;

    public function __construct() {
        $this->date = new \Datetime();
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
     * Set midi
     *
     * @param boolean $midi
     *
     * @return EntreePlanning
     */
    public function setMidi($midi)
    {
        $this->midi = $midi;

        return $this;
    }

    /**
     * Get midi
     *
     * @return bool
     */
    public function getMidi()
    {
        return $this->midi;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return EntreePlanning
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
     * Add recette
     *
     * @param \AppBundle\Entity\Recette $recette
     *
     * @return EntreePlanning
     */
    public function addRecette(\AppBundle\Entity\Recette $recette)
    {
        $this->recettes[] = $recette;

        return $this;
    }

    /**
     * Remove recette
     *
     * @param \AppBundle\Entity\Recette $recette
     */
    public function removeRecette(\AppBundle\Entity\Recette $recette)
    {
        $this->recettes->removeElement($recette);
    }

    /**
     * Get recettes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRecettes()
    {
        return $this->recettes;
    }
}
