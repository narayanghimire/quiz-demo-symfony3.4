<?php
/**
 * Created by PhpStorm.
 * User: narayanghimire
 * Date: 06.10.18
 * Time: 22:39
 */

namespace QuizBundle\services;

use Doctrine\ORM\EntityManager;
use QuizBundle\Entity\round;
use QuizBundle\Entity\user;
use QuizBundle\Repository\roundRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class saveQuizData implements saveQuizDataInterFaces {

	/**
	 * @var EntityManager
	 */
	private $em;


	/**
	 * saveQuizData constructor.
	 * @param EntityManager $entityManager
	 */
	public function __construct(EntityManager $dbalConnection) {

		$this->em = $dbalConnection;
	}

	/**
	 * @param $number
	 * @return string
	 */
	public function numberToRomanRepresentation($number) {

		$n = intval($number);
		$res = '';

		/*** roman_numerals array  ***/
		$roman_numerals = [
			'M'  => 1000,
			'CM' => 900,
			'D'  => 500,
			'CD' => 400,
			'C'  => 100,
			'XC' => 90,
			'L'  => 50,
			'XL' => 40,
			'X'  => 10,
			'IX' => 9,
			'V'  => 5,
			'IV' => 4,
			'I'  => 1
		];

		foreach ($roman_numerals as $roman => $number) {
			/*** divide to get  matches ***/
			$matches = intval($n / $number);

			/*** assign the roman char * $matches ***/
			$res .= str_repeat($roman, $matches);

			/*** substract from the number ***/
			$n = $n % $number;
		}

		/*** return the res ***/
		return $res;
	}


	/**
	 * @return array
	 */
	public function getQuizQuestion() {

		$romanNumber = [];
		for ($i = 0; $i <= 10; $i++) {
			$number = rand(1, 100);
			$romanNumber[] = $this->numberToRomanRepresentation($number);
		}

		/*$answer = [];
		foreach ($romanNumber as $roman){
			$answer[] = $this->numberPresentationFromRomanToIntger($roman);

		}

		$quizQuestion= array_combine($answer,$romanNumber);*/

		return $romanNumber;
	}


	/**
	 * @param $question
	 * @return array
	 */
	public function numberPresentationFromRomanToIntger($question) {

		$romans = [
			'M'  => 1000,
			'CM' => 900,
			'D'  => 500,
			'CD' => 400,
			'C'  => 100,
			'XC' => 90,
			'L'  => 50,
			'XL' => 40,
			'X'  => 10,
			'IX' => 9,
			'V'  => 5,
			'IV' => 4,
			'I'  => 1,
		];

		$roman = $question;
		$result = 0;

		foreach ($romans as $key => $value) {
			while (strpos($roman, $key) === 0) {
				$result += $value;
				$roman = substr($roman, strlen($key));
			}
		}

		return [$result];
	}


	/**
	 * @param user $user
	 * @param $round
	 * @param $answer
	 * @param $question
	 * @throws \Doctrine\ORM\OptimisticLockException
	 */
	public function saveUserQuizData(user $user, $round, $answer, $question) {

		$round = $this->em->getRepository(round::class)->findOneBy(['id' => $round]);
		$getNumber = $this->numberPresentationFromRomanToIntger($question);
		if ($getNumber[0] == $answer) {
			$score = $round->getScore() + 1;
			$round->setScore($score);
			$this->em->persist($round);
			$this->em->flush($round);
		}
		else {
			$round->setScore($round->getScore());
			$this->em->persist($round);
			$this->em->flush($round);
		}

		return;
	}


	/**
	 * @param user $user
	 * @return round
	 * @throws \Doctrine\ORM\OptimisticLockException
	 */
	public function createQuizRound(user $user) {

		$round = new round();
		$round->setUser($user);
		$round->setScore(0);
		$round->setCreatedAt(new \DateTime());
		$round->setLastModified(new \DateTime());
		$this->em->persist($round);
		$this->em->flush($round);

		return $round;
	}


	/**
	 * @param $round
	 * @return null|object|round
	 */
	public function showFinalResult($round) {
		$score = $this->em->getRepository(round::class)->findOneBy(['id' => $round], ['lastModified' => 'DESC']);
		$score = $score->getScore();

		return $score;
	}

	public function getAllUserScore(){

		$userScore = $this->em->getRepository(round::class)->findBy([],['lastModified'=>'DESC']);
		return $userScore;

	}
}