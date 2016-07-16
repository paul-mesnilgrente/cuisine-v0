<?php

namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\Issue;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class StringToProduitTransformer implements DataTransformerInterface
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
    public function transform($produit)
    {
        if (null === $produit) {
            return '';
        }

        return $produit->getNom();
    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param  string $nomIngredient
     * @return Issue|null
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($nomProduit)
    {
        $produit = $this->manager->getRepository('AppBundle:Produit')
            // query for the issue with this name
            ->findOneByNom($nomProduit);

        if (null === $produit) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(
                            "L'ingrédient avec le nom " .$nomProduit."n'existe pas");
        }

        return $produit;
    }
}
