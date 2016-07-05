<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="`my_user`")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"username"})
     * @ORM\Column(name="slug_user", type="string", length=255, unique=true)
     */
    private $slugUser;

    /**
     * Set slugUser
     *
     * @param string $slugUser
     *
     * @return User
     */
    public function setSlugUser($slugUser)
    {
        $this->slugUser = $slugUser;

        return $this;
    }

    /**
     * Get slugUser
     *
     * @return string
     */
    public function getSlugUser()
    {
        return $this->slugUser;
    }
}
