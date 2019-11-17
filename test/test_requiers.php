<?php

DEFINE("APP_DIR", __DIR__.'/../app');

require_once APP_DIR.'/stat/analyzer/Analyzer.php';
require_once APP_DIR.'/stat/analyzer/AvgLengthByMonth.php';
require_once APP_DIR.'/stat/analyzer/LongestLengthByMonth.php';
require_once APP_DIR.'/stat/analyzer/TotalByWeek.php';
require_once APP_DIR.'/stat/analyzer/AvgPostsPerUserByMonth.php';
require_once APP_DIR.'/sm/apiclient/model/PostResponse.php';
require_once __DIR__.'/analyzer/CommonAnalyzerTest.php';
