<?php

namespace Karis\TimesheetBundle\Entity;

use Karis\TimesheetBundle\Model\Timesheet as BaseTimesheet;
use Doctrine\ORM\Mapping as ORM;

/**
 * Timesheet
 *
 * @ORM\Table(name="karis_timesheet_timesheet")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Timesheet extends BaseTimesheet
{
    /**
     * Hook on pre-persist operations
     *
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->createdAt = new \DateTime;
        $this->updatedAt = new \DateTime;
    }

    /**
     * Hook on pre-update operations
     *
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime;
    }
}
