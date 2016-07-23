<?php

namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\Issue;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class StringToTagTransformer implements DataTransformerInterface
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
    public function transform($tag)
    {
        if (null === $tag) {
            return '';
        }

        return $tag->getNom();
    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param  string $nomIngredient
     * @return Issue|null
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($nomTag)
    {
        $tag = $this->manager->getRepository('AppBundle:Tag')
            // query for the issue with this name
            ->findOneByNom($nomTag);

        if (null === $tag) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(
                            "L'ingrédient avec le nom " .$nomTag."n'existe pas");
        }

        return $tag;
    }
}
