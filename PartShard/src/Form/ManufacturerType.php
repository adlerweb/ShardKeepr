<?php

namespace App\Form;

use App\Entity\Manufacturer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ManufacturerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('address')
            ->add('url')
            ->add('email')
            ->add('comment')
            ->add('phone')
            ->add('fax')
            ->add('image', FileType::class, [
                'mapped' => false,
                'label' => 'Manufacturer Logo',
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => $options['imageMaxSize'],
                        'mimeTypes' => $options['imageMime'],
                        'mimeTypesMessage' => 'Please upload a valid image format',
                    ])
                ]
            ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Manufacturer::class,
            'imageMaxSize' => '5M',
            'imageMime' => [],
        ]);

        $resolver->setAllowedTypes('imageMaxSize', 'string');
        $resolver->setAllowedTypes('imageMime', 'array');
    }
}


