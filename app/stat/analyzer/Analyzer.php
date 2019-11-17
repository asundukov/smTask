<?php

namespace stat\analyzer;

use sm\apiclient\model\PostResponse;

interface Analyzer {
    public function description(): string;
    public function legendX(): string;
    public function legendY(): string;
    public function analyze(PostResponse ...$posts): array;
}