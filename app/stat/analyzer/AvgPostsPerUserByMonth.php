<?php


namespace stat\analyzer;


use sm\apiclient\model\PostResponse;

class AvgPostsPerUserByMonth implements Analyzer {

    public function description(): string {
        return 'Average number of posts per user / month';
    }

    public function legendX(): string {
        return 'Month (YYYY-MM)';
    }

    public function legendY(): string {
        return 'Average of posts per user';
    }

    public function analyze(PostResponse ...$posts): array {
        $totalData = array();
        foreach ($posts as $post) {
            $month = $post->created_time->format('Y-m');
            $userId = $post->from_id;
            if (!key_exists($month, $totalData)) {
                $totalData[$month] = array();
            }
            if (!key_exists($userId, $totalData[$month])) {
                $totalData[$month][$userId] = 0;
            }
            $totalData[$month][$userId]++;
        }

        $result = array();
        foreach ($totalData as $month => $monthData) {
            $totalCount = 0;
            foreach ($monthData as $userId => $userCount) {
                $totalCount += $userCount;
            }
            $result[$month] = $totalCount / count($monthData);
        }
        return $result;
    }
}
