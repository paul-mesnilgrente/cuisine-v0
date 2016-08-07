<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Form\DataTransformer\StringToProduitTransformer;
use AppBundle\Form\DataTransformer\StringToRayonTransformer;

class EntreeListeType extends AbstractType
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
            ->add('rayonProduit', TextType::class, array(
                'invalid_message' => 'Aucun ingrédient correspondant'))

            ->add('quantite', IntegerType::class)

            ->add('unite', EntityType::class, array(
                'class' => 'AppBundle:Unite',
                'choice_label' => 'nom',
                'multiple' => false,
                'expanded' => false,
                'required' => false))

            ->add('valider', SubmitType::class);

            /*$builder->get('produit')
                ->addModelTransformer(new StringToProduitTransformer($this->manager));
            $builder->get('produit')
                ->addModelTransformer(new StringToRayonTransformer($this->manager));*/
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\EntreeListe'
        ));
    }
}
