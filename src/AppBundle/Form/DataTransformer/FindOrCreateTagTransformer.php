<?php

namespace AppBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

use AppBundle\Entity\TagRecette;

class FindOrCreateTagTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param  Issue|null $issue
     * @return string
     */
    public function transform($tags)
    {
        if (null === $tags) {
            return '';
        }

        $result = '';
        for ($i=0; $i < count($tags) - 1; $i++) { 
            $result = $result.$tags[$i]->getNom().', ';
        }
        // $result = $result.$tags[count($tags) - 1]->getNom();

        return $result;
    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param  string $tags
     * @return Issue|null
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($nomTags)
    {
        $repo = $this->manager->getRepository('AppBundle:TagRecette');
        $result = array();
        foreach (explode(', ', $nomTags) as $nomTag) {
            $tag = $repo->findOneByNom($nomTag);

            if (null === $tag) {
                $tag = new TagRecette();
                $tag->setNom($nomTag);
            }
            $this->manager->persist($tag);
            $this->manager->flush();
            array_push($result, $tag);
        }
        return $result;
    }
}
