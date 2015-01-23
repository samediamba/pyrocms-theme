<?php namespace Anomaly\PyrocmsTheme\Toolbar\Command\Handler;

use Anomaly\PyrocmsTheme\Toolbar\Command\BuildToolbar;
use Anomaly\PyrocmsTheme\Toolbar\Component\Button\Command\BuildButtons;
use Anomaly\PyrocmsTheme\Toolbar\Component\Section\Command\BuildSections;
use Anomaly\PyrocmsTheme\Toolbar\Component\Section\Command\SetActiveSection;
use Illuminate\Foundation\Bus\DispatchesCommands;

/**
 * Class BuildToolbarHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\PyrocmsTheme\Toolbar\Command\Handler
 */
class BuildToolbarHandler
{

    use DispatchesCommands;

    /**
     * @param BuildToolbar $command
     */
    public function handle(BuildToolbar $command)
    {
        $builder = $command->getBuilder();

        $this->dispatch(new BuildSections($builder));
        $this->dispatch(new SetActiveSection($builder));

        $this->dispatch(new BuildButtons($builder));
    }
}
