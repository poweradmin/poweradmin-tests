<?php

require_once '../inc/record.inc.php';

class RecordTest extends PHPUnit_Framework_TestCase {

    public function testGetDomainLevel() {
        $this->assertEquals(get_domain_level('com'), 1);
        $this->assertEquals(get_domain_level('example.com'), 2);
        $this->assertEquals(get_domain_level('www.example.com'), 3);
    }

    public function testGetSecondLevelDomain() {
        $this->assertEquals(get_second_level_domain('www.example.com'), 'example.com');
        $this->assertEquals(get_second_level_domain('ftp.ru.example.com'), 'example.com');
    }
}
