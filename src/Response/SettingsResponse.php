<?php
namespace Pbxg33k\UtorrentClient\Response;

use Doctrine\Common\Collections\ArrayCollection;
use Pbxg33k\UtorrentClient\Model\SettingItem;

class SettingsResponse extends BaseResponse
{
    /**
     * @var int
     */
    protected $build;
    /**
     * @var ArrayCollection
     */
    protected $settings;

    public function __construct()
    {
        $this->settings = new ArrayCollection();
    }

    public function fromJson($json)
    {
        $this->build = $json->build;

        foreach($json->settings as $setting) {
            $this->settings->add((new SettingItem())->fromJson($setting));
        }

        return $this;
    }

    /**
     * Return this object in a string format as originaly
     * returned from uTorrent web API
     * @return string
     */
    public function toOrigFormat(): \stdClass
    {
        $returnObj = new \stdClass();
        $returnObj->build = $this->build;
        $returnObj->settings = $this->collectionToOrigJson($this->settings);

        return $returnObj;
    }
}