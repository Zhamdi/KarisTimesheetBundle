<?php

namespace Karis\TimesheetBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TimesheetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('project')
            ->add('timeSpent')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Karis\TimesheetBundle\Entity\Timesheet'
        ));
    }

    public function getName()
    {
        return 'karis_timesheetbundle_timesheet';
    }
}
