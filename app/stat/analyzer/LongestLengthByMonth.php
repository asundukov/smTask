<?php


namespace stat\analyzer;


use sm\apiclient\model\PostResponse;

class LongestLengthByMonth implements Analyzer {

    public function description(): string {
        return 'The longest post by character length / month';
    }

    public function legendX(): string {
        return 'Month (YYYY-MM)';
    }

    public function legendY(): string {
        return 'Size of the longest post';
    }

    public function analyze(PostResponse ...$posts): array {
        $maxByMonth = array();
        foreach ($posts as $post) {
            $month = $post->created_time->format('Y-m');
            if (!key_exists($month, $maxByMonth)) {
                $maxByMonth[$month] = 0;
            }
            $currentLength = strlen($post->message);
            if ($maxByMonth[$month] < $currentLength) {
                $maxByMonth[$month] = $currentLength;
            }
        }

        return $maxByMonth;
    }
}