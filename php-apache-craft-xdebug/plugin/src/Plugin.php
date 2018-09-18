<?php

namespace workshop;

use Craft;
use craft\services\Dashboard;
use workshop\widget\CompilerWidget;
use yii\base\Event;
use craft\events\RegisterComponentTypesEvent;


class Plugin extends \craft\base\Plugin {

    public function init()
    {
        Event::on(Dashboard::class, Dashboard::EVENT_REGISTER_WIDGET_TYPES, function(RegisterComponentTypesEvent $event) {
            $event->types[] = CompilerWidget::class;
        });
    }


}
