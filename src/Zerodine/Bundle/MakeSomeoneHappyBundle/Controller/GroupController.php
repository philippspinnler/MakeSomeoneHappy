<?php

namespace Zerodine\Bundle\MakeSomeoneHappyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Zerodine\Bundle\MakeSomeoneHappyBundle\Entity\Group;
use Zerodine\Bundle\MakeSomeoneHappyBundle\Form\Type\GroupType;

class GroupController extends Controller
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
     * @Route("/add", name="group_add")
     * @Template()
     */
    public function addAction() {
        $group = new Group();

        $form = $this->createForm(new GroupType(), $group);

        return $this->render('ZerodineMakeSomeoneHappyBundle:Group:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}