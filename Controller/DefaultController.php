<?php

namespace linux0uid\ContentFinderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('linux0uidContentFinderBundle:Default:index.html.twig');
    }
}
