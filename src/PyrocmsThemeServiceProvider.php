<?php namespace Anomaly\PyrocmsTheme;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

/**
 * Class PyrocmsThemeServiceProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\PyrocmsTheme
 */
class PyrocmsThemeServiceProvider extends AddonServiceProvider
{

    /**
     * The addon plugins.
     *
     * @var array
     */
    protected $plugins = [
        'Anomaly\PyrocmsTheme\PyrocmsThemePlugin'
    ];

}
 