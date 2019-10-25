<?php

namespace App\Form;

use App\Entity\Competition;
use App\Entity\Golf;
use App\Repository\GolfRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\MakerBundle\Maker\MakeForm;
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
            ->add("nomGolf", TextType::class)
            ->add("lieuGolf", TextType::class)
            ->add('nomCompet', TextType::class)
            ->add('date',TextType::class)
            ->add('heureDepart', IntegerType::class)
            ->add('minuteDepart', IntegerType::class)
            ->add('cadence', IntegerType::class)
            ->add('fichier', FileType::class)
            ->add('save', SubmitType::class)
            //            ->add("nomGolf", ChoiceType::class, [
            //                'choices' => $golf->getNom()
            //            ])
            //TODO :: rajouter choice type pour lister les golfs
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Competition::class,
        ]);
    }
}
