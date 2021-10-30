<?php

namespace App\Form;
use App\Entity\Student;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Classroom;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nsc')
            ->add('email')
            ->add('Classroom',EntityType::class
            ,[
                'expanded'=>true,
                'multiple'=>false,
                'choice_label'=> 'name',
                'class'=>Classroom::class,
            ])
            ->add('date')
            ->add('moyenne')
            ->add('save' ,SubmitType::class,['label'=>'valider']);


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
