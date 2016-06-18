<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EntreePlanningType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('midi', ChoiceType::class, array(
                'label' => 'Repas',
                'expanded' => true,
                'choices' => array(
                    true => 'Midi',
                    false => 'Soir')
                ))
            ->add('date')
            ->add('recette', EntityType::class, array(
                'class' => 'AppBundle:Recette',
                'property' => 'nom',
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
            'data_class' => 'AppBundle\Entity\EntreePlanning'
        ));
    }
}
