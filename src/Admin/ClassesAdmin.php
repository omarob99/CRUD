<?php

namespace App\Admin;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

final class ClassesAdmin extends AbstractAdmin
{
    

    protected function configureFormFields(FormMapper $formMapper):void
    {
        $date = date("d-m-Y");
        $formMapper->add('name', TextType::class)
        ->add('section', TextType::class)
        ->add('date_created', TextType::class,array('disabled'  => true,'required' => false))
        ->add('date_modified', TextType::class,array('data' => $date));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper):void
    {
        $datagridMapper->add('name')
        ->add('section');
    }

    protected function configureListFields(ListMapper $listMapper):void
    {
        $listMapper->addIdentifier('name')
        ->addIdentifier('section');
    }
}