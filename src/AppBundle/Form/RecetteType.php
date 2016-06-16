<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RecetteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('note', ChoiceType::class, array(
                'choices' => array(
                    1 => 'Mauvais',
                    2 => 'Pas super',
                    3 => 'Bon',
                    4 => 'Très bon',
                    5 => 'Excellent',
                )
            ))

            ->add('ingredients', CollectionType::class, array(
                'entry_type' => QuantiteIngredientRecetteType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false))

            ->add('etapes', CollectionType::class, array(
                'entry_type' => TextareaType::class,
                'allow_add' => true,
                'allow_delete' => true))
            
            ->add('categorieRecette', 'entity', array(
                'class' => 'AppBundle:CategorieRecette',
                'property' => 'nom',
                'multiple' => false,
                'expanded' => true))

            ->add('tags', 'entity', array(
                'class' => 'AppBundle:TagRecette',
                'property' => 'nom',
                'multiple' => true,
                'expanded' => true))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Recette'
        ));
    }
}