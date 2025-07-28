<?php

namespace App\Form\Type;

use App\Dto\ProductoServicioDto;
use App\Entity\CondicionIva;
use App\Entity\Rubro;
use App\Entity\UnidadMedida;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Enum\TipoProductoServicio;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProductoServicioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('tipo', ChoiceType::class, [
            'choices' => [
                'Producto' => TipoProductoServicio::PRODUCTO,
                'Servicio' => TipoProductoServicio::SERVICIO,
            ],
            'placeholder' => 'Seleccionar...',
            'label' => 'Tipo',
            'attr' => ['class' => 'form-select'],
            'required' => false,
        ])
        ->add('rubro', EntityType::class, [
            'placeholder' => 'Seleccionar...',
            'class' => Rubro::class,
            'choice_label' => 'rubro',
            'label' => 'Rubro',
            'attr' => ['class' => 'form-select'],
        ])
        ->add('codigo', TextType::class, [
            'label' => 'Código',
            'help' => 'Ingrese un código único. No se permiten caracteres especiales.',
            'attr' => ['class' => 'form-control'],
        ])
        ->add('productoServicio', TextType::class, [
            'label' => 'Producto / Servicio',
            'attr' => ['class' => 'form-control'],
        ])
        ->add('unidadMedida', EntityType::class, [
            'placeholder' => 'Seleccionar...',
            'class' => UnidadMedida::class,
            'choice_label' => 'unidadMedida',
            'label' => 'Unidad de Medida',
            'attr' => ['class' => 'form-select'],
        ])
        ->add('condicionIva', EntityType::class, [
            'placeholder' => 'Seleccionar...',
            'class' => CondicionIva::class,
            'choice_label' => 'condicionIva',
            'label' => 'Condición de IVA',
            'attr' => ['class' => 'form-select'],
        ])
        ->add('precioBrutoUnitario', TextType::class, [
            'label' => 'Precio Unitario',
            'required' => false,
            'attr' => ['class' => 'form-control'],
        ])
        ->add('confirmar', SubmitType::class, [
            'label' => 'Guardar',
            'attr' => ['class' => 'btn btn-primary mt-3'],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void   
    {
        $resolver->setDefaults([
            'data_class' => ProductoServicioDto::class,
        ]);
    }
}