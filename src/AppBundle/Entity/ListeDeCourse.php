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
     * @var EntreeListe
     *
     * @ORM\OneToMany(targetEntity="EntreeListe", mappedBy="liste", cascade={"persist"})
     */
    private $entrees;

    /**
     * Constructor
     */
    public function __construct($user)
    {
        $this->user = $user;
        $this->date = new \Datetime();
        $this->entree = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Add entree
     *
     * @param \AppBundle\Entity\EntreeListe $entree
     *
     * @return ListeDeCourse
     */
    public function addEntree(\AppBundle\Entity\EntreeListe $entree)
    {
        $this->entree[] = $entree;

        return $this;
    }

    /**
     * Remove entree
     *
     * @param \AppBundle\Entity\EntreeListe $entree
     */
    public function removeEntree(\AppBundle\Entity\EntreeListe $entree)
    {
        $this->entree->removeElement($entree);
    }

    /**
     * Get entree
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntree()
    {
        return $this->entree;
    }

    /**
     * Get entrees
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntrees()
    {
        return $this->entrees;
    }
}
