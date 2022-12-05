<?php

namespace AlpsWiki\Controller;

use AlpsWiki\DTO\UpdateFolderRequest;
use AlpsWiki\Entity\Folder;
use AlpsWiki\Form\Type\FolderType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/folder')]
class FolderController extends AbstractController
{
    const TEMPLATE_PATH = 'folder/';

    // TODO protect slug, not able to recreate

    #[Route('/new', methods: ['GET', 'POST'], name: 'folder_newForm')]
    public function newForm(Request $request, EntityManagerInterface $entityManager) : Response
    {

        $form = $this->createForm(FolderType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $folder = $form->getData();
            $entityManager->persist($folder);
            $entityManager->flush();

            $this->addFlash('success','It worked');

            return $this->redirectToRoute('folder_show', [
                'slug' => $folder->getSlug()
            ]);
        }

        return $this->render(self::TEMPLATE_PATH.'newForm.html.twig', [
            'form' => $form,
        ]);
    }


    #[Route('/{slug}', methods: ['GET'], name: 'folder_show')]
    public function show(Folder $folder): Response
    {

        return $this->render(self::TEMPLATE_PATH.'show.html.twig', [
            'folder' => $folder,
        ]);

    }

    #[Route('/new1222', methods: ['PUT', 'PATCH'], name: 'folder_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, Folder $folder) : Response
    {

        $folder = new Folder();
        $form = $this->createForm(FolderType::class, $folder);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $folder = $form->getData();
            $entityManager->persist($folder);
            $entityManager->flush();

            $this->addFlash('success','It worked');

            $message = "it worked";
            return $this->redirectToRoute('folder_show', [
                'slug' => $folder->getSlug()
            ]);
        }

        $this->addFlash('error','Some Error');
        return $this->render(self::TEMPLATE_PATH.'new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', methods: ['GET'], name: 'folder_editForm')]
    public function editForm(Request $request, Folder $folder, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FolderType::class, $folder);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            // https://symfony.com/doc/current/form/direct_submit.html
            // $form->submit(array_merge($json, $request->request->all()));

            $this->addFlash('success','It worked');
            $entityManager->flush();

            return $this->redirectToRoute('folder_editForm', ['id' => $folder->getId()]);
        }

        return $this->render(self::TEMPLATE_PATH.'editForm.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', methods: ['PUT', 'PATCH'], name: 'folder_edit')]
    public function edit(Request $request, Folder $folder, EntityManagerInterface $entityManager): Response
    {

        $form = $this->createForm(FolderType::class, $folder);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            // https://symfony.com/doc/current/form/direct_submit.html
            // $form->submit(array_merge($json, $request->request->all()));

            $entityManager->persist($folder);
            $entityManager->flush();

            $this->addFlash('success','It worked');

            $message = "it worked";
            return $this->redirectToRoute('folder_editForm', [
                'slug' => $folder->getSlug()
            ]);
        }

        $this->addFlash('error','Some Error');

        return $this->render(self::TEMPLATE_PATH.'edit.html.twig', [
            'folder' => '',
        ]);
    }


    #[Route('/{id}', methods: ['DELETE'], name: 'folder_delete')]
    public function delete(Folder $folder, EntityManagerInterface $entityManager) : Response
    {
        if(!$folder) throw $this->createNotFoundException('no folder found');

        $name = $folder->getName();

        $entityManager->remove($folder);
        $entityManager->flush();

        $this->addFlash($name.'is deleted');


        return $this->redirectToRoute('folder_show');
    }


}