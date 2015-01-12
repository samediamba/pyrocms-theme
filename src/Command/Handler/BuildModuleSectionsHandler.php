<?php namespace Anomaly\PyrocmsTheme\Command\Handler;

use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\StreamsTheme\Command\BuildModuleSections;

/**
 * Class BuildModuleSectionsHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\StreamsTheme\Command
 */
class BuildModuleSectionsHandler
{

    /**
     * The loaded modules.
     *
     * @var \Anomaly\Streams\Platform\Addon\Module\ModuleCollection
     */
    protected $modules;

    /**
     * Create a new BuildThemeNavigationHandler instance.
     *
     * @param ModuleCollection $modules
     */
    public function __construct(ModuleCollection $modules)
    {
        $this->modules = $modules;
    }

    /**
     * Handle the command.
     *
     * @param BuildModuleSections $command
     * @return array
     */
    public function handle(BuildModuleSections $command)
    {
        $module = $this->modules->active();

        $sections = $module->getSections();

        if (!$sections) {
            return null;
        }

        /**
         * Get the generic module section data from the active
         * module and pass it through some processing.
         *
         * Keep it generic but helpful.
         */
        foreach ($module->getSections() as $slug => $section) {

            if (is_string($section)) {

                $slug    = $section;
                $section = [];
            }

            // Build out required data.
            $section['slug'] = $slug;

            // Skip if disabled.
            if (array_get($section, 'enabled', true) == false) {

                continue;
            }

            $active = false;
            $url    = $this->getUrl($section, $module);
            $title  = $this->getTitle($section, $module);

            $section = compact('slug', 'url', 'title', 'active');

            $sections[$slug] = $section;
        }

        // Set the active section.
        $this->setActive($sections);

        return $sections;
    }

    /**
     * Get the title.
     *
     * @param array  $section
     * @param Module $module
     * @return string
     */
    protected function getTitle(array $section, Module $module)
    {
        return trans(array_get($section, 'title', $module->getNamespace('addon.section.' . $section['slug'])));
    }

    /**
     * Get the URL.
     *
     * @param array  $section
     * @param Module $module
     * @return string
     */
    protected function getUrl(array $section, Module $module)
    {
        if ($module->getSlug() == $section['slug']) {

            $default = $module->getSlug();
        } else {

            $default = $module->getSlug() . '/' . $section['slug'];
        }

        return url(array_get($section, 'url', 'admin/' . $default));
    }

    /**
     * Set the active section based on the longest section
     * URL found to be contained within the current URL.
     *
     * @param array $sections
     */
    protected function setActive(array &$sections)
    {
        $slug   = null;
        $active = null;

        $url = app('request')->url();

        foreach ($sections as $section) {

            if (str_contains($url, $section['url']) and strlen($section['url']) > strlen($active)) {

                $slug   = $section['slug'];
                $active = $section['url'];
            }
        }

        $sections[$slug]['active'] = true;
    }
}
 