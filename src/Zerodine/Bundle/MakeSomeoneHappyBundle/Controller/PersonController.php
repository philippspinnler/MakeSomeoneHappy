<?php

namespace Zerodine\Bundle\MakeSomeoneHappyBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Routing\Annotation\Route;
use Zerodine\Bundle\MakeSomeoneHappyBundle\Entity\Person;
use Zerodine\Bundle\MakeSomeoneHappyBundle\Form\Type\PersonType;
use FOS\RestBundle\Controller\Annotations\View;

/**
 * @Route("/person")
 */
class PersonController extends Controller {

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContextInterface::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        }

        return $this->render(
            'ZerodineMakeSomeoneHappyBundle:Person:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $session->get(SecurityContextInterface::LAST_USERNAME),
                'error'         => $error,
            )
        );
    }

    /**
     * @Route("/add")
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request)
    {
        $person = new Person();

        $form = $this->createForm(new PersonType(get_class(new Person())), $person);

        $form->handleRequest($request);

        if ($form->isValid()) {
            /*$factory = $this->get('security.encoder_factory');

            $encoder = $factory->getEncoder($user);
            $password = $encoder->encodePassword('ryanpass', $user->getSalt());

            $person*/

            $em = $this->getDoctrine()->getManager();
            $em->persist($person);
            $em->flush();
        }

        return $this->render('ZerodineMakeSomeoneHappyBundle:Person:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @return array
     * @View()
     */
    public function getPersonsAction() {
        $persons = $this->getDoctrine()->getRepository('ZerodineMakeSomeoneHappyBundle:Person')
            ->findAll();

        return array('persons' => $persons);
    }

    /**
     * @param Person $person
     * @return array
     * @View()
     */
    public function getPersonAction(Person $person) {
        return array('person' => $person);
    }
}