<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Questions
 *
 * @ORM\Table(name="questions")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QuestionsRepository")
 */
class Questions
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
     * @var string
     *
     * @ORM\Column(name="question", type="string", length=200)
     */
    private $question;

    /**
     * @return mixed
     */
    public function getAlternatives()
    {
        return $this->alternatives;
    }

    /**
     * @param mixed $alternatives
     */
    public function setAlternatives($alternatives)
    {
        $this->alternatives = $alternatives;
    }

    /**
     * @ORM\OneToMany(targetEntity="Alternatives", mappedBy="question")
     */
    private $alternatives;

    /**
     * @ORM\ManyToOne(targetEntity="Enquete")
     * @ORM\JoinColumn(name="enquete_id", referencedColumnName="id")
     */
    private $enquete;

    function __construct($question, $enquete)
    {
        $this->question = $question;
        $this->enquete = $enquete;
        return $this;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param string $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @return mixed
     */
    public function getEnquete()
    {
        return $this->enquete;
    }

    /**
     * @param mixed $enquete
     */
    public function setEnquete($enquete)
    {
        $this->enquete = $enquete;
    }


}
