<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Form\DataTransformer\StringToIngredientTransformer;

class QuantiteIngredientRecetteType extends AbstractType
{
    private $manager;
    private $router;
    
    public function __construct(ObjectManager $manager, $router) {
        $this->manager = $manager;
        $this->router = $router;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $route = $this->router->generate("ajouter_ingredient");
        $lien = '<a href="'.$route.'">ici</a>';
        $message = "Cet ingrédient n'existe pas.";
        $message = $message." Cliquer ".$lien." pour l'ajouter.";

        $builder
            ->add('quantite', IntegerType::class)
            
            ->add('ingredient', TextType::class, array(
                'invalid_message' => $message))

            ->add('unite', EntityType::class, array(
                'class' => 'AppBundle:Unite',
                'choice_label' => 'nom',
                'multiple' => false,
                'expanded' => false))
        ;

        $builder->get('ingredient')
                ->addModelTransformer(new StringToIngredientTransformer(
                    $this->manager, $this->router));
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
