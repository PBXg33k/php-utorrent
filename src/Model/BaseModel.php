<?php
namespace Pbxg33k\UtorrentClient\Model;

abstract class BaseModel
{
    protected $map;

    public function fromHtml($html)
    {
        return $this->fromJson(\json_decode($html));
    }

    public function fromJson($json, array $filter = [])
    {
        if(is_array($this->map)) {
            foreach($this->map as $propKey => $offset) {
                // Only update specific properties if $filter is given
                if(!empty($filter) && !in_array($propKey,$filter))
                    continue;

                if(is_numeric($offset)) {
                    $val = $json[$offset];
                } else {
                    $val = $json->{$offset};
                }
                $this->setObectValue($propKey, $val);
            }
            return $this;
        } else {
            throw new \Exception('No mapping found and fromJson not overridden');
        }
    }

    protected function setObectValue($key, $value) {
        $setterName = "set".implode('',array_map('ucfirst',explode('_',$key)));
        if(method_exists($this, $setterName)) {
            $this->{$setterName}($value);
        } else {
            $this->{$key} = $value;
        }
    }

    /**
     * Transform object into its original format as returned by uTorrent
     */
    public function toOriginal()
    {
        if(is_array($this->map)) {
            $returnArray = [];
            foreach($this->map as $propKey => $offset) {
                $getterName = "get".implode('',array_map('ucfirst',explode('_',$propKey)));
                if(is_numeric($offset)) {
                    $returnArray[] = $this->{$getterName}();
                } else {
                    $returnArray[$offset] = $this->{$getterName}();
                }
            }

            return $returnArray;
        } else {
            throw new \Exception('No mapping found and toOriginal not overridden');
        }
    }

    /**
     * Partially update object from cache in subsequent calls
     * ie: torrent calls which contains in progress torrents
     *
     * @param object $newData
     * @return $this
     */
    public function refreshCache($newData)
    {
        return $this;
    }
}