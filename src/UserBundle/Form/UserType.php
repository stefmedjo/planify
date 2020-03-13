<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('email',EmailType::class,array('attr' => array('class' => 'form-control','placeholder' => 'Email')))
            ->add('plainPassword',RepeatedType::class,array('type'=>PasswordType::class,'first_options'=>array('label'=>'Password','attr' => ['class' => 'form-control']),'second_options'=>array('label'=>'Repeat Password','attr' => ['class' => 'form-control'])))
        
            ->add('lname',TextType::class, array('attr' => array('class' => 'form-control','placeholder' => 'First Name')))
            ->add('fname',TextType::class, array('attr' => array('class' => 'form-control','placeholder' => 'Second Name')))
            ->add('companyName',TextType::class, array('attr' => array('class' => 'form-control','placeholder' => 'Second Name')))

            ;

    }

    

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\UserBundle\Entity\User',
        ]);
    }

}