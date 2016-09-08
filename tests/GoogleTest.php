<?php

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;

class GoogleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Facebook\WebDriver\WebDriver
     */
    protected $driver;

    /**
     *
     * {@inheritDoc}
     *
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        $host = 'http://localhost:4444/wd/hub';
        $capabilities = DesiredCapabilities::chrome();
        // $capabilities->setCapability(\Facebook\WebDriver\Remote\WebDriverCapabilityType::PROXY, 'your.proxy.com:8080');
        $driver = RemoteWebDriver::create($host, $capabilities);
        $this->driver = $driver;
    }

    /**
     *
     */
    public function tearDown()
    {
        $this->driver->close();
    }

    /**
     * @dataProvider keywordProvider
     *
     * @param $keyword string            
     */
    public function testSearch($keyword)
    {
        $this->driver->get('http://www.google.com/');
        $q = $this->driver->findElement(\Facebook\WebDriver\WebDriverBy::name('q'));
        $q->sendKeys($keyword);
        $q->submit();
        $this->assertTrue(strpos($keyword, $this->driver->getTitle()) >= 0);
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