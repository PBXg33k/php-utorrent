<?php
class PropResponseTest extends \PHPUnit\Framework\TestCase
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
     * @var \Pbxg33k\UtorrentClient\Response\PropResponse
     */
    protected $propResponse;

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

        $this->inputString = file_get_contents(__DIR__.'/../mock-response/action-getprops');

        $this->propResponse = (new \Pbxg33k\UtorrentClient\Response\PropResponse())
            ->setCache($cache)
            ->fromHtml($this->inputString);
    }

    /**
     * @test
     */
    public function canDecodeFromUtorrentResponse()
    {
        $this->assertEquals(25110, $this->propResponse->getBuild());

    }

    /**
     * @test
     */
    public function canRecreateuTorrentResponse()
    {
        $this->assertEquals(trim(preg_replace('~\r\n?~',"", $this->inputString)), $this->propResponse->toOriginalFormatString());
    }
}