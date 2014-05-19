<?php

namespace Karis\TimesheetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Karis\TimesheetBundle\Model\Project as BaseProject;

/**
 * Project
 *
 * @ORM\Table(name="karis_timesheet_project")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Project extends BaseProject
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
