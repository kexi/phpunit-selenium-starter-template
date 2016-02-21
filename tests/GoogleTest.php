<?php

class GoogleTest extends PHPUnit_Extensions_Selenium2TestCase
{

    /**
     *
     * {@inheritDoc}
     *
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        $this->setBrowser('firefox');
        $this->setBrowserUrl('https://www.google.com/');
    }

    /**
     * @dataProvider keywordProvider
     *
     * @param $keyword string            
     */
    public function testSearch($keyword)
    {
        $this->url('/');
        $q = $this->byName('q');
        $q->value($keyword);
        $q->submit();
        sleep(5); // @todo use $this->waitUntil($callback, $timeout)
        $this->assertTrue(strpos($keyword, $this->title()) >= 0);
    }

    /**
     *
     * @return string[][]
     */
    public function keywordProvider()
    {
        return [
            'Key word 1' => [
                'dictionary'
            ],
            'Key word 2' => [
                'japanese'
            ]
        ];
    }
}