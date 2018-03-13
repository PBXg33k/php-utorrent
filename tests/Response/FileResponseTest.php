<?php
/**
 * Created by PhpStorm.
 * User: Oguzhan Uysal
 * Date: 12/03/2018
 * Time: 15:58
 */

use Pbxg33k\UtorrentClient\Response\FileResponse;

class FileResponseTest extends \PHPUnit\Framework\TestCase
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
     * @var FileResponse
     */
    protected $fileResponse;

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

        $this->inputString = file_get_contents(__DIR__.'/../mock-response/action-getfiles');

        $this->fileResponse = (new FileResponse())
            ->setCache($cache)
            ->fromHtml($this->inputString);
    }

    /**
     * @test
     */
    public function canDecodeFromUtorrentResponse()
    {
        $this->assertEquals(25110, $this->fileResponse->getBuild());
        $this->assertEquals(1, $this->fileResponse->getFiles()->count());
        $this->assertEquals("1234567890ABCDEF1234567890ABCDEF12345678", $this->fileResponse->getTorrentHash());
    }

    /**
     * @test
     */
    public function canDecodeFilesFromResponse()
    {
        /** @var \Pbxg33k\UtorrentClient\Model\File $file */
        $file = $this->fileResponse->getFiles()->first();
        $this->assertEquals("foobar.txt", $file->getFilename());
        $this->assertEquals(1, $file->getFilesize());
        $this->assertEquals(0,$file->getDownloaded());
        $this->assertEquals(2,$file->getPriority());
    }

    /**
     * @test
     */
    public function canRecreateuTorrentResponse()
    {
        $this->assertEquals(trim(preg_replace('~\r\n?~',"", $this->inputString)), $this->fileResponse->toOriginalFormatString());
    }
}
