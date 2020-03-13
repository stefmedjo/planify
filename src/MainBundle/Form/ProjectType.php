<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ProjectType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('code',TextType::class, ['attr' => ['class' => 'form-control']])
        ->add('name',TextType::class, ['attr' => ['class' => 'form-control']])
        ->add('description',TextareaType::class,['required'=> false,'attr' => ['required'=> false,'class' => 'form-control']])
        ->add('isClosed',CheckboxType::class,['attr'=> ['required'=> false],'required'=> false]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MainBundle\Entity\Project'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mainbundle_project';
    }


}
