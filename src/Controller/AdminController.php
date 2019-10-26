<?php

namespace App\Controller;

use App\Entity\Golf;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/backoffice", name="backoffice")
     * @return Response
     */
    public function index()
    {
        return $this->render('backoffice/index.html.twig');
    }


    /**
     * @Route("/backoffice/golf", name="backoffice_golf")
     * @return Response
     */
    public function golfAdmin()
    {
        $golfs = $this->getDoctrine()->getManager()->getRepository(Golf::class)->findAll();

        return $this->render('backoffice/golfs.html.twig', [
            'golfs' => $golfs,
        ]);
    }


    /**
     * @Route("/backoffice/user", name="backoffice_user")
     * @return Response
     */
    public function userAdmin()
    {
        $users = $this->getDoctrine()->getManager()->getRepository(User::class)->findAll();

        return $this->render('backoffice/users.html.twig', [
            'users' => $users,
        ]);
    }
}
