<?php namespace Anomaly\Streams\Addon\Theme\Streams\Listener;

use Anomaly\Streams\Platform\Ui\Table\Event\TableDataLoaded;
use Laracasts\Commander\Events\EventListener;

class TableListener extends EventListener
{

    public function whenTableDataLoaded(TableDataLoaded $event)
    {
        $table = $event->getTable();

        $pagination = $table->pullData('pagination');

        $theme = app('streams.themes')->active();

        $theme->putMeta('pagination', $pagination);
    }
}
 