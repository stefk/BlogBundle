<?php

namespace ICAP\BlogBundle\Form;

use ICAPLyon1\Bundle\SimpleTagBundle\Repository\TagRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content', 'textarea')
            ->add('tags', 'entity', array(
                'mapped'        => false,
                'required'      => false,
                'multiple'      => true,
                'expanded'      => true,
                'class'         => 'ICAPLyon1SimpleTagBundle:Tag',
                'query_builder' => function(TagRepository $repository) {
                    return $repository->getTagsQueryBuilder();
                },
            ))
        ;
    }

    public function getName()
    {
        return 'icap_blog_post_form';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => 'icap_blog',
            'data_class'      => 'ICAP\BlogBundle\Entity\Post',
            'csrf_protection' => true,
            'intention'       => 'create_post'
        ));
    }
}