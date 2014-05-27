<?php

namespace Zerodine\Bundle\MakeSomeoneHappyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Zerodine\Bundle\MakeSomeoneHappyBundle\Entity\Circle;
use Zerodine\Bundle\MakeSomeoneHappyBundle\Form\Type\CircleType;
use Symfony\Component\HttpFoundation\Request;
use Zerodine\Bundle\MakeSomeoneHappyBundle\KernelListener\CircleListenerInterface;

/**
 * @Route("/circle")
 */
class CircleController extends Controller
{
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

    /**
     * @Route("/")
     * @Template()
     */
    public function listAction()
    {
        $circles = $this->getDoctrine()
            ->getRepository('ZerodineMakeSomeoneHappyBundle:Circle')
            ->findAll();

        return $this->render('ZerodineMakeSomeoneHappyBundle:Circle:list.html.twig', array('circles' => $circles));
    }

    /**
     * @Route("/{circleAlias}")
     * @Template()
     */
    public function viewAction($circleAlias)
    {
        $circle = $this->getDoctrine()
            ->getRepository('ZerodineMakeSomeoneHappyBundle:Circle')
            ->findOneByAlias($circleAlias);

        return $this->render('ZerodineMakeSomeoneHappyBundle:Circle:view.html.twig', array('circle' => $circle));
    }
}