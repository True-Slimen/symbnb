<?php

namespace App\Form;

use App\Entity\Ad;
use App\Form\ImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AdType extends AbstractType
{

    /**
     * Permet d'avoir la configuration de base d'un champ.
     *
     * @param [string] $label
     * @param [string] $placeholder
     * @return array
     */
    private function getConfiguration($label, $placeholder){
        return [
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
            ];

    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 
                TextType::class, 
                $this->getConfiguration("Titre", "Définissez un titre à votre annonce"))
            
            ->add('slug', 
                TextType::class, 
                $this->getConfiguration("Adresse web", "Choix de l'adresse url (facultatif)"))
            
            ->add('coverImage', 
                UrlType::class, 
                $this->getConfiguration("Url de l'image principale", "Inserez l'url de votre plus belle image"))
            
            ->add('introduction', 
                TextType::class, 
                $this->getConfiguration("Introduction", "Creez un introduction courte"))
            
            ->add('content', 
                TextareaType::class, 
                $this->getConfiguration("Description", "Creez la description de l'annonce") )
            
            ->add('price', 
                MoneyType::class,
                $this->getConfiguration("Prix par nuit", "Définissez le prix par nuit"))
            
            ->add('rooms',
                IntegerType::class, 
                $this->getConfiguration("Nombre de chambres", "Le nombres de chambres disponibles"))
            
            ->add(
                'images',
                CollectionType::class,
                [
                    'entry_type' => ImageType::class,
                    'allow_add' => true
                ]
            )
            ;
            // ->add('save', SubmitType::class)
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
