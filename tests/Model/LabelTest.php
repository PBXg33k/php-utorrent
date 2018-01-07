<?php
class LabelTest extends \PHPUnit\Framework\TestCase
{
    protected $input = [
        'testname',
        9001
    ];

    /**
     * @test
     */
    public function testGetters()
    {
        $label = (new \Pbxg33k\UtorrentClient\Model\Label())->fromHtml(json_encode($this->input));

        $this->assertEquals($this->input[0], $label->getName());
        $this->assertEquals($this->input[1], $label->getTorrents());
    }

    /**
     * @test
     */
    public function testSetters()
    {
        $label = (new \Pbxg33k\UtorrentClient\Model\Label())
            ->setName($this->input[0])
            ->setTorrents($this->input[1]);

        $this->assertEquals($this->input[0], $label->getName());
        $this->assertEquals($this->input[1], $label->getTorrents());
    }
}