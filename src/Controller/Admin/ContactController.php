<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/", name="contact_index")
     */
    public function adminContact(ContactRepository $contactRepository)
    {
       // $repository = $this->getDoctrine()->getRepository(Contact::class);
        $contact_list = $contactRepository->findAll();

        return $this->render('admin/contact/layout.html.twig', [
            'contact_list' => $contact_list,
        ]);
    }
}
