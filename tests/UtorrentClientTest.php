<?php
use PHPUnit\Framework\TestCase;

final class UtorrentClientTest extends TestCase
{
    /**
     * @var \Pbxg33k\UtorrentClient\UtorrentClient
     */
    protected $utorrentClient;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    protected $cache;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    protected $cacheItem;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    protected $client;

    const HOST = '127.0.0.1';
    const USER = 'admin';
    const PASS = 'password';
    const PORT = 80;
    const PATH = '/gui/';

    protected function setUp()
    {
        $cache = $this->cache = $this->getMockBuilder(\Psr\Cache\CacheItemPoolInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $client = $this->client = $this->getMockBuilder(\GuzzleHttp\ClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->cacheItem = $this->getMockBuilder(\Psr\Cache\CacheItemInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->utorrentClient = new \Pbxg33k\UtorrentClient\UtorrentClient(self::HOST, self::PORT, self::USER,self::PASS, self::PATH);
        $this->utorrentClient->setClient($client)->setCache($cache);
    }

    /**
     * @test
     */
    public function canConstruct()
    {
        $this->assertEquals(self::HOST, $this->utorrentClient->getHost());
        $this->assertEquals(self::PORT, $this->utorrentClient->getPort());
        $this->assertEquals(self::USER, $this->utorrentClient->getUsername());
        $this->assertEquals(self::PASS, $this->utorrentClient->getPassword());
        $this->assertEquals(self::PATH, $this->utorrentClient->getPath());
    }

    /**
     * @test
     */
    public function canGetToken()
    {
        $this->cache->expects($this->once())->method('getItem')->willReturn($this->cacheItem);

        $this->cacheItem->expects($this->once())->method('isHit');
        $this->client->expects($this->once())->method('request')->willReturn(
            $this->buildResponse(file_get_contents(__DIR__.'/mock-response/token'))
        );

        $this->cacheItem->expects($this->once())->method('set')->willReturn(true);
        $this->cacheItem->expects($this->once())->method('expiresAt')->willReturn(true);
        $this->cache->expects($this->once())->method('save')->willReturn(true);

        $result = $this->utorrentClient->getToken();
        $this->assertInstanceOf(\Pbxg33k\UtorrentClient\Model\Token::class, $result);
        $this->assertEquals('servertoken', $result->getToken());
        $this->assertSame((new \DateTime('+ 25 min'))->format(DATE_ISO8601), $result->getExpirationDateTime()->format(DATE_ISO8601));
        $this->assertSame((new \DateTime())->format(DATE_ISO8601), $result->getCreatedDateTime()->format(DATE_ISO8601));
    }

    /**
     * @test
     */
    public function tokenIsCached()
    {
        $token = $this->injectToken();

        $this->cache->expects($this->once())->method('getItem')->willReturn($this->cacheItem);
        $this->cacheItem->expects($this->once())->method('isHit')->willReturn(true);
        $this->cacheItem->expects($this->any())->method('get')->willReturn($token);

        $this->assertSame($token, $this->utorrentClient->getToken());
    }

    /**
     * @test
     */
    public function getTorrentsReturnsListOfTorrents()
    {
        $this->injectToken();

        $this->client->expects($this->once())->method('send')->willReturn(
            $this->buildResponse(file_get_contents(__DIR__.'/mock-response/action-list'))
        );

        $this->cache->expects($this->exactly(2))->method('getItem')->willReturn($this->cacheItem);
        $this->cacheItem->expects($this->exactly(2))->method('isHit');
        $this->cacheItem->expects($this->exactly(2))->method('set');
        $this->cache->expects($this->exactly(2))->method('saveDeferred');
        $this->cache->expects($this->once())->method('commit');

        $result = $this->utorrentClient->getTorrents();

        /** @var \Pbxg33k\UtorrentClient\Model\Torrent $firstTorrent */
        $firstTorrent = $result->getTorrents()->first();
        $this->assertEquals('1234567890ABCDEF1234567890ABCDEF12345678', $firstTorrent->getHash());
        $this->assertEquals('Foo', $firstTorrent->getName());
        $this->assertEquals(136, $firstTorrent->getStatus());
        $this->assertEquals(1024, $firstTorrent->getSize());
        $this->assertEquals('Games', $firstTorrent->getLabel());
    }

    /**
     * @test
     */
    public function getTorrentReturnsSingleTorrent()
    {
        $this->injectToken();
        $this->client->expects($this->once())->method('send')->willReturn(
            $this->buildResponse(file_get_contents(__DIR__.'/mock-response/action-getprops'))
        );

        $torrent = $this->utorrentClient->getTorrent('foo');
        $this->assertEquals(25110,$torrent->getBuild());
        $this->assertEquals('1234567890ABCDEF1234567890ABCDEF12345678', $torrent->getProps()->first()->getHash());
    }

    /**
     * @test
     */
    public function getSettings()
    {
        $this->injectToken();
        $this->client->expects($this->once())->method('send')->willReturn(
            $this->buildResponse(file_get_contents(__DIR__.'/mock-response/action-getsettings'))
        );

        $settings = $this->utorrentClient->getSettings();
        $this->assertEquals(25110, $settings->getBuild());

        $this->assertEquals('torrents_start_stopped', $settings->getSettings()->first()->getName());
        $this->assertEquals(1, $settings->getSettings()->first()->getType());
        $this->assertEquals(false, $settings->getSettings()->first()->getValue());
    }

    /**
     * @test
     */
    public function willFetchTokenIfNoTokenIsSet()
    {
        $cachedToken = new \Pbxg33k\UtorrentClient\Model\Token('test');

        $this->cache->expects($this->once())->method('getItem')->willReturn($this->cacheItem);
        $this->cacheItem->expects($this->once())->method('isHit')->willreturn(true);
        $this->cacheItem->expects($this->once())->method('get')->willReturn($cachedToken);

        $this->assertEquals('test', $this->utorrentClient->getToken()->getToken());

    }

    /**
     * @test
     */
    public function gettingClientWillCreateNewClient()
    {
        $this->utorrentClient = new \Pbxg33k\UtorrentClient\UtorrentClient(self::HOST, self::PORT, self::USER,self::PASS, self::PATH);
        $this->utorrentClient->setCache($this->cache);

        $this->assertInstanceOf(\GuzzleHttp\Client::class, $this->utorrentClient->getClient());
    }

    protected function injectToken()
    {
        $token = new \Pbxg33k\UtorrentClient\Model\Token('cachedToken');

        $this->utorrentClient->setToken($token);

        return $token;
    }

    protected function buildResponse(string $content, int $statusCode = 200)
    {
        return new \GuzzleHttp\Psr7\Response($statusCode, [], $content);
    }
}