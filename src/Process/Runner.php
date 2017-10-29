<?php

namespace myGedung\Modules\Process;

use myGedung\Modules\Contracts\RunableInterface;
use myGedung\Modules\Repository;

class Runner implements RunableInterface
{
    /**
     * The module instance.
     *
     * @var \myGedung\Modules\Repository
     */
    protected $module;

    /**
     * The constructor.
     *
     * @param \myGedung\Modules\Repository $module
     */
    public function __construct(Repository $module)
    {
        $this->module = $module;
    }

    /**
     * Run the given command.
     *
     * @param string $command
     */
    public function run($command)
    {
        passthru($command);
    }
}
