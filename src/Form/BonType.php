<?php

namespace App\Form;

use App\Entity\Bon;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('datum')
            ->add('totaal_bedrag')
            ->add('Mederwerker_id')
            ->add('Klant_id')
            ->add('Bestelling_id')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bon::class,
        ]);
    }
}
