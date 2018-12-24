<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

use App\Entity\Depense;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DepenseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder            
            ->add('nameShop', TextType::class, array(
                'label' => 'LBL_NAME_SHOP',
                'attr' => ['placeholder' => 'LBL_NAME_SHOP'],
                'mapped' => false
            ))
            ->add('idShop', HiddenType::class)
            ->add('dateBuy', TextType::class, array(
                    'label' => 'LBL_DATE_DAY',
                    'attr' => ['placeholder' => 'LBL_DATE_DAY'],
                    'mapped' => false
                ))
            ->add('amount', TextType::class, array(
                    'label' => 'LBL_AMOUNT',
                    'attr' => ['placeholder' => 'LBL_AMOUNT'],
                ))
            ->add('save', SubmitType::class, array(
                'label' => 'LBL_SAVE',
                'attr' => array('class' =>'btn btn-default')
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Depense::class,
        ));
    }

}