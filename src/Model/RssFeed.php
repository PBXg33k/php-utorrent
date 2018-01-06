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

    protected $map = [
        "id" => 0,
        "enabled" => 1,
        "useFeedTitle" => 2,
        "userSelected" => 3,
        "programmed" => 4,
        "downloadState" => 5,
        "url" => 6,
        "nextUpdate" => 7,
    ];

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function fromJson($json)
    {
        parent::fromJson($json);

        foreach($json[8] as $item) {
            $this->items->add((new RssItem())->fromJson($item));
        }

        return $this;
    }
}