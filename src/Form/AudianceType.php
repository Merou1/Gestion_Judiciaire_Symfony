<?php
// src/Form/AudianceType.php

namespace App\Form;

use App\Entity\Audiance;
use App\Entity\Dossier;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AudianceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('room', TextType::class)
            ->add('courtDate', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Court Date'
            ])
            ->add('dossier', EntityType::class, [
                'class' => Dossier::class,
                'choice_label' => 'titre',
                'label' => 'Dossier'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Audiance::class,
        ]);
    }
}
