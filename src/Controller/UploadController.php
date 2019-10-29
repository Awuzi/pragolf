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
            $filename = "Fichier.xlsx";

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

            //récuperation du fichier qui a été uploadé
            //stockage du futur nom du fichier que notre application connait
            $fichier->move($this->getParameter('upload_directory'), $filename);

            $entitymanager->persist($competition);
            $entitymanager->flush();

            //redirection vers la vue "view"
            $c = new IndexController();
            return $this->redirectToRoute("view");
        }

        return $this->render('upload/upload.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @Route("/uploadTrou", name="uploadTrou")
     * @return RedirectResponse|Response
     */
    public function uploadTrou(Request $request){
        $entitymanager = $this->getDoctrine()->getManager();
        $trou = new UploadTrou();

        $form = $this->createForm(UploadTrouType::class, $trou);
        $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid()){
            //recuperation des donnees dans des variables permettant d'hydrater le formulaire
            $golfID = $trou->getGolfID();
            $trou1=$trou->getTrou1();
            $trou2=$trou->getTrou2();
            $trou3=$trou->getTrou3();
            $trou4=$trou->getTrou4();
            $trou5=$trou->getTrou5();
            $trou6=$trou->getTrou6();
            $trou7=$trou->getTrou7();
            $trou8=$trou->getTrou8();
            $trou9=$trou->getTrou9();
            $trou10=$trou->getTrou10();
            $trou11=$trou->getTrou11();
            $trou12=$trou->getTrou12();
            $trou13=$trou->getTrou13();
            $trou14=$trou->getTrou14();
            $trou15=$trou->getTrou15();
            $trou16=$trou->getTrou16();
            $trou17=$trou->getTrou17();
            $trou18=$trou->getTrou18();

            //hydratation du formulaire avec les donnees récupérées
            $trou
                ->setGolfID($golfID)
                ->setTrou1($trou1)
                ->setTrou2($trou2)
                ->setTrou3($trou3)
                ->setTrou4($trou4)
                ->setTrou5($trou5)
                ->setTrou6($trou6)
                ->setTrou7($trou7)
                ->setTrou8($trou8)
                ->setTrou9($trou9)
                ->setTrou10($trou10)
                ->setTrou11($trou11)
                ->setTrou12($trou12)
                ->setTrou13($trou13)
                ->setTrou14($trou14)
                ->setTrou15($trou15)
                ->setTrou16($trou16)
                ->setTrou17($trou17)
                ->setTrou18($trou18);

                $entitymanager->persist($trou);
                $entitymanager->flush();
        }
        return $this->render('upload/uploadTrou.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
