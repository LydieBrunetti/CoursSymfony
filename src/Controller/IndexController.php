<?php

namespace App\Controller;

use App\Entity\Newsletter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $newsletterItem = new Newsletter();
        $newsletterItem->setEmail("lydie@orange.fr")->setSubscribed(true);
        $entityManager->persist($newsletterItem);
        $entityManager->flush();


        return $this->render('index/index.html.twig', [
            'newsletterItem' => $newsletterItem,
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('index/contact.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }





}
