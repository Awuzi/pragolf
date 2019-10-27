<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UploadTrouType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("Trou1", TextType::class)
            ->add("Trou2", TextType::class)
            ->add("Trou3", TextType::class)
            ->add("Trou4", TextType::class)
            ->add("Trou5", TextType::class)
            ->add("Trou6", TextType::class)
            ->add("Trou6", TextType::class)
            ->add("Trou7", TextType::class)
            ->add("Trou8", TextType::class)
            ->add("Trou9", TextType::class)
            ->add("Trou10", TextType::class)
            ->add("Trou11", TextType::class)
            ->add("Trou12", TextType::class)
            ->add("Trou13", TextType::class)
            ->add("Trou14", TextType::class)
            ->add("Trou15", TextType::class)
            ->add("Trou16", TextType::class)
            ->add("Trou17", TextType::class)
            ->add("Trou18", TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
