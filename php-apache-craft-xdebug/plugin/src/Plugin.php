<?php

namespace workshop;

use craft\services\Dashboard;
use workshop\services\Evaluator;
use workshop\widget\CompilerWidget;
use yii\base\Event;
use craft\events\RegisterComponentTypesEvent;


class Plugin extends \craft\base\Plugin {

    public function init()
    {
        parent::init();
        $this->setComponents(['evaluator' => Evaluator::class]);
        Event::on(Dashboard::class, Dashboard::EVENT_REGISTER_WIDGET_TYPES, function(RegisterComponentTypesEvent $event) {
            $event->types[] = CompilerWidget::class;
        });
    }

    /**
     * @return Evaluator
     * @throws \yii\base\InvalidConfigException
     */
    public function getEvaluator() {
        return $this->get("evaluator");
    }


}
