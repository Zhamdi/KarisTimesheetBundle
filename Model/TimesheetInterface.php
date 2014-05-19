<?php

namespace Karis\TimesheetBundle\Model;

interface TimesheetInterface
{
    /**
     * Set date
     *
     * @param  \DateTime $date
     * @return Timesheet
     */
    public function setDate($date);

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate();

    /**
     * Set timeSpent
     *
     * @param  \DateTime $timeSpent
     * @return Timesheet
     */
    public function setTimeSpent($timeSpent);

    /**
     * Get timeSpent
     *
     * @return \DateTime
     */
    public function getTimeSpent();

    /**
     * Set createdAt
     *
     * @param  \DateTime $createdAt
     * @return Timesheet
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
     * @return Timesheet
     */
    public function setUpdatedAt($updatedAt);

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt();
}
