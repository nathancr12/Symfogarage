<?php

namespace App\Form;

use App\Entity\Voiture;
use App\Form\ImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AnnonceType extends AbstractType
{
    /**
     * Permet d'avoir la configuration d'un champ
     * 
     * @param string $label
     * @param string $placeholder
     * @return array
     */
    private function getConfiguration($label,$placeholder,$options=[]){ //utiliser une function pour éviter de répéter chaque fois
        return array_merge([
            'label' =>$label,
            'attr'=> [
                'placeholder' => $placeholder
            ]
            ],$options);
    }
        

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('marque',TextType::class, $this->getconfiguration('marque','Marque de votre voiture'))
            ->add('modele',TextType::class ,$this->getconfiguration('modele','Modèle de votre voiture'))
            ->add('slug',TextType::class ,$this->getconfiguration('slug','Adresse Web(automatiqu',['required' => false]))
            ->add('coverImg',UrlType::class, $this->getConfiguration("Url de l'image","Donner l'adresse de votre image"))
            ->add('km',IntegerType::class, $this->getconfiguration('Nombre de km','Indiquer le nombre de km'))
            ->add('prix',MoneyType::class, $this->getconfiguration('Prix de la voiture','Indiquer le prix que votre voiture'))
            ->add('proprio',IntegerType::class, $this->getconfiguration("Nombre de proprio",'Indiquer combien de proprio a eu votre voiture'))
            ->add('cylindre',IntegerType::class, $this->getconfiguration("Nombre de cylindre",'Indiquer les cylindres'))
            ->add('puissance',TextType::class, $this->getconfiguration("La puissance",'Indiquer la puissance de votre voiture'))
            ->add('carburant',TextType::class, $this->getconfiguration('Carburant','Le carburant de votre voiture'))
            ->add('annee',IntegerType::class, $this->getconfiguration("L'année de circulation","Indiquer l'année de circulation"))
            ->add('transmission',TextType::class, $this->getconfiguration('Transmission',"Donner la transmission de votre voiture"))
            ->add('description',TextType::class, $this->getconfiguration('les description',"Donner une description de votre voiture"))
            ->add('voption',TextType::class, $this->getconfiguration('les options',"Donner les options de votre voiture"))
            ->add('descrip',TextareaType::class, $this->getConfiguration('Description detaillée','Donnez une description de votre voiture' ))
            ->add('images',
                    CollectionType::class,
                    [
                        'entry_type' => ImageType::class,
                        'allow_add' => true, //permet d'ajouter des images 
                        'allow_delete' => true, ///pertmet supprimer des images
                    ]
                )
            ;
    }

    public function configureOptions(OptionsResolver $resolver) //pour faire la liaison entre le formulaire et la base 'voiture'
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
