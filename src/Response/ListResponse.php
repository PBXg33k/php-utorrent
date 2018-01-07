<?php
namespace Pbxg33k\UtorrentClient\Response;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Pbxg33k\UtorrentClient\Model\Label;
use Pbxg33k\UtorrentClient\Model\RssFeed;
use Pbxg33k\UtorrentClient\Model\RssFilter;
use Pbxg33k\UtorrentClient\Model\Torrent;

class ListResponse extends BaseResponse
{
    /**
     * @var int
     */
    protected $build;

    /**
     * @var ArrayCollection
     */
    protected $labels;

    /**
     * @var ArrayCollection
     */
    protected $torrents;

    /**
     * @var string
     */
    protected $torrentc;

    /**
     * @var ArrayCollection
     */
    protected $rssFeeds;

    /**
     * @var ArrayCollection
     */
    protected $rssFilters;

    /**
     * ListResponse constructor.
     */
    public function __construct()
    {
        $this->labels = new ArrayCollection();
        $this->torrents = new ArrayCollection();
        $this->rssFeeds = new ArrayCollection();
        $this->rssFilters = new ArrayCollection();
    }

    /**
     * @param $json
     * @return $this
     */
    public function fromJson($json) : ListResponse
    {
        $this->build = $json->build;
        $this->torrentc = $json->torrentc;
        foreach($json->label as $label) {
            $this->labels->add((new Label())->fromJson($label));
        }

        foreach($json->torrents as $torrent) {
            $cachedTorrent = $this->cache->getItem(trim($torrent[0]));
            if($cachedTorrent->isHit()) {
                /** @var Torrent $torrentObj */
                $clone = clone $cachedTorrent->get();
                $torrentObj = $clone->refreshCache($torrent);
            } else {
                $torrentObj = (new Torrent)->fromJson($torrent);
            }

            $cachedTorrent->set($torrentObj);
            $this->cache->saveDeferred($cachedTorrent);

            $this->torrents->add($torrentObj);
            unset($torrentObj);
        }

        foreach($json->rssfeeds as $rssfeed) {
            $this->rssFeeds->add((new RssFeed())->fromJson($rssfeed));
        }

        foreach($json->rssfilters as $rssfilter) {
            $this->rssFilters->add((new RssFilter())->fromJson($rssfilter));
        }

        $this->cache->commit();

        return $this;
    }

    protected function toOrigFormat() : \stdClass
    {
        $return = new \stdClass();
        $return->build = $this->build;
        $return->label = $this->collectionToOrigJson($this->labels);
        $return->torrents = $this->collectionToOrigJson($this->torrents);
        $return->torrentc = $this->torrentc;
        $return->rssfeeds = $this->collectionToOrigJson($this->rssFeeds);
        $return->rssfilters = $this->collectionToOrigJson($this->rssFilters);

        return $return;
    }

    /**
     * @return int
     */
    public function getBuild(): int
    {
        return $this->build;
    }

    /**
     * @return ArrayCollection
     */
    public function getLabels(): ArrayCollection
    {
        return $this->labels;
    }

    /**
     * @return ArrayCollection
     */
    public function getTorrents(): ArrayCollection
    {
        return $this->torrents;
    }

    /**
     * @return string
     */
    public function getTorrentc(): string
    {
        return $this->torrentc;
    }

    /**
     * @return ArrayCollection
     */
    public function getRssFeeds(): ArrayCollection
    {
        return $this->rssFeeds;
    }

    /**
     * @return ArrayCollection
     */
    public function getRssFilters(): ArrayCollection
    {
        return $this->rssFilters;
    }

    /**
     * @param Criteria $criteria
     * @return ListResponse
     */
    public function filterTorrents(Criteria $criteria): ListResponse
    {
        $this->torrents = $this->torrents->matching($criteria);

        return $this;
    }

    /**
     * @param Criteria $criteria
     * @return ListResponse
     */
    public function filterRssFeeds(Criteria $criteria): ListResponse
    {
        $this->rssFeeds = $this->rssFeeds->matching($criteria);

        return $this;
    }

    /**
     * @param Criteria $criteria
     * @return ListResponse
     */
    public function filterRssFilters(Criteria $criteria): ListResponse
    {
        $this->rssFilters = $this->rssFilters->matching($criteria);

        return $this;
    }
}