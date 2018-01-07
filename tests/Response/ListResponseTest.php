<?php
class ListResponseTest extends \PHPUnit\Framework\TestCase
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
     * @var \Pbxg33k\UtorrentClient\Response\ListResponse
     */
    protected $listResponse;

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

        $this->inputString = file_get_contents(__DIR__.'/../mock-response/action-list');

        $this->listResponse = (new \Pbxg33k\UtorrentClient\Response\ListResponse())
            ->setCache($cache);
    }

    /**
     * @test
     */
    public function canDecodeFromUtorrentResponse()
    {
        $this->cache->expects($this->exactly(2))->method('getItem')->willReturn($this->cacheItem);
        $this->cacheItem->expects($this->exactly(2))->method('isHit');
        $this->cacheItem->expects($this->exactly(2))->method('set');
        $this->cache->expects($this->exactly(2))->method('saveDeferred');
        $this->cache->expects($this->once())->method('commit');

        $this->listResponse
            ->fromHtml($this->inputString);


        $this->assertEquals(25110, $this->listResponse->getBuild());
        $this->assertEquals("Feed RSS|http://www.domain.tld/", $this->listResponse->getRssFeeds()->first()->getUrl());
        $this->assertEquals("Games", $this->listResponse->getLabels()->first()->getName());
        $this->assertEquals("http://www.domain.tld/", $this->listResponse->getRssFilters()->first()->getName());
        $this->assertEquals("1234567890ABCDEF1234567890ABCDEF12345678", $this->listResponse->getTorrents()->first()->getHash());
        $this->assertEquals(1326537909, $this->listResponse->getTorrentc());
    }

    /**
     * @test
     */
    public function canRecreateuTorrentResponse()
    {
        $this->cache->expects($this->exactly(2))->method('getItem')->willReturn($this->cacheItem);
        $this->cacheItem->expects($this->exactly(2))->method('isHit');
        $this->cacheItem->expects($this->exactly(2))->method('set');
        $this->cache->expects($this->exactly(2))->method('saveDeferred');
        $this->cache->expects($this->once())->method('commit');

        $this->listResponse
            ->fromHtml($this->inputString);

        $this->assertEquals(str_replace("\n","", $this->inputString), $this->listResponse->toOriginalFormatString());
    }

    /**
     * @test
     */
    public function willUseCache()
    {
        $this->cache->expects($this->exactly(2))->method('getItem')->willReturn($this->cacheItem);
        $this->cacheItem->expects($this->exactly(2))->method('isHit')->willReturn(true);
        $this->cacheItem->expects($this->exactly(2))->method('get')->willReturn((new \Pbxg33k\UtorrentClient\Model\Torrent())->setName("Cached"));

        $this->listResponse->fromHtml($this->inputString);

        $this->assertEquals("Cached", $this->listResponse->getTorrents()->first()->getName());
    }
}