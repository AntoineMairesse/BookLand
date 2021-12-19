<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class ISBNValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof ISBN) {
            throw new UnexpectedTypeException($constraint, ISBN::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }

        if (!preg_match('/(978|979)-[0-9]+-[0-9]+-[0-9]+-[0-9]+/', $value, $matches)) {
            // the argument must be a string or an object implementing __toString()
            $this->context->buildViolation($constraint->message1)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
            $this->context->buildViolation($constraint->message2)
                ->addViolation();
            $this->context->buildViolation($constraint->message3)
                ->addViolation();
        }

        //On compte le nombre de chiffres dans l'expression
        $value = strval($value);
        preg_replace_callback('/\d/', function ($m) use (&$count) {
            $count++;
        }, $value);

        //Soit X la somme des chiffres en position paire et soit Y la somme des chiffres en position
        //impaire (on considère que le chiffre le plus à droite est en position 1). 3X+Y doit être
        //divisible par 10.
        if(!$this->calcul($value)){
            $this->context->buildViolation($constraint->message4)
                ->addViolation();
        }

        if ($count != 13) {
            $this->context->buildViolation("Le code doit être composé de 13 chiffres 
            organisés en 5 groupes séparés par des traits d'union")
                ->addViolation();
            return;
        }

        //On compte le nombre de traits d'union dans l'expression
        $count = 0;
        preg_replace_callback('/-/', function () use (&$count) {
            $count++;
        }, $value);

        if ($count != 4) {
            $this->context->buildViolation("Le code doit être composé de 13 chiffres 
            organisés en 5 groupes séparés par des traits d'union")
                ->addViolation();
        }
    }

    private function calcul($value): bool
    {
        $X = 0;
        $Y = 0;
        $index = 1;
        $order = 1;
        while(($val = substr($value, $index-1, 1)) != ''){
            if (preg_match('/\d/', $val, $matches)) {
                if ($order == 0) {
                    $X += intval($val);
                    $order = 1;
                } else if ($order == 1) {
                    $Y += intval($val);
                    $order = 0;
                }
            }
            $index++;
        }
        $test = ((((3*$X)+$Y) % 10));
        if($X = 0 && $Y == 0){
            return false;
        }
        else if($test == 0){
            return true;
        } else {
            return false;
        }
    }
}