<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
            
            ->add('ingredient', 'entity', array(
                'class' => 'AppBundle:Ingredient',
                'choice_label' => 'nom',
                'multiple' => false,
                'expanded' => false))

            ->add('unite', 'entity', array(
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
