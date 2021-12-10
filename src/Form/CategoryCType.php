<?php

namespace App\Form;

use App\Entity\CategoryC;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use phpDocumentor\Reflection\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
class CategoryCType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('labell',TextType::class  , array('attr' => array('class' => 'form-control')))
            ->add('color', ColorType::class  )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CategoryC::class,
        ]);
    }
}
