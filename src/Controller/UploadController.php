<?php

namespace App\Controller;


use App\Entity\Competition;
use App\Entity\Golf;
use App\Form\UploadFormType;
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
        //generation entitymanager
        $entitymanager = $this->getDoctrine()->getManager();
        //instanciation d'un objet competition
        $competition = new Competition();
        $golf = new Golf();

        //creation du formulaire et liasion avec l'entité competition
        $form = $this->createForm(UploadFormType::class, $competition);
        $form->handleRequest($request);

        //si le formulaire est soumis et valide alors:
        if ($form->isSubmitted() && $form->isValid()) {

            //récuperation du fichier qui a été uploadé
            $file = $competition->getFichier();

            //stockage du futur nom du fichier que notre application connait
            $filename = "Fichier"."."."xlsx";

            //déplacement du fichier dans l'upload directory dont le chemin
            //est specifié dans services.yaml
            //chemin: '%kernel.project_dir%/public/assets/doc'
            $file->move($this->getParameter('upload_directory'), $filename);

            //renommage du fichier
            $competition->setFichier($filename);

            //$nomCompet = $request->request->get('nomCompet');
            //$nomgolf = $request->request->get('nomGolf');
            $heureDepart = $competition->getHeureDepart();
            $minuteDepart = $competition->getMinuteDepart();
            $f = $competition->getFichier();
            $date = $competition->getDate();
            $nomCompet = $competition->getNomCompet();
            $nomgolf = $competition->getNomGolf();
            //$golfid = $golf->getId();
            $cadence = $competition->getCadence();
            //dd([$heureDepart, $minuteDepart, $f, $date ,$nomgolf ,$nomCompet]);
            //envoie des champs heureCompet, cadence, nomCompet, nomGolf dans la base de données
            //$entitymanager->persist($heureCompet);
            $competition->setHeureDepart($heureDepart);
            $competition->setMinuteDepart($minuteDepart);
            $competition->setFichier($f);
            $competition->setDate($date);
            $competition->setCadence($cadence);
            $competition->setNomCompet($nomCompet);
            $competition->setNomGolf($nomgolf);
            //$competition->se($golfid);
            //$cadence = $competition->getCadence();
            //$entitymanager->persist($cadence);
            $entitymanager->persist($competition);

            $entitymanager->flush();

            //redirection vers la vue "view"
            return $this->redirectToRoute("view");
        }

        return $this->render('upload/upload.html.twig', array('form' => $form->createView()));
    }
}
