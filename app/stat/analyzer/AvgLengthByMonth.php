<?php


namespace stat\analyzer;
require_once 'Analyzer.php';

use sm\apiclient\model\PostResponse;

class AvgLengthByMonth implements Analyzer {

    public function description(): string {
        return 'Average character length of a post / month';
    }

    public function legendX(): string {
        return 'Month (YYYY-MM)';
    }

    public function legendY(): string {
        return 'Average character length of a post';
    }

    public function analyze(PostResponse ...$posts): array {
        $countsByMonth = array();
        $totalByMonth = array();
        foreach ($posts as $post) {
            $month = $post->created_time->format('Y-m');
            if (!key_exists($month, $countsByMonth)) {
                $countsByMonth[$month] = 0;
                $totalByMonth[$month] = 0;
            }
            $countsByMonth[$month]++;
            $totalByMonth[$month] += strlen($post->message);
        }

        $result = array();
        foreach ($countsByMonth as $month => $value) {
            $result[$month] = $totalByMonth[$month] / $value;
        }
        return $result;
    }
}