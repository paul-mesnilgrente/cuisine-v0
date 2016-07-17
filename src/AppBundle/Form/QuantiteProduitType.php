<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuantiteProduitType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantite')
            
            ->add('produit', 'entity', array(
                'class' => 'AppBundle:Produit',
                'choice_label' => 'nom',
                'multiple' => false,
                'expanded' => false))

            ->add('unite', 'entity', array(
                'class' => 'AppBundle:Unite',
                'choice_label' => 'abrege',
                'multiple' => false,
                'expanded' => false,
                'required' => false))
        ;
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
