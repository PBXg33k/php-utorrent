<?php
namespace Pbxg33k\UtorrentClient\Model;

use Doctrine\Common\Collections\ArrayCollection;

class RssFeed extends BaseModel
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var bool
     */
    protected $enabled;
    /**
     * @var bool
     */
    protected $useFeedTitle;
    /**
     * @var bool
     */
    protected $userSelected;
    /**
     * @var bool
     */
    protected $programmed;
    /**
     * @var int
     */
    protected $downloadState;
    /**
     * @var string
     */
    protected $url;
    /**
     * @var int
     */
    protected $nextUpdate;
    /**
     * @var ArrayCollection
     */
    protected $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function fromJson($json)
    {
        $this->id = $json[0];
        $this->enabled = $json[1];
        $this->useFeedTitle = $json[2];
        $this->userSelected = $json[3];
        $this->programmed = $json[4];
        $this->downloadState = $json[5];
        $this->url = $json[6];
        $this->nextUpdate = $json[7];

        foreach($json[8] as $item) {
            $this->items->add((new RssItem())->fromJson($item));
        }

        return $this;
    }
}