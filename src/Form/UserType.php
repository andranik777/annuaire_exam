<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('nom')
            ->add('prenom')
            ->add('secteur',  ChoiceType::class, [
                'choices'=>[
                    'RH'=>'RH',
                    'Informatique'=>'Informatique',
                    'Comptabilité'=>'Comptabilité',
                    'Direction'=>'Direction'

                ]
            ])
            ->add('typeContrat', ChoiceType::class,[
                'choices'=>[
                    'CDD'=>'CDD',
                    'CDI'=>'CDI',
                    'Interim'=>'Interim'
                ]
            ])
            ->add('dateSortie')
            ->add('password', PasswordType::class, array('label' => 'Mots de Passe')
            )
            ->add('roleMaker', ChoiceType::class, [
                'choices'  => [
                    'Utilisateur' => "ROLE_USER",
                    'RH' => "ROLE_RH",
                ],
                'label'=>'Role'
            ])

            ->add('photo', FileType::class,[
                'label'=>'Votre photo de profil',
                'mapped'=> false,
                'required'=> false,
                'constraints'=> [
                    new File([
                        'maxSize'=>'2048k',
                        'mimeTypes'=>['image/png','image/jpeg'],
                        'mimeTypesMessage'=> 'Charger des images au format png, jpg, jpeg'
                    ])
                ]
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
