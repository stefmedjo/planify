<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\ProjectRepository")
 */
class Project
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
     * @ORM\Column(name="code", type="string", length=255, unique=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var bool
     *
     * @ORM\Column(name="isClosed", type="boolean")
     */
    private $isClosed;

    /**
     * @ORM\OneToMany(targetEntity="MainBundle\Entity\Task", mappedBy="project")
     */
    private $tasks;

    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Company", inversedBy="projects")
     */
    private $company;

    /**
     * @ORM\OneToMany(targetEntity="MainBundle\Entity\Link", mappedBy="project")
     */
    private $links;


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
     * Set code
     *
     * @param string $code
     *
     * @return Project
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Project
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Project
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set isClosed
     *
     * @param boolean $isClosed
     *
     * @return Project
     */
    public function setIsClosed($isClosed)
    {
        $this->isClosed = $isClosed;

        return $this;
    }

    /**
     * Get isClosed
     *
     * @return bool
     */
    public function getIsClosed()
    {
        return $this->isClosed;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tasks = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add task
     *
     * @param \MainBundle\Entity\Task $task
     *
     * @return Project
     */
    public function addTask(\MainBundle\Entity\Task $task)
    {
        $this->tasks[] = $task;

        return $this;
    }

    /**
     * Remove task
     *
     * @param \MainBundle\Entity\Task $task
     */
    public function removeTask(\MainBundle\Entity\Task $task)
    {
        $this->tasks->removeElement($task);
    }

    /**
     * Get tasks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * Set company
     *
     * @param \MainBundle\Entity\Company $company
     *
     * @return Project
     */
    public function setCompany(\MainBundle\Entity\Company $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \MainBundle\Entity\Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Add link
     *
     * @param \MainBundle\Entity\Link $link
     *
     * @return Project
     */
    public function addLink(\MainBundle\Entity\Link $link)
    {
        $this->links[] = $link;

        return $this;
    }

    /**
     * Remove link
     *
     * @param \MainBundle\Entity\Link $link
     */
    public function removeLink(\MainBundle\Entity\Link $link)
    {
        $this->links->removeElement($link);
    }

    /**
     * Get links
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLinks()
    {
        return $this->links;
    }
}
