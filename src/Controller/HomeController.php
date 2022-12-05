<?php

namespace AlpsWiki\Controller;
use AlpsWiki\Entity\Folder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route("/", name: "homepage")]
    public function index(EntityManagerInterface $entityManager) : Response
    {
        $folders = $entityManager->getRepository(Folder::class)->findBy(['enabled' => true],['sorting' => 'ASC']);

        //dump($folders);

        return $this->render('home/index.html.twig', [
            'folders' => $folders,
        ]);
    }


    #[Route("/404")]
    public function notFound()
    {
        return $this->render('error/404.html.twig');
    }

}