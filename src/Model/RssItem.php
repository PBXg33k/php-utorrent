<?php
namespace Pbxg33k\UtorrentClient\Model;

class RssItem extends BaseModel
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $nameFull;
    /**
     * @var string
     */
    protected $url;
    /**
     * @var int
     */
    protected $quality;
    /**
     * @var int
     */
    protected $codec;
    /**
     * @var int
     */
    protected $timestamp;
    /**
     * @var int
     */
    protected $season;
    /**
     * @var int
     */
    protected $episode;
    /**
     * @var int
     */
    protected $episodeTo;
    /**
     * @var int
     */
    protected $feedId;
    /**
     * @var bool
     */
    protected $repack;
    /**
     * @var bool
     */
    protected $inHistory;

    protected $map = [
        "name" => 0,
        "nameFull" => 1,
        "url" => 2,
        "quality" => 3,
        "codec" => 4,
        "timestamp" => 5,
        "season" => 6,
        "episode" => 7,
        "episodeTo" => 8,
        "feedId" => 9,
        "repack" => 10,
        "inHistory" => 11,
    ];

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return RssItem
     */
    public function setName(string $name): RssItem
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getNameFull(): string
    {
        return $this->nameFull;
    }

    /**
     * @param string $nameFull
     * @return RssItem
     */
    public function setNameFull(string $nameFull): RssItem
    {
        $this->nameFull = $nameFull;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return RssItem
     */
    public function setUrl(string $url): RssItem
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuality(): int
    {
        return $this->quality;
    }

    /**
     * @param int $quality
     * @return RssItem
     */
    public function setQuality(int $quality): RssItem
    {
        $this->quality = $quality;
        return $this;
    }

    /**
     * @return int
     */
    public function getCodec(): int
    {
        return $this->codec;
    }

    /**
     * @param int $codec
     * @return RssItem
     */
    public function setCodec(int $codec): RssItem
    {
        $this->codec = $codec;
        return $this;
    }

    /**
     * @return int
     */
    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    /**
     * @param int $timestamp
     * @return RssItem
     */
    public function setTimestamp(int $timestamp): RssItem
    {
        $this->timestamp = $timestamp;
        return $this;
    }

    /**
     * @return int
     */
    public function getSeason(): int
    {
        return $this->season;
    }

    /**
     * @param int $season
     * @return RssItem
     */
    public function setSeason(int $season): RssItem
    {
        $this->season = $season;
        return $this;
    }

    /**
     * @return int
     */
    public function getEpisode(): int
    {
        return $this->episode;
    }

    /**
     * @param int $episode
     * @return RssItem
     */
    public function setEpisode(int $episode): RssItem
    {
        $this->episode = $episode;
        return $this;
    }

    /**
     * @return int
     */
    public function getEpisodeTo(): int
    {
        return $this->episodeTo;
    }

    /**
     * @param int $episodeTo
     * @return RssItem
     */
    public function setEpisodeTo(int $episodeTo): RssItem
    {
        $this->episodeTo = $episodeTo;
        return $this;
    }

    /**
     * @return int
     */
    public function getFeedId(): int
    {
        return $this->feedId;
    }

    /**
     * @param int $feedId
     * @return RssItem
     */
    public function setFeedId(int $feedId): RssItem
    {
        $this->feedId = $feedId;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRepack(): bool
    {
        return $this->repack;
    }

    /**
     * @param bool $repack
     * @return RssItem
     */
    public function setRepack(bool $repack): RssItem
    {
        $this->repack = $repack;
        return $this;
    }

    /**
     * @return bool
     */
    public function isInHistory(): bool
    {
        return $this->inHistory;
    }

    /**
     * @param bool $inHistory
     * @return RssItem
     */
    public function setInHistory(bool $inHistory): RssItem
    {
        $this->inHistory = $inHistory;
        return $this;
    }
}