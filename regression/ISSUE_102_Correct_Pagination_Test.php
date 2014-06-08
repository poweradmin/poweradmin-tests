<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';
require_once 'functional/common.php';

class ISSUE_102_Correct_Pagination_Test extends PHPUnit_Extensions_SeleniumTestCase {

    protected function setUp() {
        $this->setBrowserUrl(BROWSER_URL);
    }
    
    protected function testPagination() {
        Common::doLogin($this);
        Common::doAddMasterZone($this, 'poweradmin.org');
        
        Common::doRemoveZone($this, 'poweradmin.org');
    }

}
