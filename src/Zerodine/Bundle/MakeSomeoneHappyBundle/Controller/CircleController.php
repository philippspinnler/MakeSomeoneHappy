<?php

namespace Zerodine\Bundle\MakeSomeoneHappyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Zerodine\Bundle\MakeSomeoneHappyBundle\Entity\Circle;
use Zerodine\Bundle\MakeSomeoneHappyBundle\Form\Type\CircleType;
use Symfony\Component\HttpFoundation\Request;

class CircleController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/add", name="circle_add")
     * @Template()
     */
    public function addAction(Request $request) {
        $circle = new Circle();

        $form = $this->createForm(new CircleType(), $circle);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($circle);
            $em->flush();
        }

        return $this->render('ZerodineMakeSomeoneHappyBundle:Circle:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}