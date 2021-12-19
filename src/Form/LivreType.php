<?php

namespace App\Form;

use App\Entity\Livre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isbn', null, array('attr' => array('class' => 'form-control')))
            ->add('titre', null, array('attr' => array('class' => 'form-control')))
            ->add('nbpages', null, array('attr' => array('class' => 'form-control')))
            ->add('date_de_parution', DateType::class, array(
                'widget' => 'choice',
                'years' => range(date('Y'), date('Y') - 200),
                'attr' => array('class' => 'form-control')
            ))
            ->add('note', null, array('attr' => array('class' => 'form-control')))
            ->add('auteur', null, array('attr' => array('class' => 'form-control')))
            ->add('genre', null, array('attr' => array('class' => 'form-control')));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
