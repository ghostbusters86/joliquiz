<?php

namespace App\Form;

use App\Entity\Question;
use App\Entity\Answer;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('text')
            ->add('categories', EntityType::class, array(
                'class' => Category::class,
                'choice_label' => 'longname',
                'multiple' => true
            ))
            // ->add('answers', EntityType::class, array(
            //     'class' => Answer::class,
            //     'choice_label' => 'text',
            //     'multiple' => true,
            //     'required' => false
            // ))

            ->add('answers', CollectionType::class, array(
                'entry_type' => AnswerType::class,
                'entry_options' => array('label' => false),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ))

            // ->add('created_at')
            // ->add('updated_at')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
