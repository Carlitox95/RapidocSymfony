<?php
namespace App\Form;

use App\Entity\Empleador;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class FormularioType extends AbstractType
{
    public function buildForm (FormBuilderInterface $builder,array $options) {
     $builder        
        ->add('nombre',TextType::class,array('label'=>'Nombre','attr' => ['class' => 'input-field col s12']))
        ->add('categoria',TextType::class,array('label'=>'Categoria','attr' => ['class' => 'input-field col s12']))
        ->add('descripcion',TextType::class,array('label'=>'Descripcion','attr' => ['class' => 'input-field col s12']))        
        ->add('tipo',TextType::class,array('label'=>'Tipo','attr' => ['class' => 'input-field col s12']))        
        ->add('plantilla',TextType::class,array('label'=>'Plantilla','attr' => ['class' => 'input-field col s12']))
        ->add('save', SubmitType::class,array('label'=>'Guardar','attr' => ['class' => 'waves-effect waves-light btn blue lighten-2 white-text']));
    }
}
