<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Competitor;

class TestController extends AbstractController
{
    /**
     * @Route("/", name="test")
     */
    public function index()
    {
        // $repo = $this->getDoctrine()->getRepository(Competitor::class);
        // $competitor = $repo->find(9);

        // $em = $this->getDoctrine()->getManager();
        // $em->remove($competitor);
        // $em->flush();

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
