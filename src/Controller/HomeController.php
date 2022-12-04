<?php

namespace AlpsWiki\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route("/")]
    public function indexAction(Request $request) : Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route("/404")]
    public function notFoundAction()
    {
        return $this->render('error/404.html.twig');
    }

}