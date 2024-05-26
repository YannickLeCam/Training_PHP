<?php

namespace App\Controller;

use App\Entity\ContactMailling;
use App\Form\ContactMaillingType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;


class MaillingController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(EntityManagerInterface $em , MailerInterface $mailer , Request $request): Response
    {
        $form= $this->createForm( ContactMaillingType::class ,new ContactMailling());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $mailToSend=$form->getData();
            $email= new Email();
            $email-> from($mailToSend->getMailaddress());
            $email-> to("numeriiikazz@gmail.com"); // Mon adresse mail
            $email-> subject("auto : contact new mail");
            $email-> text($mailToSend->getMessage());
            $mailer->send($email);
            $this->addFlash('success','Le mail a bien été envoyé !');
            return $this->redirectToRoute('recipe.index');
        }

        return $this->render('mailling/index.html.twig', [
            'controller_name' => 'MaillingController',
            'form' => $form
        ]);
    }
}
