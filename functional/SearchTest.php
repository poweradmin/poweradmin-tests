<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';
require_once 'common.php';

class SearchTest extends PHPUnit_Extensions_SeleniumTestCase {

    protected function setUp() {
        $this->setBrowserUrl(BROWSER_URL);
    }

    public function testFindZone() {
        Common::doLogin($this);

        Common::doAddMasterZone($this, 'poweradmin.org');

        $this->clickAndWait("link=Search zones and records");
        $this->type('css=td > input[name=query]', 'poweradmin.org');
        $this->clickAndWait('submit');
        $this->verifyTextPresent('master');

        Common::doRemoveZone($this, 'poweradmin.org');
    }

    public function testFindZoneWithUnderscorePattern() {
        Common::doLogin($this);

        Common::doAddMasterZone($this, 'poweradmin.org');
        Common::doAddMasterZone($this, 'poteradmin.org');

        $this->clickAndWait("link=Search zones and records");
        $this->type('css=td > input[name=query]', 'po_eradmin.org');
        $this->clickAndWait('submit');
        $this->verifyTextPresent('poweradmin.org');
        $this->verifyTextPresent('poteradmin.org');

        Common::doRemoveZone($this, 'poteradmin.org');
        Common::doRemoveZone($this, 'poweradmin.org');
    }

    public function testFindZoneWithPercentPattern() {
        Common::doLogin($this);

        Common::doAddMasterZone($this, 'poweradmin.org');
        Common::doAddMasterZone($this, 'poteradmin.org');

        $this->clickAndWait("link=Search zones and records");
        $this->type('css=td > input[name=query]', 'po%');
        $this->clickAndWait('submit');
        $this->verifyTextPresent('poweradmin.org');
        $this->verifyTextPresent('poteradmin.org');

        Common::doRemoveZone($this, 'poteradmin.org');
        Common::doRemoveZone($this, 'poweradmin.org');
    }

    public function testFindZoneRecord() {
        Common::doLogin($this);

        Common::doAddMasterZone($this, 'poweradmin.org');
        Common::doAddZoneRecord($this, 'poweradmin.org', 'www', '127.0.0.1');

        $this->clickAndWait("link=Search zones and records");
        $this->type('css=td > input[name=query]', 'www.poweradmin.org');
        $this->clickAndWait('submit');
        $this->verifyTextPresent('www.poweradmin.org');
        $this->verifyTextPresent('127.0.0.1');

        Common::doRemoveZone($this, 'poweradmin.org');
    }

    public function testFindZoneRecordWithUnderscorePattern() {
        Common::doLogin($this);

        Common::doAddMasterZone($this, 'poweradmin.org');
        Common::doAddMasterZone($this, 'poteradmin.org');
        Common::doAddZoneRecord($this, 'poweradmin.org', 'www', '127.0.0.1');
        Common::doAddZoneRecord($this, 'poteradmin.org', 'www', '127.0.0.1');

        $this->clickAndWait("link=Search zones and records");
        $this->type('css=td > input[name=query]', 'www.po_eradmin.org');
        $this->clickAndWait('submit');
        $this->verifyTextPresent('www.poweradmin.org');
        $this->verifyTextPresent('www.poteradmin.org');
        $this->verifyTextPresent('127.0.0.1');

        Common::doRemoveZone($this, 'poteradmin.org');
        Common::doRemoveZone($this, 'poweradmin.org');
    }

    public function testFindZoneRecordWithPercentPattern() {
        Common::doLogin($this);

        Common::doAddMasterZone($this, 'poweradmin.org');
        Common::doAddMasterZone($this, 'poteradmin.org');
        Common::doAddZoneRecord($this, 'poweradmin.org', 'www', '127.0.0.1');
        Common::doAddZoneRecord($this, 'poteradmin.org', 'www', '127.0.0.1');

        $this->clickAndWait("link=Search zones and records");
        $this->type('css=td > input[name=query]', 'www.po%');
        $this->clickAndWait('submit');
        $this->verifyTextPresent('www.poweradmin.org');
        $this->verifyTextPresent('www.poteradmin.org');
        $this->verifyTextPresent('127.0.0.1');

        Common::doRemoveZone($this, 'poteradmin.org');
        Common::doRemoveZone($this, 'poweradmin.org');
    }

}
