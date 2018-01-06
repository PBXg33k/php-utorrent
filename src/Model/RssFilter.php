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

        return $this;
    }
}