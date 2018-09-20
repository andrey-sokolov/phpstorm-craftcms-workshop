<?php
/**
 * Created by PhpStorm.
 * User: andreysokolov
 * Date: 2018-09-20
 * Time: 05:32
 */

namespace workshop\services;

use workshop\lang\Compiler;
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
        $client = new \GuzzleHttp\Client();
        $promise = $client->postAsync('https://3v4l.org/new', [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',

            ],
            'allow_redirects' => false,//process requests one by one separately
            'form_params' => [
                'title' => 'test',
                'code' => $generatedCode
            ]

        ]);
        $response = $promise->wait();
        $location = $response->getHeader('location')[0];
        $getResponse = $client->get($location, ['headers' => [
            'Accept' => 'application/json']
        ]);

        $contents = $getResponse->getBody()->getContents();
        $json_decode = json_decode($contents);
        if (isset($json_decode->output[0]->output)) {
            return $json_decode->output[0]->output;
        } else {
            return 'error';
        }

    }
}