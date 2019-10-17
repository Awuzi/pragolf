<?php

namespace App\Controller;


use App\Entity\Competition;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Routing\Annotation\Route;


class UploadController extends AbstractController
{
    /**
     * @Route("/upload", name="uploadTab")
     */
    public function upload()
    {
        $competition = new Competition();
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $competition);
        $formBuilder
            ->add('heureDepart', TimeType::class)
            ->add('cadence', TimeType::class)
            ->add('fichier', FileType::class)
            ->add('save', SubmitType::class);
        $form = $formBuilder->getForm();
        if ($form->isValid() && $form->isSubmitted()){
            // TODO : recuperer le fichier
            // TODO : extraire les donner avec d'autre methode et les appeller sous cette forme :
            $tableauJSON = $form::ExceltoJson(/*fichier uploadé*/);
            $partiePar3 = $tableauJSON::PhpToJson($tableauJSON);
        }
        return $this->render('upload/upload.html.twig', array(
            'form' => $form->createView(),
            'joueurs' => $partiePar3
        ));
    }
}
