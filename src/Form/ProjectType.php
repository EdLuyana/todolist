<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, options: [
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form_label'],
                'label' => 'Nom du projet'])
            ->add('description', TextAreaType::class, options: [
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form_label'],
                'label' => 'Description'
            ])
            ->add('image', FileType::class, [
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form_label'],
                'label' => 'Image'

            ])
            ->add ('tags', EntityType::class, [
                'class' => Tag::class,
                'choice_label' => 'name',
                'multiple' => true,
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form_label'],
                'label' => 'Tags'
            ])
            ->add('Enregistrer', SubmitType::class, ['attr' => ['class' => 'btn btn-success mt-3',]]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
