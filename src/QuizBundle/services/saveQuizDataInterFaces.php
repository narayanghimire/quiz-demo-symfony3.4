<?php
/**
 * Created by PhpStorm.
 * User: narayanghimire
 * Date: 08.10.18
 * Time: 05:03
 */

namespace QuizBundle\services;

use QuizBundle\Entity\user;

interface saveQuizDataInterFaces {


	##### converting Real number to Roman Represenation#######
	/**
	 * @param $number
	 * @return mixed
	 */
	public function numberToRomanRepresentation($number);

	##### Getting or Displays the Roman number from 1 too 100 #######
	/**
	 * @return mixed
	 */
	public function getQuizQuestion();


	##### Converting Number from Roman presentation to Integer Represenation #######
	/**
	 * @param $question
	 * @return mixed
	 */
	public function numberPresentationFromRomanToIntger($question);



	###### save quiz data answered by the user###############
	/**
	 * @param user $user
	 * @param $round
	 * @param $answer
	 * @param $question
	 * @return mixed
	 */
	public function saveUserQuizData(user $user, $round, $answer, $question);

	#########create the quiz Round at the starting of quiz #############
	/**
	 * @param user $user
	 * @return mixed
	 */
	public function createQuizRound(user $user);

	######### Show final Result of Quiz #############
	/**
	 * @param $round
	 * @return mixed
	 */
	public function showFinalResult($round);

	######### Showing all user score card #######
	/**
	 * @return mixed
	 */
	public function getAllUserScore();


}