<?php

namespace QuizBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller {

	/**
	 * @Route("/", name="index_page")
	 */
	public function indexAction() {
		return $this->render('QuizBundle:Default:index.html.twig');
	}


	/**
	 * @Route("/admin", name="admin_check")
	 *
	 */
	public function adminAction(Request $request) {
		$userScore = $this->get('app.admin.save.quiz.data')->getAllUserScore();

		return $this->render('QuizBundle:Default:admin.html.twig', [

			'userScores' => $userScore,
		]);
	}


	/**
	 * @Route("/start", name="start_quiz")
	 */
	public function startQuizAction(Request $request) {

		$user = $this->getUser();
		if(!$user){
			return $this->redirectToRoute('fos_user_security_login', array(), 301);
		}
		$getQuestion = $this->get('app.admin.save.quiz.data')->getQuizQuestion();
		$round = $this->get('app.admin.save.quiz.data')->createQuizRound($user);

		return $this->render('QuizBundle:Default:startQuiz.html.twig', [
			'quizQuestions' => $getQuestion,
			'round'         => $round

		]);
	}


	/**
	 * @Route("/save/data", name="convert_number")
	 */
	public function saveQuizData(Request $request) {

		$round = $request->request->get('round');
		$answer = $request->request->get('choice');
		$question = $request->request->get('question');
		$user = $this->container->get('security.token_storage')->getToken()->getUser();
		$this->get('app.admin.save.quiz.data')->saveUserQuizData($user, $round, $answer, $question);

		return new  JsonResponse();
	}


	/**
	 * @Route("/convert/data", name="convert_integer")
	 */

	public function convertData(Request $request) {

		$romanNumber = $request->request->get('rand');
		$result = $this->get('app.admin.save.quiz.data')->numberPresentationFromRomanToIntger($romanNumber);
		$number = [];
		for ($i = 0; $i < 3; $i++) {
			$number[] = rand(1, 100);
		}
		$response = array_merge($result, $number);
		shuffle($response);
		shuffle($response);

		return new JsonResponse($response);
	}


	/**
	 * @Route("/show/result", name="user_score")
	 */
	public function showQuizResult(Request $request) {

		$round = $request->request->get('round');
		$getFinalScore = $this->get('app.admin.save.quiz.data')->showFinalResult($round);

		return new JsonResponse($getFinalScore);
	}


	/**
	 * @Route("/convert/intger/roman", name="convert_roman")
	 */
	public function convertToInteger(Request $request) {

		$guess = $request->request->get('guess');
		$question = $request->request->get('ques');
		$split = str_split($guess, 12);
		$guessValue = intval($split[1]);
		$realNumber = $this->get('app.admin.save.quiz.data')->numberPresentationFromRomanToIntger($question);
		if ($realNumber[0] == $guessValue) {
			$guessCorrection = 1;
		}
		else {
			$guessCorrection = 0;
		}

		return new JsonResponse($guessCorrection);
	}

}
