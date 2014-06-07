<?php

namespace Zerodine\Bundle\MakeSomeoneHappyBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Zerodine\Bundle\MakeSomeoneHappyBundle\Entity\User;
use Zerodine\Bundle\MakeSomeoneHappyBundle\Form\Type\UserType;
use FOS\RestBundle\Controller\Annotations\View;

class UserController extends Controller {

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
            'ZerodineMakeSomeoneHappyBundle:User:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $session->get(SecurityContextInterface::LAST_USERNAME),
                'error'         => $error,
            )
        );
    }

    public function registerAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(new UserType(get_class(new User())), $user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }

        return $this->render('ZerodineMakeSomeoneHappyBundle:User:register.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function indexAction() {
        $user = $this->container->get('security.context')->getToken()->getUser();

        return $this->render('ZerodineMakeSomeoneHappyBundle:User:index.html.twig', array(
        ));
    }

    /**
     * @return array
     * @View()
     */
    // Only neede if browser makes preflight OPTIONS call
    /*public function optionsUsersAction()
    {
        $response = new Response();
        $response->headers->set('Allow', 'OPTIONS, GET, PATCH, POST');
        return $response;
    }*/

    /**
     * @param $user
     * @View()
     */
    public function postUserAction() {

    }

    /**
     * @return array
     * @View()
     */
    public function getUsersAction() {
        $users = $this->getDoctrine()->getRepository('ZerodineMakeSomeoneHappyBundle:User')
            ->findAll();

        return array('users' => $users);
    }

    /**
     * @param User $user
     * @return array
     * @View()
     */
    public function getUserAction(User $user) {

        return array('user' => $user);
    }
}