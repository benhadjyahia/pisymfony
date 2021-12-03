<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Evenement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('imageFile', FileType::class )

            ->add('Nom_Event',TextType::class, array('required' => false, 'attr' => array('class' => 'form-control')))
            ->add('Adresse_Event',texttype::class, array('required' => false, 'attr' => array('class' => 'form-control')))

            ->add('Num_Event',texttype::class, array('required' => false, 'attr' => array('class' => 'form-control')))
            ->add('Date_Event',DateType::class, array('required' => false, 'attr' => array('class' => 'form-control')))


            ->add('category', EntityType::class,['class'=>category::class,'choice_label'=>'titre','label'=>'Categories'])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([

            'data_class' => Evenement::class,
        ]);
    }
}
