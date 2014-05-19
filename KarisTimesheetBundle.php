<?php

namespace Karis\TimesheetBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class KarisTimesheetBundle extends Bundle
{
    protected $parent;

    /**
     * @param string $parent
     */
    public function __construct($parent = null)
    {
        $this->parent = $parent;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return $this->parent;
    }
}
