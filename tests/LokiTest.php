<?php

use PHPUnit\Framework\TestCase;
use Loki\LokiHandler;
use Illuminate\Http\Response;

class LokiTest extends TestCase
{

    public function testSendStatisticFailed()
    {
        try {
            $result = LokiHandler::sendStatistic();
            $this->fail("Expected validation exception was not thrown.");
        } catch (\Exception $e) {
            $this->assertStringContainsString('No session data', $e->getMessage());
        }
    }

    public function testGetPageBlocks()
    {
        $params = [
            'blocks' => [
                'number' => 7,
                'blocks' => [
                    'faq_static'
                ],
                'ex_blocks' => [
                    'trigers_of_trust',
                    'image_right_block',
                    'results',
                    'test_block_static',
                    'price',
                    'category_slider_static'
                ]
            ],
            'ip' => '127.0.0.1',
            'uri' => '/',
            'user_agent' => 'Mozilla/5.0 (platform; rv:geckoversion) Gecko/geckotrail Firefox/firefoxversion',
        ];

        try {
            $_SERVER['HTTP_USER_AGENT'] = $params['user_agent'];
            $result = LokiHandler::getPageBlocks($params);
            $this->assertIsArray($result);
            //The way how response looks like
            $arrayResponse = [
                "turn" => [
                    "review" => 1,
                    "conv_test" => 0,
                    "faq_static" => 0,
                    "conv_right" => 0,
                    "master_spec" => 1,
                ],
                "uuid" => "5cc52673-12ca-42a6-bbc5-45746f4a1141",
            ];

            $this->assertArrayHasKey('turn', $result);
            $this->assertArrayHasKey('uuid', $result);

            $this->assertIsArray($result['turn']);

            $this->assertEquals('5cc52673-12ca-42a6-bbc5-45746f4a1141', $result['uuid']);
        } catch (\Exception $e) {
            $this->fail("fail test at getPageBlocks: " . $e->getMessage());
        }
    }

    public function testGetPageBlocksFailed()
    {
        $params = ['url' => 'http://example.com'];

        try {
            $result = LokiHandler::getPageBlocks($params);
            $this->fail("Expected validation exception was not thrown.");
        } catch (\Exception $e) {
            $this->assertStringContainsString('validation failed', $e->getMessage());
        }
    }

    public function sendStatistic()
    {
        try {
            $result = LokiHandler::sendStatistic();

            $this->assertInstanceOf(Response::class, $result);
        } catch (\Exception $e) {
            $this->fail("fail test at sendStatistic: " . $e->getMessage());
        }
    }


    public function testPostStatistic()
    {
        $params = [
            'data' => [
                'moves' => [],
                'lead' => false,
                'user_id' => '1231-1231-1231-1231',
                'forming_type' => 'random',
            ],
            'domain' => 'example.com',
            'city' => 'Kyiv',
            'country' => 'Ukraine',
            'ip' => '127.0.0.1',
            'uri' => '/',
            'user_agent' => 'Mozilla/5.0 (platform; rv:geckoversion) Gecko/geckotrail Firefox/firefoxversion',
        ];

        try {
            $result = LokiHandler::postStatistic($params);

            $this->assertInstanceOf(Response::class, $result);
        } catch (\Exception $e) {
            $this->fail("fail test at postStatistic: " . $e->getMessage());
        }
    }

    public function testPostStatisticFailed()
    {
        $params = ['key' => 'value'];

        try {
            $result = LokiHandler::postStatistic($params);
            $this->fail("Expected validation exception was not thrown.");
        } catch (\Exception $e) {
            $this->assertStringContainsString('validation failed', $e->getMessage());
        }
    }

    public function testPostAnalyticStatistic()
    {
        $params = [
            'data' => [
                'moves' => [],
                'lead' => false,
                'user_id' => '1231-1231-1231-1231',
                'forming_type' => 'random',
            ],
            'domain' => 'example.com',
            'city' => 'Kyiv',
            'country' => 'Ukraine',
            'ip' => '127.0.0.1',
            'uri' => '/',
            'user_agent' => 'Mozilla/5.0 (platform; rv:geckoversion) Gecko/geckotrail Firefox/firefoxversion',
        ];

        try {
            $result = LokiHandler::postAnalyticStatistic($params);

            $this->assertInstanceOf(Response::class, $result);
        } catch (\Exception $e) {
            $this->fail("fail test at postAnalyticStatistic: " . $e->getMessage());
        }
    }

    public function testPostAnalyticStatisticFailed()
    {
        $invalidParams = ['key' => 'value'];

        try {
            $result = LokiHandler::postAnalyticStatistic($invalidParams);
            $this->fail("Expected validation exception was not thrown.");
        } catch (\Exception $e) {
            $this->assertStringContainsString('validation failed', $e->getMessage());
        }
    }
}