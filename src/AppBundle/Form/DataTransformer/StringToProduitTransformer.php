<?php

namespace AppBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

use AppBundle\Entity\Produit;

class StringToProduitTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Transforms an object (produit) to a string (number).
     *
     * @param  Produit|null $produit
     * @return string
     */
    public function transform($produit)
    {
        if (null === $produit) {
            return '';
        }

        return $produit;
    }

    /**
     * Transforms a string (number) to an object (produit).
     *
     * @param  string $nomIngredient
     * @return Produit|null
     * @throws TransformationFailedException if object (produit) is not found.
     */
    public function reverseTransform($string)
    {
        $nomProduit = explode(' : ', $string)[1];
        $produit = $this->manager->getRepository('AppBundle:Produit')
            // query for the produit with this name
            ->findOneByNom($nomProduit);

        if (null === $produit) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(
                            "Le produit avec le nom ".$nomProduit."n'existe pas");
        }

        return $produit;
    }
}
