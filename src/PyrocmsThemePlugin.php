<?php namespace Anomaly\PyrocmsTheme;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Laracasts\Commander\CommanderTrait;

/**
 * Class PyrocmsThemePlugin
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\PyrocmsTheme
 */
class PyrocmsThemePlugin extends Plugin
{

    /**
     * The plugin functions handler.
     *
     * @var PyrocmsThemePluginFunctions
     */
    protected $functions;

    /**
     * Create a new PyrocmsThemePlugin instance.
     *
     * @param PyrocmsThemePluginFunctions $functions
     */
    public function __construct(PyrocmsThemePluginFunctions $functions)
    {
        $this->functions = $functions;
    }

    /**
     * Return functions to allow interaction
     * with the theme and it's features.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('theme_nav', [$this->functions, 'nav']),
            new \Twig_SimpleFunction('theme_actions', [$this->functions, 'actions']),
            new \Twig_SimpleFunction('theme_sections', [$this->functions, 'sections']),
            new \Twig_SimpleFunction('theme_footprint', [$this->functions, 'footprint']),
            new \Twig_SimpleFunction('theme_pagination', [$this->functions, 'pagination']),
        ];
    }
}
