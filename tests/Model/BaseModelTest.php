<?php
class BaseModelTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var DummyModel
     */
    protected $model;

    protected function setUp()
    {
        $this->model = new DummyModel();
    }

    /**
     * @test
     */
    public function willThrowExceptionWhenNoMapperIsSetOnDecode()
    {
        $this->expectExceptionMessage('No mapping found and fromJson not overridden');
        $this->model->fromJson([]);
    }

    /**
     * @test
     */
    public function willThrowExceptionWhenNoMapperIsSetOnEncode()
    {
        $this->expectExceptionMessage('No mapping found and toOriginal not overridden');
        $this->model->toOriginal();
    }
}

class DummyModel extends \Pbxg33k\UtorrentClient\Model\BaseModel { }