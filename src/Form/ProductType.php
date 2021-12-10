<?php

namespace App\Form;

use Dotrine\ORM\Mapping as ORM;
use Dotrine\Common\Collections\ArrayCollection;
use Dotrine\Common\Collections\Collection;
use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('Nom_p',TextType::class  , array('attr' => array('class' => 'form-control')))
            ->add('Marque_p',TextType::class  , array('attr' => array('class' => 'form-control')))
            ->add('Prix_p',TextType::class  , array('attr' => array('class' => 'form-control')))
            ->add('Quantite_p',TextType::class  , array('attr' => array('class' => 'form-control')))
            ->add('imageFile',FileType::class, array('data_class' => null))
            ->add('categorie')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
