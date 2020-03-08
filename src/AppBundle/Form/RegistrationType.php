<?php


namespace AppBundle\Form;


use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName', TextType::class, array('label' => 'Keresztnév'))
            ->add('lastName', TextType::class, array('label' => 'Vezetéknév'))
            ->add('address', AddressType::class, array('label' => 'Cím'));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
/*    public function getName()
    {
        return $this->getBlockPrefix();
    }*/
}