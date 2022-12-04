<?php

namespace AlpsWiki\Controller;
use AlpsWiki\Entity\Folder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route("/")]
    public function indexAction(EntityManagerInterface $entityManager) : Response
    {
        $res = $entityManager->getRepository(Folder::class)->findAll();

        dump($res);

        return $this->render('home/index.html.twig');
    }

    #[Route("/new")]
    public function newAction(EntityManagerInterface $entityManager) : Response
    {
        $folder = new Folder();
        $folder->setName('Test Folder'. rand(10, 30));

        $entityManager->persist($folder);
        $entityManager->flush();

        return new Response('Finished');
    }


    #[Route("/404")]
    public function notFoundAction()
    {
        return $this->render('error/404.html.twig');
    }

}