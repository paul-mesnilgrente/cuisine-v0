<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Form\DataTransformer\StringToProduitTransformer;

class ProduitSearchType extends AbstractType
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('produit', TextType::class, array(
                'invalid_message' => 'Aucun ingrédient correspondant'))

            ->add('quantite', IntegerType::class)

            ->add('unite', EntityType::class, array(
                'class' => 'AppBundle:Unite',
                'property' => 'abrege',
                'multiple' => false,
                'expanded' => false,
                'required' => false))

            ->add('valider', 'submit');

            $builder->get('produit')
                ->addModelTransformer(new StringToProduitTransformer($this->manager));
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\QuantiteProduit'
        ));
    }
}
