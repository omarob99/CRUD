<?php

namespace App\Admin;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class CourseAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper):void
    {
        $date = date("d-m-Y");
        $formMapper->add('name', TextType::class)
        ->add('description', TextType::class)
        ->add('date_created', TextType::class,array('disabled'  => true,'required' => false))
        ->add('date_modified', TextType::class,array('data' => $date));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper):void
    {
        $datagridMapper->add('name')
        ->add('description');
    }

    protected function configureListFields(ListMapper $listMapper):void
    {
        $listMapper->addIdentifier('name')
        ->addIdentifier('description');
    }
}