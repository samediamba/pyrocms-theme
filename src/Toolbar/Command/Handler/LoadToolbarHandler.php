<?php namespace Anomaly\PyrocmsTheme\Toolbar\Command\Handler;

use Anomaly\PyrocmsTheme\Toolbar\Command\LoadToolbar;
use Anomaly\PyrocmsTheme\Toolbar\Component\Button\Command\LoadButtons;
use Anomaly\PyrocmsTheme\Toolbar\Component\Section\Command\LoadSections;
use Illuminate\Foundation\Bus\DispatchesCommands;

/**
 * Class LoadToolbarHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\PyrocmsTheme\Toolbar\Command\Handler
 */
class LoadToolbarHandler
{

    use DispatchesCommands;

    /**
     * @param LoadToolbar $command
     */
    public function handle(LoadToolbar $command)
    {
        $toolbar = $command->getToolbar();

        $this->dispatch(new LoadSections($toolbar));
        $this->dispatch(new LoadButtons($toolbar));
    }
}
