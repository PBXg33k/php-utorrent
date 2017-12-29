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

    public function fromJson($json)
    {
        $this->name = $json[0];
        $this->nameFull = $json[1];
        $this->url = $json[2];
        $this->quality = $json[3];
        $this->codec = $json[4];
        $this->timestamp = $json[5];
        $this->season = $json[6];
        $this->episode = $json[7];
        $this->episodeTo = $json[8];
        $this->feedId = $json[9];
        $this->repack = $json[10];
        $this->inHistory = $json[11];

        return $this;
    }
}