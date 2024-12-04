<?php

namespace App\Controller;

use App\Entity\Status;
use App\Form\StatusType;
use App\Repository\StatusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StatusController extends AbstractController
{
    // Here we set the route to our status page
    #[Route('/status', name: 'status')]
    // This function is manage our main status page called index
    public function index(StatusRepository $statusRepository): Response
    {
        // First we call status's repository to find all status already existing in the DB
        $statusAll = $statusRepository->findAll();

        // We return our result to our page

        return $this->render('status/index.html.twig', [
            'statusAll' => $statusAll,
        ]);
    }

    // Here we set the path to our status creation page
    #[Route('status/create', name: 'status_create')]
    // Here the function to create new status
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Step 1: Calling a new Status
        $status = new Status();
        // Step 2: Create a new var form with symfony method 'createForm'
        $form = $this->createForm(StatusType::class, $status);
        // Apply to $form everything from method get/post
        $form->handleRequest($request);
        // If form is submitted :
        if ($form->isSubmitted()) {
            // We presave infos in DB
            $entityManager->persist($status);
            // We register them in DB
            $entityManager->flush();

            // We redirect the page to main status's page
            return $this->redirectToRoute('status');
        }
        $formView = $form->createView();
        return $this->render('status/create.html.twig', [
            'form_view' => $formView,
        ]);

    }
}
