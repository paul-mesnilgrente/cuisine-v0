<?php

namespace AppBundle\Form;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use AppBundle\Form\DataTransformer\FindOrCreateTagTransformer;

class TagSelectorType extends AbstractType
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new FindOrCreateTagTransformer($this->manager);
        $builder->addModelTransformer($transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'invalid_message' => 'Une erreur est survenue',
        ));
    }

    public function getParent()
    {
        return TextType::class;
    }
}
