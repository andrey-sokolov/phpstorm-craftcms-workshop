<?php
namespace workshop\controllers;

use Craft;
use craft\web\Controller;
use workshop\Plugin;

class CompilerController extends Controller {
    protected $allowAnonymous = true;
    public function actionSubmit() {
        $this->requirePostRequest();
        $request = Craft::$app->getRequest();
        $code = $request->getParam("code");
        $output = Plugin::getInstance()->getEvaluator()->postCode($code);
        return $this->asJson($output);
    }

    public function actionTest()
    {
        return 'test';
    }
}