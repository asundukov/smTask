<?php

namespace stat\analyzer;

require_once __DIR__.'/../test_requiers.php';

class AvgLengthByMonthTest extends CommonAnalyzerTest {

    public function testAnalyzeEmpty() {
        $analyzer = new AvgLengthByMonth();
        $posts = array();

        $result = $analyzer->analyze(...$posts);

        $this->assertEquals(count($result), 0);
    }

    public function testAnalyzeSingleMonth() {
        $analyzer = new AvgLengthByMonth();
        $posts = array(
                $this->getPostResponse("2019-01", 10),
                $this->getPostResponse("2019-01", 20)
        );

        $result = $analyzer->analyze(...$posts);

        $this->assertEquals(count($result), 1);
        $this->assertTrue(key_exists("2019-01", $result));
        $this->assertEquals($result["2019-01"], 15);
    }

    public function testAnalyzeTwoMonths() {
        $analyzer = new AvgLengthByMonth();
        $posts = array(
                $this->getPostResponse("2019-01", 10),
                $this->getPostResponse("2019-01", 21),
                $this->getPostResponse("2019-02", 30)
        );

        $result = $analyzer->analyze(...$posts);

        $this->assertEquals(count($result), 2);
        $this->assertTrue(key_exists("2019-01", $result));
        $this->assertTrue(key_exists("2019-02", $result));
        $this->assertEquals($result["2019-01"], 15.5);
        $this->assertEquals($result["2019-02"], 30);
    }

}
