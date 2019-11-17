<?php


namespace stat\analyzer;


use sm\apiclient\model\PostResponse;

class TotalByWeek implements Analyzer {

    public function description(): string {
        return 'Total posts split by week';
    }

    public function legendX(): string {
        return 'Number of week (YYYY-ww)';
    }

    public function legendY(): string {
        return 'Posts count';
    }

    public function analyze(PostResponse ...$posts): array {
        $countByWeek = array();
        foreach ($posts as $post) {
            $week = $post->created_time->format('Y-W');
            if (!key_exists($week, $countByWeek)) {
                $countByWeek[$week] = 0;
            }
            $countByWeek[$week]++;
        }

        return $countByWeek;
    }
}