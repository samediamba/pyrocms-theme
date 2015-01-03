<?php namespace Anomaly\PyrocmsTheme;

use Illuminate\Support\ServiceProvider;

/**
 * Class PyrocmsThemeServiceProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\PyrocmsTheme
 */
class PyrocmsThemeServiceProvider extends ServiceProvider
{

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        app('twig')->addExtension(app('Anomaly\PyrocmsTheme\PyrocmsThemePlugin'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        app('events')->listen(
            'Anomaly.Streams.Platform.Ui.Table.Event.*',
            'Anomaly\PyrocmsTheme\Listener\TableListener'
        );
    }
}
 