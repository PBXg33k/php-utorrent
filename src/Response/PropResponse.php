<?php
namespace Pbxg33k\UtorrentClient\Response;

use Doctrine\Common\Collections\ArrayCollection;
use Pbxg33k\UtorrentClient\Model\TorrentProp;

class PropResponse extends BaseResponse
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

    protected function toOrigFormat(): \stdClass
    {
        $returnObj = new \stdClass();
        $returnObj->build = $this->build;
        $returnObj->props = $this->collectionToOrigJson($this->props);

        return $returnObj;
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
    public function getProps(): ArrayCollection
    {
        return $this->props;
    }
}