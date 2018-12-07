<?php

namespace App\Form;

use App\Entity\Media;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, [
              'label'=>' ',
              'choices'  => [
                  'Select type of media' => null,
                  'Livre' => 'livre',
                  'Film' => 'film',
                  'Audio' => 'audio'
              ]
            ])
            ->add('title', TextType::class, [
              'label'=>' ',
              'attr'=> ['placeholder'=>'The title of the media']
            ])
            ->add('author', TextType::class, [
              'label'=>' ',
              'attr'=> ['placeholder'=>'The author of the media']
            ])
            ->add('cover', FileType::class, [
              'label'=>'Cover'
            ])
            ->add('submit', SubmitType::class, [
              'label'=>'Submit',
              'attr'=> ['class'=>'btn btn-dark']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Media::class,
        ]);
    }
}
