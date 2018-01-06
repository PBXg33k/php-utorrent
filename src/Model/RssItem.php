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

        return $this;
    }
}