<?php

namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\Issue;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class StringToIngredientTransformer implements DataTransformerInterface
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
    public function transform($ingredient)
    {
        if (null === $ingredient) {
            return '';
        }

        return $ingredient->getNom();
    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param  string $nomIngredient
     * @return Issue|null
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($nomIngredient)
    {
        $ingredient = $this->manager->getRepository('AppBundle:Ingredient')
            // query for the issue with this name
            ->findOneByNom($nomIngredient);

        if (null === $ingredient) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(
                            "L'ingrédient avec le nom " .$nomIngredient."n'existe pas");
        }

        return $ingredient;
    }
}
