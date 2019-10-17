<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Entity\Competition;
use Symfony\Component\Form\Extension\Core\Type\TextType;



class UploadController extends AbstractController
{
    /**
     * @Route("/upload", name="uploadTab")
     */
    public function upload()
    {
        $compet = new Competition();
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $compet);
        $formBuilder
            ->add('heureDepart', TimeType::class)
            ->add('cadence', TimeType::class)
            ->add('fichier', FileType::class)
            ->add('save', SubmitType::class)
            ;
        $form = $formBuilder->getForm();
        return $this->render('upload/upload.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
