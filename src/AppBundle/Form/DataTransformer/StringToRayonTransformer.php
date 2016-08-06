<?php

namespace AppBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

use AppBundle\Entity\Rayon;

class StringToRayonTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param  Issue|null $issue
     * @return string
     */
    public function transform($rayon)
    {
        if (null === $rayon) {
            return '';
        }

        return $rayon->getNom();
    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param  string $string
     * @return Issue|null
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($string)
    {
        $tab = explode(' : ', $string);
        $rayon = $this->manager->getRepository('AppBundle:Rayon')
            // query for the issue with this name
            ->findOneByNom($tab[0]);

        if (null === $rayon) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(
                            "Le rayon ".$string."n'existe pas.");
        }

        return $rayon;
    }
}
