<?php
namespace App\Form;

use App\Entity\Empleador;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class EmpleadorType extends AbstractType
{
    public function buildForm (FormBuilderInterface $builder,array $options) {
     $builder        
        ->add('nombre',TextType::class,array('label'=>'Nombre','attr' => ['class' => 'input-field col s12']))
        ->add('apellido',TextType::class,array('label'=>'Apellido','attr' => ['class' => 'input-field col s12']))
        ->add('dni',TextType::class,array('label'=>'DNI','attr' => ['class' => 'input-field col s12']))        
        ->add('cuitcuil',TextType::class,array('label'=>'CUIT/CUIL','attr' => ['class' => 'input-field col s12']))        
        ->add('mail',TextType::class,array('label'=>'Mail','attr' => ['class' => 'input-field col s12']))
        ->add('save', SubmitType::class,array('label'=>'Guardar','attr' => ['class' => 'waves-effect waves-light btn blue lighten-2 white-text']));
    }
}
