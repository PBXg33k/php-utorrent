<?php
namespace Pbxg33k\UtorrentClient\Response;

use Psr\Cache\CacheItemPoolInterface;

abstract class BaseResponse
{
    /**
     * @var CacheItemPoolInterface
     */
    protected $cache;

    /**
     * @param CacheItemPoolInterface $cache
     * @return BaseResponse
     */
    public function setCache(CacheItemPoolInterface $cache): BaseResponse
    {
        $this->cache = $cache;
        return $this;
    }

    /**
     * uTorrent only returns JSON
     * But this response can contain characters that break json_decode.
     * This method removes the first 32 characters in the ASCII tables.
     * These are mostly control characters.
     *
     * @param $html
     * @return mixed
     */
    public function fromHtml($html)
    {
        $filteredContent = $html;
        for($i = 0; $i <= 31; ++$i) {
            $filteredContent = str_replace(chr($i), "", $filteredContent);
        }

        return $this->fromJson(\json_decode($filteredContent));
    }

    public abstract function fromJson($json);
}