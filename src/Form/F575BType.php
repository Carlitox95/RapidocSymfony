<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class F575BType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        
        $builder        
         ->add('nombre',TextType::class,array('label'=>'Nombre','attr' => ['class' => 'input-field col s12']))
         ->add('apellido',TextType::class,array('label'=>'Apellido','attr' => ['class' => 'input-field col s12']))
         ->add('cuitcuil',TextType::class,array('label'=>'Cuit','attr' => ['class' => 'input-field col s12']))        
         ->add('cuitcuilEmpleador',TextType::class,array('label'=>'CUIT Empleador','attr' => ['class' => 'input-field col s12']))  
         ->add('mes',NumberType::class,array('label'=>'Mes del Periodo','attr' => ['class' => 'input-field col s12','placeholder'=>"MM",'maxlength' => 2]))
         ->add('anio',NumberType::class,array('label'=>'Año del Periodo','attr' => ['class' => 'input-field col s12','placeholder'=>"YYYY",'maxlength' => 4]))      
         ->add('diferenciaContribuciones',TextType::class,array('label'=>'Diferencia de Contribuciones','attr' => ['class' => 'input-field col s12']))
         ->add('interesesResarcitorios',TextType::class,array('label'=>'intereses Resarcitorios','attr' => ['class' => 'input-field col s12']))
         ->add('save', SubmitType::class,array('label'=>'Generar','attr' => ['class' => 'waves-effect waves-light btn blue lighten-2 white-text']));
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
