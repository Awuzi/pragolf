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

        //instanciation d'un objet competition

        //creation du formulaire et liasion avec l'entité competition
        $form = $this->createForm(UploadFormType::class, $competition);




        $form->handleRequest($request);

        //si le formulaire est soumis et valide alors:
        if ($form->isSubmitted() && $form->isValid()) {
            $filename = "Fichier.xlsx";

            //déplacement du fichier dans l'upload directory dont le chemin
            //est specifié dans services.yaml
            //chemin: '%kernel.project_dir%/public/assets/doc'
            $golfDatas = $form->get('golf')->getData();

            $heureDepart = $competition->getHeureDepart();
            $minuteDepart = $competition->getMinuteDepart();
            $fichier = $competition->getFichier();
            $date = $competition->getDate();
            $nomCompet = $competition->getNomCompet();
            $cadence = $competition->getCadence();
            //envoie des champs heureCompet, cadence, nomCompet, nomGolf dans la base de données
            $golf->setNom($golfDatas->getNom())
                ->setLieu($golfDatas->getLieu());


            $competition->setGolfId($golfDatas->getId())->setNomGolf($golfDatas->getNom())
                ->setHeureDepart($heureDepart)
                ->setMinuteDepart($minuteDepart)
                ->setFichier($filename)
                ->setDate($date)
                ->setNomCompet($nomCompet)
                ->setFichier($fichier)
                ->setCadence($cadence);

            //récuperation du fichier qui a été uploadé
            //stockage du futur nom du fichier que notre application connait
            $fichier->move($this->getParameter('upload_directory'), $filename);

            //persist pour l'envoie dans les tables
            $entitymanager->persist($golf);
            $entitymanager->persist($competition);
            //envoie de la requete
            $entitymanager->flush();

            //redirection vers la vue "view"
            return $this->redirectToRoute("view");
        }

        return $this->render('upload/upload.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
