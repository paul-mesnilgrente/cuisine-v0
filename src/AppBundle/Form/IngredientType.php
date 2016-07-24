<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class IngredientType extends AbstractType
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

            ->add('rayons', EntityType::class, array(
                'class' => 'AppBundle:Rayon',
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => true))

            ->add('categorie', EntityType::class, array(
                'class' => 'AppBundle:CategorieIngredient',
                'choice_label' => 'nom',
                'multiple' => false,
                'expanded' => true))

            ->add('imageFile', 'vich_image', array(
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
            'data_class' => 'AppBundle\Entity\Ingredient'
        ));
    }
}
