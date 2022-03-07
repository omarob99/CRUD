<?php

namespace App\Admin;
use App\Entity\Student;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Sonata\AdminBundle\Form\Type\ModelType;

final class StudentsGradesAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper):void
    {
        $formMapper->add('course', TextType::class)
        ->add('class',TextType::class)
        ->add('grade',TextType::class)
        ->add('target_student', EntityType::class, ['class' => Student::class,'choice_label' => 'id']);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper):void
    {
        $datagridMapper->add('course')
        ->add('class');
    }

    protected function configureListFields(ListMapper $listMapper):void
    {
        $listMapper->addIdentifier('course')
        ->addIdentifier('class');
    }
}