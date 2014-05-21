<?php

namespace Karis\TimesheetBundle\Model;

interface ProjectInterface
{
    /**
     * Set name
     *
     * @param  string  $name
     * @return Project
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set estimatedTime
     *
     * @param  \DateTime $estimatedTime
     * @return Project
     */
    public function setEstimatedTime($estimatedTime);

    /**
     * Get estimatedTime
     *
     * @return \DateTime
     */
    public function getEstimatedTime();

    /**
     * Set createdAt
     *
     * @param  \DateTime $createdAt
     * @return Project
     */
    public function setCreatedAt($createdAt);

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Set updatedAt
     *
     * @param  \DateTime $updatedAt
     * @return Project
     */
    public function setUpdatedAt($updatedAt);

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt();

    /**
     * Add timesheet
     *
     * @param  \Karis\TimesheetBundle\Entity\Timesheet $timesheet
     * @return Project
     */
    public function addTimesheet($timesheet);

    /**
     * Remove timesheet
     *
     * @param \Karis\TimesheetBundle\Entity\Timesheet $timesheet
     */
    public function removeTimesheet($timesheet);

    /**
     * Get timesheet
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTimesheet();
}
