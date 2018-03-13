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
        $this->assertEquals(2, $this->listResponse->getTorrents()->count());
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

        $this->assertEquals(trim(preg_replace('~\r\n?~',"", $this->inputString)), $this->listResponse->toOriginalFormatString());
    }

    /**
     * @test
     */
    public function willUseCache()
    {
        $this->cache->expects($this->exactly(2))->method('getItem')->willReturn($this->cacheItem);
        $this->cacheItem->expects($this->exactly(2))->method('isHit')->willReturn(true);
        $this->cacheItem->expects($this->exactly(2))->method('get')->willReturn((new \Pbxg33k\UtorrentClient\Model\Torrent())->setSize(9001));

        $this->listResponse->fromHtml($this->inputString);

        $this->assertEquals(9001, $this->listResponse->getTorrents()->first()->getSize());
    }

    /**
     * @test
     */
    public function willPartiallyUpdateCache()
    {
        $this->cache->expects($this->exactly(2))->method('getItem')->willReturn($this->cacheItem);
        $this->cacheItem->expects($this->exactly(2))->method('isHit')->willReturn(true);
        $this->cacheItem->expects($this->exactly(2))->method('get')->willReturn(
            (new \Pbxg33k\UtorrentClient\Model\Torrent())
                ->setName("Cache")
                ->setProgress(0)
                ->setRemaining(999)
                ->setSize(11)
                ->setPeersInSwarm(39)
        );

        $this->listResponse->fromHtml($this->inputString);

        $torrent = $this->listResponse->getTorrents()->get(0);
        $this->assertEquals("1234567890ABCDEF1234567890ABCDEF12345678", $torrent->getHash());
        $this->assertEquals(137, $torrent->getStatus());
        $this->assertEquals(1000, $torrent->getProgress());
        $this->assertTrue((bool)(decbin($torrent->getStatus()) & \Pbxg33k\UtorrentClient\Model\Torrent::STATUS_STARTED));
        $this->assertEquals(11, $torrent->getSize());
        $this->assertEquals("Foo", $torrent->getName());
        $this->assertEquals(1, $torrent->getRemaining());
        $this->assertEquals(0, $torrent->getPeersInSwarm());

        $torrent = $this->listResponse->getTorrents()->get(1);
        $this->assertEquals("FEDCBA0987654321FEDCBA0987654321FEDCBA09", $torrent->getHash());
        $this->assertEquals(200, $torrent->getStatus());
        $this->assertEquals(0, $torrent->getProgress());
        $this->assertFalse((bool)(decbin($torrent->getStatus()) & \Pbxg33k\UtorrentClient\Model\Torrent::STATUS_STARTED));
        $this->assertEquals(11, $torrent->getSize());
        $this->assertEquals("Bar", $torrent->getName());
        $this->assertEquals(999, $torrent->getRemaining());
        $this->assertEquals(39, $torrent->getPeersInSwarm());


    }

    /**
     * @test
     */
    public function canFilterResult()
    {
        $this->cache->expects($this->exactly(2))->method('getItem')->willReturn($this->cacheItem);
        $this->cacheItem->expects($this->exactly(2))->method('isHit');
        $this->cacheItem->expects($this->exactly(2))->method('set');
        $this->cache->expects($this->exactly(2))->method('saveDeferred');
        $this->cache->expects($this->once())->method('commit');

        $criteriaTorrent = \Doctrine\Common\Collections\Criteria::create()
            ->where(\Doctrine\Common\Collections\Criteria::expr()->notIn('label',['Games']));
        $criteriaFeeds = \Doctrine\Common\Collections\Criteria::create()
            ->where(\Doctrine\Common\Collections\Criteria::expr()->contains('url', 'no hit'));
        $criteriaFilters = \Doctrine\Common\Collections\Criteria::create()
            ->where(\Doctrine\Common\Collections\Criteria::expr()->contains('name', 'no hit'));

        $this->listResponse
            ->fromHtml($this->inputString)
            ->filterTorrents($criteriaTorrent)
            ->filterRssFeeds($criteriaFeeds)
            ->filterRssFilters($criteriaFilters);

        $this->assertEquals(25110, $this->listResponse->getBuild());
        $this->assertEquals(1, $this->listResponse->getTorrents()->count());
        $this->assertEquals("FEDCBA0987654321FEDCBA0987654321FEDCBA09", $this->listResponse->getTorrents()->first()->getHash());
        $this->assertEquals(0, $this->listResponse->getRssFeeds()->count());
        $this->assertEquals(0, $this->listResponse->getRssFilters()->count());
    }
}