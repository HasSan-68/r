<?php

namespace App\Form;

use App\Entity\Bestellingen;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BestellingenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('voorgerecht')
            ->add('nagerecht')
            ->add('prijs')
            ->add('datum')
            ->add('Medewerker_id')
            ->add('Klant_id')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bestellingen::class,
        ]);
    }
}
