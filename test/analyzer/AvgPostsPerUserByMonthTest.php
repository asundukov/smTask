<?php

namespace stat\analyzer;

require_once __DIR__.'/../test_requiers.php';

class AvgPostsPerUserByMonthTest extends CommonAnalyzerTest {

    /**
     * @var Analyzer
     */
    private $analyzer;

    public function setUp() {
        $this->analyzer = new AvgPostsPerUserByMonth();
    }

    public function testAnalyzeEmpty() {
        $posts = array();

        $result = $this->analyzer->analyze(...$posts);

        $this->assertEquals(count($result), 0);
    }

    public function testAnalyzeSingleMonth() {
        $posts = array(
                $this->getPostResponseWithUserId("2019-01", 10, '1'),
                $this->getPostResponseWithUserId("2019-01", 20, '1')
        );

        $result = $this->analyzer->analyze(...$posts);

        $this->assertEquals(count($result), 1);
        $this->assertTrue(key_exists("2019-01", $result));
        $this->assertEquals($result["2019-01"], 2);
    }

    public function testAnalyzeTwoMonths() {
        $posts = array(
                $this->getPostResponseWithUserId("2019-01", 10, '1'),
                $this->getPostResponseWithUserId("2019-01", 21, '1'),
                $this->getPostResponseWithUserId("2019-02", 30, '1')
        );

        $result = $this->analyzer->analyze(...$posts);
        $this->assertEquals(count($result), 2);
        $this->assertTrue(key_exists("2019-01", $result));
        $this->assertTrue(key_exists("2019-02", $result));
        $this->assertEquals($result["2019-01"], 2);
        $this->assertEquals($result["2019-02"], 1);
    }

    public function testAnalyzeTwoUsers() {
        $posts = array(
                $this->getPostResponseWithUserId("2019-01", 30, '1'),
                $this->getPostResponseWithUserId("2019-01", 20, '1'),
                $this->getPostResponseWithUserId("2019-01", 30, '2')
        );

        $result = $this->analyzer->analyze(...$posts);
        $this->assertEquals(count($result), 1);
        $this->assertTrue(key_exists("2019-01", $result));
        $this->assertEquals($result["2019-01"], 1.5);
    }

}
