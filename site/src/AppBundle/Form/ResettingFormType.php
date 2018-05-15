<?php
// src/AppBundle/Form/ResettingType.php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ResettingFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('age');
    }

    public function getParent()
    {
        return 'fos_user_resetting';
    }

    public function getName()
    {
        return 'app_user_resetting';
    }
}
