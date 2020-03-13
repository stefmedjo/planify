<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Task
 *
 * @ORM\Table(name="task")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\TaskRepository")
 */
class Task
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
     * @ORM\Column(name="code", type="string", length=255)
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
     * @ORM\Column(name="progress", type="float")
     */
    private $progress;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startDate", type="datetime")
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDate", type="datetime")
     */
    private $endDate;

    /**
     * @var bool
     *
     * @ORM\Column(name="isClosed", type="boolean")
     */
    private $isClosed;

    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Project", inversedBy="tasks")
     */
    private $project;

    /**
     * @ORM\OneToMany(targetEntity="MainBundle\Entity\Link", mappedBy="source", cascade={"remove"})
     */
    private $sourceLinks;

    /**
     * @ORM\OneToMany(targetEntity="MainBundle\Entity\Link", mappedBy="target", cascade={"remove"})
     */
    private $targetLinks;


    public function __construct(){
        $this->isClosed = false;
        $this->progress = 0.0;
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
     * Set code
     *
     * @param string $code
     *
     * @return Task
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
     * @return Task
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
     * @return Task
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
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Task
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return Task
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set isClosed
     *
     * @param boolean $isClosed
     *
     * @return Task
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
     * Set project
     *
     * @param \MainBundle\Entity\Project $project
     *
     * @return Task
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

    /**
     * Set progress
     *
     * @param float $progress
     *
     * @return Task
     */
    public function setProgress($progress)
    {
        $this->progress = $progress;

        return $this;
    }

    /**
     * Get progress
     *
     * @return float
     */
    public function getProgress()
    {
        return $this->progress;
    }

    /**
     * Add sourceLink
     *
     * @param \MainBundle\Entity\Link $sourceLink
     *
     * @return Task
     */
    public function addSourceLink(\MainBundle\Entity\Link $sourceLink)
    {
        $this->sourceLinks[] = $sourceLink;

        return $this;
    }

    /**
     * Remove sourceLink
     *
     * @param \MainBundle\Entity\Link $sourceLink
     */
    public function removeSourceLink(\MainBundle\Entity\Link $sourceLink)
    {
        $this->sourceLinks->removeElement($sourceLink);
    }

    /**
     * Get sourceLinks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSourceLinks()
    {
        return $this->sourceLinks;
    }

    /**
     * Add targetLink
     *
     * @param \MainBundle\Entity\Link $targetLink
     *
     * @return Task
     */
    public function addTargetLink(\MainBundle\Entity\Link $targetLink)
    {
        $this->targetLinks[] = $targetLink;

        return $this;
    }

    /**
     * Remove targetLink
     *
     * @param \MainBundle\Entity\Link $targetLink
     */
    public function removeTargetLink(\MainBundle\Entity\Link $targetLink)
    {
        $this->targetLinks->removeElement($targetLink);
    }

    /**
     * Get targetLinks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTargetLinks()
    {
        return $this->targetLinks;
    }
}
