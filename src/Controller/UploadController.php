<?php

namespace App\Controller;


use App\Entity\Competition;
use App\Form\UploadFormType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class UploadController extends AbstractController
{
    /**
     * @Route("/upload", name="uploadTab")
     */
    public function upload(Request $request)
    {
        $competition = new Competition();
        $form = $this->createForm(UploadFormType::class, $competition);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $file = $competition->getFichier();
            $filename="Fichier"."."."xlsx";
            $file->move($this->getParameter('upload_directory'),$filename);
            $competition->setFichier($filename);
            return $this->redirectToRoute("index");
        }

        return $this->render('upload/upload.html.twig', array('form' => $form->createView()));
    }
}
