<?php
/**
 * Created by PhpStorm.
 * User: andreysokolov
 * Date: 2018-09-18
 * Time: 03:41
 */

namespace workshop\assets;


use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

class CompilerAsset extends AssetBundle
{
    public function init()
    {
        $this->sourcePath = __DIR__ . '/dist';

        // define the dependencies
        $this->depends = [
            CpAsset::class,
        ];
        $this->js = ["CompilerWidget.js"];
        $this->css = ["CompilerWidget.css"];
    }

}