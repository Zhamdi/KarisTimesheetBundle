<?php

namespace Karis\TimesheetBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Project
 *
 */
class Project implements ProjectInterface
{
    /**
     *@var  \Karis\TimesheetBundle\Entity\Timesheet
     * 
     * @ORM\OneToMany(targetEntity="Timesheet", mappedBy="project", cascade={"persist", "remove"})
     */
    protected $timesheet;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="estimated_time", type="datetime")
     */
    protected $estimatedTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->timesheet = new ArrayCollection();
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
     * Set name
     *
     * @param  string  $name
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
     * Set estimatedTime
     *
     * @param  \DateTime $estimatedTime
     * @return Project
     */
    public function setEstimatedTime($estimatedTime)
    {
        $this->estimatedTime = $estimatedTime;

        return $this;
    }

    /**
     * Get estimatedTime
     *
     * @return \DateTime
     */
    public function getEstimatedTime()
    {
        return $this->estimatedTime;
    }

    /**
     * Set createdAt
     *
     * @param  \DateTime $createdAt
     * @return Project
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param  \DateTime $updatedAt
     * @return Project
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add timesheet
     *
     * @param  \Karis\TimesheetBundle\Entity\Timesheet $timesheet
     * @return Project
     */
    public function addTimesheet($timesheet)
    {
        $this->timesheet[] = $timesheet;

        return $this;
    }

    /**
     * Remove timesheet
     *
     * @param \Karis\TimesheetBundle\Entity\Timesheet $timesheet
     */
    public function removeTimesheet($timesheet)
    {
        $this->timesheet->removeElement($timesheet);
    }

    /**
     * Get timesheet
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTimesheet()
    {
        return $this->timesheet;
    }

    /**
     * Represents a string representation
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getName();
    }
}
