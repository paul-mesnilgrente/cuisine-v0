<?php

namespace AppBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

use AppBundle\Entity\Ingredient;

class StringToIngredientTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Transforms an object (ingredient) to a string (number).
     *
     * @param  Ingredient|null $ingredient
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
     * Transforms a string (number) to an object (ingredient).
     *
     * @param  string $nomIngredient
     * @return Ingredient|null
     * @throws TransformationFailedException if object (ingredient) is not found.
     */
    public function reverseTransform($nomIngredient)
    {
        $ingredient = $this->manager->getRepository('AppBundle:Ingredient')
            // query for the ingredient with this name
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
