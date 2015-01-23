<?php namespace Anomaly\PyrocmsTheme;

use Anomaly\PyrocmsTheme\Command\BuildModuleSections;
use Anomaly\PyrocmsTheme\Command\BuildSectionButtons;
use Anomaly\PyrocmsTheme\Command\BuildThemeNavigation;
use Anomaly\PyrocmsTheme\Command\RenderToolbar;
use Illuminate\Foundation\Bus\DispatchesCommands;

/**
 * Class PyrocmsThemePluginFunctions
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\PyrocmsTheme
 */
class PyrocmsThemePluginFunctions
{

    use DispatchesCommands;

    /**
     * The theme object.
     *
     * @var PyrocmsTheme
     */
    protected $theme;

    /**
     * Create a new PyrocmsThemePluginFunctions instance.
     *
     * @param PyrocmsTheme $theme
     */
    public function __construct(PyrocmsTheme $theme)
    {
        $this->theme = $theme;
    }

    /**
     * Render the toolbar partial.
     *
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function toolbar()
    {
        return $this->dispatch(new RenderToolbar());
    }

    /**
     * Return navigation.
     *
     * @return array
     */
    public function nav()
    {
        return $this->dispatch(new BuildThemeNavigation());
    }

    /**
     * Return sections for the theme.
     *
     * @return mixed
     */
    public function sections()
    {
        return $this->dispatch(new BuildModuleSections());
    }

    /**
     * Return the actions for the active section.
     *
     * @return null
     */
    public function actions()
    {
        $section = $this->getActiveSection();

        return $this->dispatch(new BuildSectionButtons($section));
    }

    /**
     * Return the pagination meta.
     *
     * @return string
     */
    public function pagination()
    {
        $pagination = $this->theme->pullMeta('pagination', []);

        if (!$pagination) {

            return null;
        }

        $from  = array_get($pagination, 'from');
        $to    = array_get($pagination, 'to');
        $total = array_get($pagination, 'total');

        return trans('theme::admin.pagination', compact('from', 'to', 'total'));
    }

    /**
     * Return the footprint string.
     *
     * @return string
     */
    public function footprint()
    {
        $time   = $this->requestTime();
        $memory = $this->memoryUsage();

        return trans('theme::admin.footprint', compact('time', 'memory'));
    }

    /**
     * Get the active section slug.
     *
     * @return mixed
     */
    protected function getActiveSection()
    {
        $sections = $this->sections();

        if (!$sections) {
            return null;
        }

        foreach ($sections as $section) {

            if ($section['active']) {

                return array_get($section, 'slug', null);
            }
        }

        return null;
    }

    /**
     * Return the elapsed request time.
     *
     * @return string
     */
    protected function requestTime()
    {
        return number_format(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 2) . ' s';
    }

    /**
     * Return the memory usage of the request.
     *
     * @return string
     */
    protected function memoryUsage()
    {
        $unit = array('b', 'kb', 'mb');

        $size = memory_get_usage(true);

        return round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
    }
}
