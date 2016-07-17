<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class QuantiteIngredientRecetteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantite')
            
            ->add('ingredient', EntityType::class, array(
                'class' => 'AppBundle:Ingredient',
                'choice_label' => 'nom',
                'multiple' => false,
                'expanded' => false))

            ->add('unite', EntityType::class, array(
                'class' => 'AppBundle:Unite',
                'choice_label' => 'nom',
                'multiple' => false,
                'expanded' => false))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\QuantiteIngredientRecette'
        ));
    }
}
