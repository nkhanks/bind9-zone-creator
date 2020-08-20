<?php

class domain {

    private $records = [];
    public $domain_name = "";
    public $email = "";
    public $primary_ns = "";
    public $secondary_ns = "";
    public $third_ns = "";
    public $forth_ns = "";
    public $fifth_ns = "";
    public $ttl = "14400";
    public $isSub = false;

    public function __construct($domain_name) {
        $this->domain_name = $domain_name;
    }

    public function setNS1($ns) {
        $this->primary_ns = $ns;
    }

    public function setNS2($ns) {
        $this->secondary_ns = $ns;
    }

    public function setNS3($ns) {
        $this->third_ns = $ns;
    }

    public function setNS4($ns) {
        $this->forth_ns = $ns;
    }

    public function setNS5($ns) {
        $this->fifth_ns = $ns;
    }

    /**
     * 
      "host" => "",
      "type" => "",
      "ttl" => "",
      "mx_priority" => "",
      "primary_ns" => "",
      "serial" => "",
      "refresh" => "",
      "retry" => "",
      "expire" => "",
      "minimum" => "",
      "retry" => "",
      "rdata" => ""
     * 
     */
    public function addRecord($newRecord) {
        $record = new record();
        $record->domain_name = $this->domain_name;
        $record->primary_ns = $this->primary_ns;
        $record->email = $this->email;
        $record->host = $newRecord["host"] ?? "";
        $record->type = $newRecord["type"] ?? "";
        $record->ttl = $newRecord["ttl"] ?? "";
        $record->rdata = $newRecord["rdata"] ?? "";
        $record->mx_priority = $newRecord["mx_priority"] ?? "";
        $record->serial = $newRecord["serial"] ?? "";
        $record->retry = $newRecord["retry"] ?? "";
        $record->refresh = $newRecord["refresh"] ?? "";
        $record->expire = $newRecord["expire"] ?? "";
        $record->minimum = $newRecord["minimum"] ?? "";

        $this->records[] = $record;
    }

    public function getRecords() {
        return $this->records;
    }

}
