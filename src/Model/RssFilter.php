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

    public function fromJson($json)
    {
        $this->id = $json[0];
        $this->flags = $json[1];
        $this->name = $json[2];
        $this->filter = $json[3];
        $this->notFilter = $json[4];
        $this->directory = $json[5];
        $this->feed = $json[6];
        $this->quality = $json[7];
        $this->label = $json[8];
        $this->postponeMode = $json[9];
        $this->lastMatch = $json[10];
        $this->smartEpFilter = $json[11];
        $this->repackEpFilter = $json[12];
        $this->episodeFilterStr = $json[13];
        $this->episodeFilter = $json[14];
        $this->resolvingCandidate = $json[15];

        return $this;
    }
}