<?php namespace Anomaly\PyrocmsTheme\Toolbar\Command;

use Anomaly\PyrocmsTheme\Toolbar\ToolbarBuilder;

/**
 * Class BuildToolbar
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\PyrocmsTheme\Toolbar\Command
 */
class BuildToolbar
{

    /**
     * The builder object.
     *
     * @var ToolbarBuilder
     */
    protected $builder;

    /**
     * Create a new BuildToolbar instance.
     *
     * @param ToolbarBuilder $builder
     */
    public function __construct(ToolbarBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Get the builder.
     *
     * @return ToolbarBuilder
     */
    public function getBuilder()
    {
        return $this->builder;
    }
}
