<?php

namespace App\Controller;


use App\Entity\Competition;
use App\Entity\UploadTrou;
use App\Form\UploadFormType;
use App\Form\UploadTrouType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UploadController extends AbstractController
{
    /**
     * @Route("/upload", name="uploadTab")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function upload(Request $request)
    {
        $entitymanager = $this->getDoctrine()->getManager();

        $competition = new Competition();

        //creation du formulaire et liasion avec l'entité competition
        $form = $this->createForm(UploadFormType::class, $competition);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $filename = 'Fichier.xlsx';

            $golfDatas = $form->get('golf')->getData();

            $heureDepart = $competition->getHeureDepart();
            $minuteDepart = $competition->getMinuteDepart();
            $fichier = $competition->getFichier();
            $date = $competition->getDate();
            $nomCompet = $competition->getNomCompet();
            $cadence = $competition->getCadence();

            $competition
                ->setGolfId($golfDatas->getId())
                ->setNomGolf($golfDatas->getNom())
                ->setHeureDepart($heureDepart)
                ->setMinuteDepart($minuteDepart)
                ->setFichier($filename)
                ->setDate($date)
                ->setNomCompet($nomCompet)
                ->setFichier($fichier)
                ->setCadence($cadence);

            //stockage du futur nom du fichier que notre application connait
            $fichier->move($this->getParameter('upload_directory'), $filename);

            $entitymanager->persist($competition);
            $entitymanager->flush();

            return $this->redirectToRoute("view");
        }

        return $this->render('upload/upload.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
