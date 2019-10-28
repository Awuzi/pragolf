<?php

namespace App\Form;

use App\Entity\Competition;
use App\Entity\Golf;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UploadFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //TODO ajouter les champs nomCompetition, dateCompetition, et les champs pour les temps de chaques trous
            ->add("golf", EntityType::class, [
                'class' => Golf::class,
                'choice_label' => 'nom',
                'query_builder' => function (EntityRepository $e){
                    return $e->createQueryBuilder('g')->orderBy('g.nom', 'ASC');
                },
                'choice_value' => 'nom',
                'placeholder' => '-- Choisissez un Golf --'
            ])
            ->add('nomCompet', TextType::class, [
                'label' => 'Nom Competition'
            ])
            ->add('date',TextType::class, [
                'data' => date("d/m/Y"),
                'label' => 'Date Compétition'
            ])
            ->add('heureDepart', ChoiceType::class, [
                'choices' => [
                    '7' => '7',
                ],
                'label' => 'Heure de départ'
            ])
            ->add('minuteDepart', ChoiceType::class, [
                'choices' => [
                    '00' => '00',
                    '30' => '30'
                ]
            ])
            ->add('cadence', IntegerType::class, [
                'data' => 11 ])
            ->add('fichier', FileType::class)
            ->add('save', SubmitType::class);
            //            ->add("nomGolf", ChoiceType::class, [
            //                'choices' => $golf->getNom()
            //            ])
            //TODO :: rajouter choice type pour lister les golfs
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Competition::class,
        ]);
    }
}
