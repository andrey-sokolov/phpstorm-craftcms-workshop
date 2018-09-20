<?php
/**
 * Created by PhpStorm.
 * User: andreysokolov
 * Date: 2018-09-20
 * Time: 05:32
 */

namespace workshop\services;


use Craft;
use workshop\lang\Compiler;
use workshop\lang\generator\CodeGenerator;
use workshop\lang\lexer\Scanner;
use workshop\lang\parser\Parser;
use yii\base\Component;

class Evaluator extends Component
{
    /**
     * @param $code
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function postCode($code)
    {
        $generatedCode = Compiler::compile($code);
        $client = Craft::createGuzzleClient(['base_uri' => 'https://3v4l.org', ['timeout' => 120, 'connect_timeout' => 120]]);
        $response = $client->post('/new', [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'code' => $generatedCode
            ]

        ]);
        return $response;

    }
}