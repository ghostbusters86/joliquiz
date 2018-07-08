<?php

namespace App\Form;

use App\Entity\Quiz;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class QuizType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title');
        $builder->add('summary');
        $builder->add('number_of_questions');
        $builder->add('categories', EntityType::class, array(
                'class' => Category::class,
                'query_builder' => function (CategoryRepository $er) {
                    return $er->createQueryBuilder('c')->orderBy('c.shortname', 'ASC');
                 },
                'choice_label' => 'longname',
                'multiple' => true
            ));
        $builder->add('show_result_question');
        $builder->add('active');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Quiz::class,
            'form_type' => 'student_questioning',
        ]);
    }
}