<?php
namespace Pbxg33k\UtorrentClient\Response;

use Doctrine\Common\Collections\ArrayCollection;
use Pbxg33k\UtorrentClient\Model\BaseModel;
use Pbxg33k\UtorrentClient\Model\TorrentProp;

class PropResponse extends BaseModel
{
    /**
     * @var int
     */
    protected $build;
    /**
     * @var ArrayCollection
     */
    protected $props;

    public function __construct()
    {
        $this->props = new ArrayCollection();
    }

    public function fromJson($json)
    {
        $this->build = $json->build;

        foreach($json->props as $prop) {
            $this->props->add((new TorrentProp())->fromJson($prop));
        }

        return $this;
    }
}