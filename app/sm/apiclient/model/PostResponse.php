<?php


namespace sm\apiclient\model;


class PostResponse {
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $from_name;

    /**
     * @var string
     */
    public $from_id;

    /**
     * @var string
     */
    public $message;

    /**
     * @var string
     */
    public $type;

    /**
     * @var \DateTime
     */
    public $created_time;
}