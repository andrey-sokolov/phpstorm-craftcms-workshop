<?php
/**
 * Created by PhpStorm.
 * User: andreysokolov
 * Date: 2018-09-18
 * Time: 02:17
 */

namespace workshop\widget;
use Craft;
use craft\base\Widget;
use workshop\assets\CompilerAsset;

class CompilerWidget extends Widget
{
    public $code;
    public static function displayName(): string
    {
        return Craft::t('app', 'Compiler');
    }

    public function getTitle(): string
    {
        return self::displayName();
    }

    public function getBodyHtml()
    {
        $view = Craft::$app->getView();
        $view->registerAssetBundle(CompilerAsset::class);
        return Craft::$app->view->renderTemplate("phpstorm-craft-workshop/_widget.twig",
                ['widget' => $this]);
    }


}