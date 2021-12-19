<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ISBN extends Constraint
{
    public $message1 = 'ISBN "{{ string }}" incorrect :';
    public $message2 = 'le code doit être composé de 13 chiffres organisés en 5 groupes séparés par des traits d’union';
    public $message3 = 'le premier groupe doit commencer soit par 978 soit par 979';
    public $message4 = 'Soit X la somme des chiffres en position paire et soit Y la somme des chiffres en position
    impaire (on considère que le chiffre le plus à droite est en position 1). 3X+Y doit être
        divisible par 10.';
}