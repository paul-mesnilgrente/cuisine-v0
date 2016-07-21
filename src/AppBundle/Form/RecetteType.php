<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class RecetteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, array(
                'attr' => array('autofocus' => true)
                ))

            ->add('publique')

            ->add('note', ChoiceType::class, array(
                'choices' => array(
                    1 => 'Mauvais',
                    2 => 'Pas super',
                    3 => 'Bon',
                    4 => 'Très bon',
                    5 => 'Excellent')
            ))

            ->add('difficulte', ChoiceType::class, array(
                'choices' => array(
                    1 => '1',
                    2 => '2',
                    3 => '3',
                    4 => '4',
                    5 => '5')
            ))

            ->add('tempsDePreparation')
            
            ->add('tempsDeCuisson')

            ->add('ingredients', CollectionType::class, array(
                'entry_type' => QuantiteIngredientRecetteType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
                'attr' => array('class' => 'liste_ingredient')
                ))

            ->add('etapes', CollectionType::class, array(
                'entry_type' => TextareaType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'attr' => array('class' => 'liste_etape')
                ))
            
            ->add('categorieRecette', EntityType::class, array(
                'class' => 'AppBundle:CategorieRecette',
                'choice_label' => 'nom',
                'multiple' => false,
                'expanded' => true))

            ->add('tags', EntityType::class, array(
                'class' => 'AppBundle:TagRecette',
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => true))
            
            ->add('imageFile', VichImageType::class, array(
                'required'      => false,
                'allow_delete'  => true, // not mandatory, default is true
                'download_link' => true, // not mandatory, default is true
            ))
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
