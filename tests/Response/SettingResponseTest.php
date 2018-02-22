<?php
class SettingResponseTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    protected $cache;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    protected $cacheItem;

    /**
     * @var \Pbxg33k\UtorrentClient\Response\SettingsResponse
     */
    protected $settingResponse;

    /**
     * @var string
     */
    protected $inputString;

    public function setUp()
    {
        $cache = $this->cache = $this->getMockBuilder(\Psr\Cache\CacheItemPoolInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->client = $this->getMockBuilder(\GuzzleHttp\ClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->cacheItem = $this->getMockBuilder(\Psr\Cache\CacheItemInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->inputString = file_get_contents(__DIR__.'/../mock-response/action-getsettings');

        $this->propResponse = (new \Pbxg33k\UtorrentClient\Response\SettingsResponse())
            ->setCache($cache)
            ->fromHtml($this->inputString);
    }

    /**
     * @test
     */
    public function canRecreateuTorrentResponse()
    {
        $this->assertEquals(str_replace(PHP_EOL ,"", $this->inputString), $this->propResponse->toOriginalFormatString());
    }

}