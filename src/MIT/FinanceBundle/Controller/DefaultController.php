<?php

namespace MIT\FinanceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MITFinanceBundle:Default:index.html.twig');
    }
}
