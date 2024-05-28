<?php

namespace App\Form;

use App\Entity\Audiance;
use App\Entity\Dossier;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Audiance1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('room')
            ->add('courtDate', null, [
                'widget' => 'single_text'
            ])
            ->add('dossier', EntityType::class, [
                'class' => Dossier::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Audiance::class,
        ]);
    }
}
