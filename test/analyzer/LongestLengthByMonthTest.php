<?php

namespace stat\analyzer;

require_once __DIR__.'/../test_requiers.php';

class LongestLengthByMonthTest extends CommonAnalyzerTest {

    /**
     * @var Analyzer
     */
    private $analyzer;

    public function setUp() {
        $this->analyzer = new LongestLengthByMonth();
    }

    public function testAnalyzeEmpty() {
        $posts = array();

        $result = $this->analyzer->analyze(...$posts);

        $this->assertEquals(count($result), 0);
    }

    public function testAnalyzeSingleMonth() {
        $posts = array(
                $this->getPostResponse("2019-01", 10),
                $this->getPostResponse("2019-01", 20)
        );

        $result = $this->analyzer->analyze(...$posts);

        $this->assertEquals(count($result), 1);
        $this->assertTrue(key_exists("2019-01", $result));
        $this->assertEquals($result["2019-01"], 20);
    }

    public function testAnalyzeTwoMonths() {
        $posts = array(
                $this->getPostResponse("2019-01", 10),
                $this->getPostResponse("2019-01", 21),
                $this->getPostResponse("2019-02", 30)
        );

        $result = $this->analyzer->analyze(...$posts);

        $this->assertEquals(count($result), 2);
        $this->assertTrue(key_exists("2019-01", $result));
        $this->assertTrue(key_exists("2019-02", $result));
        $this->assertEquals($result["2019-01"], 21);
        $this->assertEquals($result["2019-02"], 30);
    }
}
