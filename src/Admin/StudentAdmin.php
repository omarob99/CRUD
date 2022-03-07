<?php

namespace App\Admin;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

final class StudentAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper):void
    {
        $date = date("d-m-Y");
        $formMapper->add('fname', TextType::class)
        ->add('lname', TextType::class)
        ->add('dob', TextType::class)
        ->add('img', FileType::class, array('data_class' => null))
        ->add('date_created', TextType::class,array('disabled'  => true,'required' => false))
        ->add('date_modified', TextType::class,array('data' => $date));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper):void
    {
        $datagridMapper->add('fname')
        ->add('lname')
        ->add('dob')
        ->add('img');
    }

    protected function configureListFields(ListMapper $listMapper):void
    {
        $listMapper->addIdentifier('fname')
        ->addIdentifier('lname')
        ->addIdentifier('dob')
        ->addIdentifier('img');
    }
}