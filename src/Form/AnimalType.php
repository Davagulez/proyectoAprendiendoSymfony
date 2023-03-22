<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\{FormType, TextType, SubmitType};

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('tipo', TextType::class, [
            'label' => 'Tipo de Animal'
        ])
        ->add('color', TextType::class)
        ->add('raza', TextType::class)
        ->add('send', SubmitType::class, [
            'label' => 'Crear Animal',
            'attr' => ['class' => 'btn btn-success']
        ]);     
    }
}
