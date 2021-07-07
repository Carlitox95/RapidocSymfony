<?php
namespace App\Form;

use App\Entity\Empleador;
use App\Entity\Persona;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class EmpleadorSeleccionType extends AbstractType
{
    public function buildForm (FormBuilderInterface $builder,array $options) {
     $builder        
        ->add('Empleador', EntityType::class, 
        	[
             'class' => Empleador::class,
             'attr' => ['class' => 'browser-default row'],
             'expanded' => false,
             'multiple' => false,
             'placeholder' => 'Seleccione un Empleador',
             'empty_data' => 'No existen empleadores registrados',
             'choice_label' => function ($empleador) {
                 return $empleador->getApellido().",".$empleador->getNombre()." - CUIT/CUIL:".$empleador->getCuitCuil();
                }
            ]
        )
        ->add('save', SubmitType::class,array('label'=>'Guardar','attr' => ['class' => 'waves-effect waves-light btn blue lighten-2 white-text']));
    }
}
