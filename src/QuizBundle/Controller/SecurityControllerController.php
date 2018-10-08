<?php

namespace QuizBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\UserBundle\Controller\SecurityController as BaseController;
use Symfony\Component\HttpFoundation\Session\Session;

class SecurityControllerController extends BaseController
{

	/**
	 * @Route("/login", name="check_login")
	 */
	public function loginAction(Request $request)
	{

		$auth_checker = $this->get('security.authorization_checker');
		$router = $this->get('router');
		if ($auth_checker->isGranted(['ROLE_ADMIN'])) {
			// ROLE_ADMIN roles go to the `admin_check` route
			return $this->redirectToRoute('start_quiz', array(), 301);
		}
		if ($auth_checker->isGranted('ROLE_USER')) {
			$user = $this->container->get('security.token_storage')->getToken()->getUser();
			$session = new Session();
			$session->set('round', $user);
			return $this->redirectToRoute('start_quiz', array(), 301);
		}
		return parent::loginAction($request);
	}

}
