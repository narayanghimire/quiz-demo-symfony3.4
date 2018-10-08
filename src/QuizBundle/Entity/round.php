<?php

namespace QuizBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * round
 *
 * @ORM\Table(name="round")
 * @ORM\Entity(repositoryClass="QuizBundle\Repository\roundRepository")
 */
class round
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

	/**
	 * @ORM\ManyToOne(targetEntity="QuizBundle\Entity\user")
	 */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="score", type="string", length=255, nullable= true)
     */
    private $score;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set user
     *
     * @param string $user
     *
     * @return round
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set score
     *
     * @param string $score
     *
     * @return round
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return string
     */
    public function getScore()
    {
        return $this->score;
    }

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="createdAt", type="datetime", nullable= true)
	 */
	private $createdAt;


	/**
	 * @return \DateTime
	 */
	public function getCreatedAt() {
		return $this->createdAt;
	}


	/**
	 * @param \DateTime $createdAt
	 */
	public function setCreatedAt($createdAt) {
		$this->createdAt = $createdAt;
	}


	/**
	 * @return \DateTime
	 */
	public function getLastModified() {
		return $this->lastModified;
	}


	/**
	 * @param \DateTime $lastModified
	 */
	public function setLastModified($lastModified) {
		$this->lastModified = $lastModified;
	}

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="lastModified", type="datetime", nullable= true)
	 */
	private $lastModified;
}

