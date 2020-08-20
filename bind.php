<?php

class bind {

    public function createZone($domain) {
        $zone = "";
        $zone .= $this->createRecordSOA($domain->getRecords());
        $zone .= $this->createNS($domain->primary_ns, $domain->domain_name, $domain->ttl);
        $zone .= $this->createNS($domain->secondary_ns, $domain->domain_name, $domain->ttl);
        $zone .= $this->createNS($domain->third_ns, $domain->domain_name, $domain->ttl);
        $zone .= $this->createNS($domain->forth_ns, $domain->domain_name, $domain->ttl);
        $zone .= $this->createNS($domain->fifth_ns, $domain->domain_name, $domain->ttl);
        $zone .= $this->createRecords($domain->getRecords());
        return $zone;
    }

    private function createNS($ns, $domain_name, $ttl) {
        if ($ns != "") {
            return "\n$domain_name $ttl IN NS $ns";
        }

        return "";
    }

    private function createRecords($records) {
        $zones = "\n";
        foreach ($records as $record) {
            if ($record->type != "SOA") {
                $newZone = "\n{{host}} {{ttl}} IN {{type}} {{mx_priority}} {{rdata}}";
                foreach ($record as $name => $value) {
                    $newZone = $this->filter($name, $value, $newZone);
                }
                $zones .= $newZone;
            }
        }
        return $zones;
    }

    private function createRecordSOA($records) {
        $soa = "";
        foreach ($records as $record) {
            if ($record->type == "SOA") {
                $soa = "@   {{ttl}}    IN      SOA     {{primary_ns}} {{email}} (\n
                        \n\t{{serial}}\t;Serial
                        \n\t{{refresh}}\t;Refresh
                        \n\t{{retry}}\t;Retry
                        \n\t{{expire}}\t;Expire
                        \n\t{{ttl}} );Negative Cache TTL \n";
                foreach ($record as $name => $value) {
                    $soa = $this->filter($name, $value, $soa);
                }
            }
        }
        return $soa;
    }

    private function filter($name, $value, $subject) {
        return preg_replace("/\{\{$name}}/", $value, $subject);
    }

}
