<?php

namespace App\Form;

use App\Entity\Auteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_prenom', null, array('attr' => array('class' => 'form-control')))
            ->add('sexe', ChoiceType::class, ['choices' => ['Homme' => 'M', 'Femme' => 'F'], 'attr' => array('class' => 'form-control')])
            ->add('date_de_naissance', DateType::class, array(
                'widget' => 'choice',
                'years' => range(date('Y'), date('Y') - 200),
                'attr' => array('class' => 'form-control')
            ))
            ->add('nationalite', null, array('attr' => array('class' => 'form-control')))//->add('livres')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Auteur::class,
        ]);
    }
}
