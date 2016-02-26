<?php

namespace MIT\DirectoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MITDirectoryBundle:Default:index.html.twig');
    }
}
