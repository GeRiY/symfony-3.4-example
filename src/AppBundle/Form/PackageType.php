<?php

namespace AppBundle\Form;

use Cassandra\Type\UserType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\DataTransformer\ChoiceToValueTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PackageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder->add('requestDate', DateTimeType::class, [
            'label' => 'Felviteli dátum'
            ])
            ->add('deliveredDate', DateTimeType::class, [
                'label' => 'Kézbesítés dátum'
            ])
            ->add('tag', EntityType::class, [
                'class' => 'AppBundle\Entity\Tag',
                'choice_label' => 'name',
                'placeholder' => '',
                'required' => false,
                'label' => 'Tagek'
            ])
            ->add('startAddress', EntityType::class, [
                'class' => 'AppBundle\Entity\Address',
                'choice_label' => 'name',
                'label' => 'Honnan szállítod'
            ])
            ->add('targetAddress', EntityType::class, [
                'class' => 'AppBundle\Entity\Address',
                'choice_label' => 'name',
                'label' => 'Hova szállítod'
            ])
//            ->add('currentPosition', AddressType::class)
            ->add('packageStatus', EntityType::class, [
                'class' => 'AppBundle\Entity\PackageStatus',
                'choice_label' => 'name',
                'label' => 'Csomag státusz'
            ])
            ->add('transferStatus', EntityType::class, [
                'class' => 'AppBundle\Entity\TransferStatus',
                'choice_label' => 'name',
                'label' => 'Szállító státusz'
            ])
            ->add('courier', EntityType::class, [
                'class' => 'AppBundle\Entity\Courier',
                'choice_label' => 'name',
                'label' => 'Szállító'
            ])
            ->add('handler', EntityType::class, [
                'class' => 'AppBundle\Entity\User',
                'query_builder' => function (EntityRepository $er){
                    return $er->createQueryBuilder('u')
                        ->where('u.role = 1');
                },
                'choice_label' => 'username',
                'label' => 'Adminisztrátor'
            ])
            ->add('width', NumberType::class, [
                'label' => 'Szélesség'
            ])
            ->add('height', NumberType::class, [
                'label' => 'Magasság'
            ])
            ->add('length', NumberType::class, [
                'label' => 'Hosszúság'
            ]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Package'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_package';
    }


}
