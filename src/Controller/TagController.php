<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Form\TagType;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TagController extends AbstractController
{
    #[Route('/tag', name: 'tag')]
    public function index(TagRepository $tagRepository): Response
    {
        $tags = $tagRepository->findAll();

        return $this->render('tag/index.html.twig', [
            'tags' => $tags,
        ]);
    }
    #[Route('tag/create', name: 'tag_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tag = new Tag();
        $form = $this->createForm(TagType::class, $tag);

        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $entityManager->persist($tag);
            $entityManager->flush();

            return $this->redirectToRoute('tag');
        }

        $form_view = $form->createView();

        return $this->render('tag/create.html.twig', [
            'form_view' => $form_view
        ]);


    }
}
