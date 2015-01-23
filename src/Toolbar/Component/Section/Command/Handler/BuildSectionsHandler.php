<?php namespace Anomaly\PyrocmsTheme\Toolbar\Component\Section\Command\Handler;

use Anomaly\PyrocmsTheme\Toolbar\Component\Section\Command\BuildSections;
use Anomaly\PyrocmsTheme\Toolbar\Component\Section\SectionBuilder;

/**
 * Class BuildSectionsHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\PyrocmsTheme\Toolbar\Component\Section\Command\Handler
 */
class BuildSectionsHandler
{

    /**
     * The section builder.
     *
     * @var SectionBuilder
     */
    protected $builder;

    /**
     * Create a new BuildSectionsHandler instance.
     *
     * @param SectionBuilder $builder
     */
    public function __construct(SectionBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param BuildSections $command
     */
    public function handle(BuildSections $command)
    {
        $this->builder->build($command->getBuilder());
    }
}
