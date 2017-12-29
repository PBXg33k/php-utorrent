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
    protected $client;

    const HOST = '127.0.0.1';
    const USER = 'admin';
    const PASS = 'password';
    const PORT = 80;
    const PATH = '/gui/';

    protected function setUp()
    {
        $cache = $this->cache = $this->getMockBuilder(\Cache\Adapter\Void\VoidCachePool::class)
            ->disableOriginalConstructor()
            ->getMock();

        $client = $this->client = $this->getMockBuilder(\GuzzleHttp\ClientInterface::class)
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
}