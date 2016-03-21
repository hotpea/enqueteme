<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alternatives
 *
 * @ORM\Table(name="alternatives")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AlternativesRepository")
 */
class Alternatives
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
     * @ORM\Column(name="text", type="string", length=200)
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity="Questions")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id")
     */
    private $question;

    function __construct($text, $question)
    {
        $this->text = $text;
        $this->question = $question;
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
     * Set text
     *
     * @param string $text
     * @return Alternatives
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param mixed $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }


}
