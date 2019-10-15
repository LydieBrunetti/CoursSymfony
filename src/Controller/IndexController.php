<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Newsletter;
use App\Form\ContactType;
use App\Form\NewsLetterRegisterType;
use App\Repository\NewsletterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage(Request $request, EntityManagerInterface $entityManager)
    {
        // $entityManager = $this->getDoctrine()->getManager();

  //      $newsletterItem = $newsletterRepository->createNewsletterEmail("mimi@wanadoo.fr");
        $newsletterItem = new Newsletter();
        $form = $this->createForm(NewsLetterRegisterType::class, $newsletterItem);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($newsletterItem);
            $entityManager->flush();
        }
        
        return $this->render('index/index.html.twig', [
            'newsletterItem' => $newsletterItem,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, EntityManagerInterface $entityManager)
    {
        $contactItem = new Contact();
        $form = $this->createForm(ContactType::class, $contactItem);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($contactItem);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Votre demande de contact a bien été envoyée !'
            );

            return $this->redirectToRoute('homepage');
        }


        return $this->render('index/contact.html.twig', [
            'contactItem' => $contactItem,
            'form' => $form->createView(),
        ]);
    }





}
