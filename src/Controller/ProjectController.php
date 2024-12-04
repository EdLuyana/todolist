<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProjectController extends AbstractController
{
    #[Route('/project', name: 'project')]
    public function index(ProjectRepository $projectRepository): Response
        {
            $projects = $projectRepository->findAll();

        return $this->render('project/index.html.twig', [
            'projects' => $projects,
        ]);
    }
    #[Route('/project/create', name: 'project_create')]
public function create(Request $request, EntityManagerInterface $entityManager): Response{

        $project = new Project();

        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);
        if($form->isSubmitted()){
            $project->setCreatedAt(new \DateTimeImmutable());
            $entityManager->persist($project);
            $entityManager->flush();
            return $this->redirectToRoute('project');
        }

        $form_view = $form->createView();

        return $this->render('project/create.html.twig', [
            'controller_name' => 'ProjectController',
            'form_view' => $form_view
        ]);
    }
}
