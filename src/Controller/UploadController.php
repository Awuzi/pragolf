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
        $competition = new Competition();
        $golf = new Golf();
        //generation entitymanager
        $entitymanager = $this->getDoctrine()->getManager();

/*        $nomsGolf = [];
        $golfs = $this->getDoctrine()->getRepository(Golf::class)->findAll();
        foreach ($golfs as $golf) {
            $nomsGolf[$golf->getNom()] = $golf->getId();
        }*/

        //dd($nomsGolf);
        //instanciation d'un objet competition

        //creation du formulaire et liasion avec l'entité competition
        $form = $this->createForm(UploadFormType::class, $competition);


        $form->handleRequest($request);

        //si le formulaire est soumis et valide alors:
        if ($form->isSubmitted() && $form->isValid()) {
            //récuperation du fichier qui a été uploadé
            $file = $competition->getFichier();
            //stockage du futur nom du fichier que notre application connait
            $filename = "Fichier.xlsx";

            //déplacement du fichier dans l'upload directory dont le chemin
            //est specifié dans services.yaml
            //chemin: '%kernel.project_dir%/public/assets/doc'
            $file->move($this->getParameter('upload_directory'), $filename);
            //renommage du fichier


            $heureDepart = $competition->getHeureDepart();
            $minuteDepart = $competition->getMinuteDepart();
            $fichier = $competition->getFichier();
            $date = $competition->getDate();
            $nomCompet = $competition->getNomCompet();
            $cadence = $competition->getCadence();

            //envoie des champs heureCompet, cadence, nomCompet, nomGolf dans la base de données
            $golf->setNom($competition->getNomGolf())
                ->setLieu($competition->getLieuGolf());
            $competition->setHeureDepart($heureDepart)
                ->setMinuteDepart($minuteDepart)
                ->setFichier($filename)
                ->setDate($date)
                ->setNomCompet($nomCompet)
                ->setNomGolf($competition->getNomGolf())
                ->setFichier($fichier)
                ->setCadence($cadence)
                ->setGolfId($golf->getId());


            $entitymanager->persist($golf);
            $entitymanager->persist($competition);

            $entitymanager->flush();

            //redirection vers la vue "view"
            return $this->redirectToRoute("view");
        }

        return $this->render('upload/upload.html.twig', array('form' => $form->createView()));
    }
}
