<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Link
 *
 * @ORM\Table(name="link")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\LinkRepository")
 */
class Link
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
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Task", inversedBy="sourceLinks")
     */
    private $source;

    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Task", inversedBy="targetLinks")
     */
    private $target;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Project", inversedBy="links")
     */
    private $project;


    public function __construct(){
        $this->type = "0";
    }


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
     * Set type
     *
     * @param string $type
     *
     * @return Link
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set source
     *
     * @param \MainBundle\Entity\Task $source
     *
     * @return Link
     */
    public function setSource(\MainBundle\Entity\Task $source = null)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return \MainBundle\Entity\Task
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set target
     *
     * @param \MainBundle\Entity\Task $target
     *
     * @return Link
     */
    public function setTarget(\MainBundle\Entity\Task $target = null)
    {
        $this->target = $target;

        return $this;
    }

    /**
     * Get target
     *
     * @return \MainBundle\Entity\Task
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Set project
     *
     * @param \MainBundle\Entity\Project $project
     *
     * @return Link
     */
    public function setProject(\MainBundle\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \MainBundle\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
    }
}
