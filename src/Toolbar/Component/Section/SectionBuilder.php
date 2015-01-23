<?php namespace Anomaly\PyrocmsTheme\Toolbar\Component\Section;

use Anomaly\PyrocmsTheme\Toolbar\ToolbarBuilder;

/**
 * Class SectionBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\PyrocmsTheme\Toolbar\Component\Section
 */
class SectionBuilder
{

    /**
     * The section input.
     *
     * @var SectionInput
     */
    protected $input;

    /**
     * The section factory.
     *
     * @var SectionFactory
     */
    protected $factory;

    /**
     * Create a new SectionBuilder instance.
     *
     * @param SectionInput   $input
     * @param SectionFactory $factory
     */
    function __construct(SectionInput $input, SectionFactory $factory)
    {
        $this->input   = $input;
        $this->factory = $factory;
    }

    /**
     * Build the sections and push them to the toolbar.
     *
     * @param ToolbarBuilder $builder
     */
    public function build(ToolbarBuilder $builder)
    {
        $toolbar  = $builder->getToolbar();
        $sections = $toolbar->getSections();

        $this->input->read($builder);

        foreach ($builder->getSections() as $slug => $view) {
            $sections->push($this->factory->make($view));
        }
    }
}
