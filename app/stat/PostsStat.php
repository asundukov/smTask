<?php


namespace stat;


use Psr\Log\LoggerInterface;
use sm\apiclient\model\PostResponse;
use stat\analyzer\Analyzer;
use stat\analyzer\AvgLengthByMonth;
use stat\analyzer\AvgPostsPerUserByMonth;
use stat\analyzer\LongestLengthByMonth;
use stat\analyzer\TotalByWeek;

class PostsStat {
    /**
     * @var Analyzer[]
     */
    private $analyzers;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
        $this->analyzers = array(
                new AvgLengthByMonth(),
                new LongestLengthByMonth(),
                new TotalByWeek(),
                new AvgPostsPerUserByMonth()
        );
    }

    public function getStat(PostResponse ...$posts) {
        $data = array();

        foreach ($this->analyzers as $analyzer) {
            try {
                $data[] = array(
                        'description' => $analyzer->description(),
                        'legendX' => $analyzer->legendX(),
                        'legendY' => $analyzer->legendY(),
                        'data' => $analyzer->analyze(...$posts)
                );
            } catch (\Exception $e) {
                $this->logger->warning("Problem during call analyzer " . get_class($analyzer));
            }
        }

        return $data;
    }
}