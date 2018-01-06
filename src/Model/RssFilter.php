<?php
namespace Pbxg33k\UtorrentClient\Model;

class RssFilter extends BaseModel
{

    /**
     * @var int
     */
    protected $id;
    /**
     * @var int
     */
    protected $flags;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $filter;
    /**
     * @var string
     */
    protected $notFilter;
    /**
     * @var string
     */
    protected $directory;
    /**
     * @var int
     */
    protected $feed;
    /**
     * @var int
     */
    protected $quality;
    /**
     * @var string
     */
    protected $label;
    /**
     * @var int
     */
    protected $postponeMode;
    /**
     * @var int
     */
    protected $lastMatch;
    /**
     * @var int
     */
    protected $smartEpFilter;
    /**
     * @var int
     */
    protected $repackEpFilter;
    /**
     * @var string
     */
    protected $episodeFilterStr;
    /**
     * @var bool
     */
    protected $episodeFilter;
    /**
     * @var bool
     */
    protected $resolvingCandidate;

    protected $map = [
        "id" => 0,
        "flags" => 1,
        "name" => 2,
        "filter" => 3,
        "notFilter" => 4,
        "directory" => 5,
        "feed" => 6,
        "quality" => 7,
        "label" => 8,
        "postponeMode" => 9,
        "lastMatch" => 10,
        "smartEpFilter" => 11,
        "repackEpFilter" => 12,
        "episodeFilterStr" => 13,
        "episodeFilter" => 14,
        "resolvingCandidate" => 15,
    ];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return RssFilter
     */
    public function setId(int $id): RssFilter
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getFlags(): int
    {
        return $this->flags;
    }

    /**
     * @param int $flags
     * @return RssFilter
     */
    public function setFlags(int $flags): RssFilter
    {
        $this->flags = $flags;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return RssFilter
     */
    public function setName(string $name): RssFilter
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getFilter(): string
    {
        return $this->filter;
    }

    /**
     * @param string $filter
     * @return RssFilter
     */
    public function setFilter(string $filter): RssFilter
    {
        $this->filter = $filter;
        return $this;
    }

    /**
     * @return string
     */
    public function getNotFilter(): string
    {
        return $this->notFilter;
    }

    /**
     * @param string $notFilter
     * @return RssFilter
     */
    public function setNotFilter(string $notFilter): RssFilter
    {
        $this->notFilter = $notFilter;
        return $this;
    }

    /**
     * @return string
     */
    public function getDirectory(): string
    {
        return $this->directory;
    }

    /**
     * @param string $directory
     * @return RssFilter
     */
    public function setDirectory(string $directory): RssFilter
    {
        $this->directory = $directory;
        return $this;
    }

    /**
     * @return int
     */
    public function getFeed(): int
    {
        return $this->feed;
    }

    /**
     * @param int $feed
     * @return RssFilter
     */
    public function setFeed(int $feed): RssFilter
    {
        $this->feed = $feed;
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
     * @return RssFilter
     */
    public function setQuality(int $quality): RssFilter
    {
        $this->quality = $quality;
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return RssFilter
     */
    public function setLabel(string $label): RssFilter
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return int
     */
    public function getPostponeMode(): int
    {
        return $this->postponeMode;
    }

    /**
     * @param int $postponeMode
     * @return RssFilter
     */
    public function setPostponeMode(int $postponeMode): RssFilter
    {
        $this->postponeMode = $postponeMode;
        return $this;
    }

    /**
     * @return int
     */
    public function getLastMatch(): int
    {
        return $this->lastMatch;
    }

    /**
     * @param int $lastMatch
     * @return RssFilter
     */
    public function setLastMatch(int $lastMatch): RssFilter
    {
        $this->lastMatch = $lastMatch;
        return $this;
    }

    /**
     * @return int
     */
    public function getSmartEpFilter(): int
    {
        return $this->smartEpFilter;
    }

    /**
     * @param int $smartEpFilter
     * @return RssFilter
     */
    public function setSmartEpFilter(int $smartEpFilter): RssFilter
    {
        $this->smartEpFilter = $smartEpFilter;
        return $this;
    }

    /**
     * @return int
     */
    public function getRepackEpFilter(): int
    {
        return $this->repackEpFilter;
    }

    /**
     * @param int $repackEpFilter
     * @return RssFilter
     */
    public function setRepackEpFilter(int $repackEpFilter): RssFilter
    {
        $this->repackEpFilter = $repackEpFilter;
        return $this;
    }

    /**
     * @return string
     */
    public function getEpisodeFilterStr(): string
    {
        return $this->episodeFilterStr;
    }

    /**
     * @param string $episodeFilterStr
     * @return RssFilter
     */
    public function setEpisodeFilterStr(string $episodeFilterStr): RssFilter
    {
        $this->episodeFilterStr = $episodeFilterStr;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEpisodeFilter(): bool
    {
        return $this->episodeFilter;
    }

    /**
     * @param bool $episodeFilter
     * @return RssFilter
     */
    public function setEpisodeFilter(bool $episodeFilter): RssFilter
    {
        $this->episodeFilter = $episodeFilter;
        return $this;
    }

    /**
     * @return bool
     */
    public function isResolvingCandidate(): bool
    {
        return $this->resolvingCandidate;
    }

    /**
     * @param bool $resolvingCandidate
     * @return RssFilter
     */
    public function setResolvingCandidate(bool $resolvingCandidate): RssFilter
    {
        $this->resolvingCandidate = $resolvingCandidate;
        return $this;
    }
}