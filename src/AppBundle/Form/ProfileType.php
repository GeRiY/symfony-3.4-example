<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form;

use AppBundle\Entity\Address;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProfileType extends AbstractType
{


    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->buildUserForm($builder, $options);



        $constraintsOptions = array(
            'message' => 'fos_user.current_password.invalid',
        );

        if (!empty($options['validation_groups'])) {
            $constraintsOptions['groups'] = array(reset($options['validation_groups']));
        }

        $builder
        ->add('current_password', PasswordType::class, array(
            'label' => 'form.current_password',
            'label_attr' => ['class'=>'control-label'],
            'translation_domain' => 'FOSUserBundle',
            'mapped' => false,
            'constraints' => array(
                new NotBlank(),
                new UserPassword($constraintsOptions),
            ),
            'attr' => array(
                'autocomplete' => 'current-password',
                "class" => "form-control"
            ),
        ))
            ->add("address", EntityType::class,
                array(
                    "class" => Address::class,
                    "choice_label" => "name",
                    "placeholder" => " ",
                    "label" => "Cím",
                    'label_attr' => ['class'=>'control-label'],
                    'query_builder' => function (EntityRepository $er){
                        return $er->createQueryBuilder('a')
                            ->where('a.isStorage = 0');
                    },
                    "attr" => ["class" => "form-control" ]

                ))
        ->add("firstName", TextType::class, array(
            "label"=>"Vezetéknév",
            "attr" => ["class" => "form-control" ],
            'label_attr' => ['class'=>'control-label']
        ))
            ->add("lastName", TextType::class, array(
                "label"=>"Keresztnév",
                "attr" => ["class" => "form-control" ],
                'label_attr' => ['class'=>'control-label']
            ));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'fos_user_profile_override';
    }

    /**
     * Builds the embedded form representing the user.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    protected function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, array(
                'label' => 'form.username',
                'label_attr' => ['class'=>'control-label'],
                'translation_domain' => 'FOSUserBundle',
                "attr" => ["readonly" => true, "class" => "form-control" ]
            ))
            ->add('email', EmailType::class, array(
                'label' => 'form.email',
                "attr" => ["class" => "form-control" ],
                'label_attr' => ['class'=>'control-label'],
                'translation_domain' => 'FOSUserBundle'
            ))
        ;
    }
}
