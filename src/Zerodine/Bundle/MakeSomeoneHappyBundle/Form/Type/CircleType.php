<?php
namespace Zerodine\Bundle\MakeSomeoneHappyBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CircleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('alias')
            ->add('password', 'password')
            ->add('save', 'submit');
    }

    public function getName()
    {
        return 'circle';
    }
}