<?php
namespace Pbxg33k\UtorrentClient\Response;

use Doctrine\Common\Collections\ArrayCollection;
use Pbxg33k\UtorrentClient\Model\BaseModel;
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

    /**
     * Return this object in a string format as originaly
     * returned from uTorrent web API
     * @return string
     */
    protected abstract function toOrigFormat(): \stdClass;

    /**
     * Returns response as formatted by uTorrent
     * @return string
     */
    public function toOriginalFormatString(): string {
        return \GuzzleHttp\json_encode($this->toOrigFormat(), JSON_UNESCAPED_SLASHES);
    }

    protected function collectionToOrigJson(ArrayCollection $array):array
    {
        $return = array_map(function ($item) {
            /** @var BaseModel $item */
            return $item->toOriginal();
        }, $array->toArray());

        return $return;
    }

}