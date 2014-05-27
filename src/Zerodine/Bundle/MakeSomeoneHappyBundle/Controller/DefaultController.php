<?php

namespace Zerodine\Bundle\MakeSomeoneHappyBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {
    public function indexAction() {
        return $this->render('ZerodineMakeSomeoneHappyBundle:Default:index.html.twig', array());
    }
} 