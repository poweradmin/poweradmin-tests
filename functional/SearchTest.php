<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';
require_once 'common.php';

class SearchTest extends PHPUnit_Extensions_SeleniumTestCase {

	protected function setUp() {
		$this->setBrowserUrl(BROWSER_URL);
	}

	public function testFindZone() {
		Common::doLogin();

		Common::doAddMasterZone('poweradmin.org');

		$this->clickAndWait("link=Search zones and records");
		$this->type('css=td > input[name=query]', 'poweradmin.org');
		$this->clickAndWait('submit');
		$this->verifyTextPresent('master');

		Common::doRemoveZone('poweradmin.org');
	}

	public function testFindZoneWithUnderscorePattern() {
		Common::doLogin();

		Common::doAddMasterZone('poweradmin.org');
		Common::doAddMasterZone('poteradmin.org');

		$this->clickAndWait("link=Search zones and records");
		$this->type('css=td > input[name=query]', 'po_eradmin.org');
		$this->clickAndWait('submit');
		$this->verifyTextPresent('poweradmin.org');
		$this->verifyTextPresent('poteradmin.org');

		Common::doRemoveZone('poteradmin.org');
		Common::doRemoveZone('poweradmin.org');
	}

	public function testFindZoneWithPercentPattern() {
		Common::doLogin();

		Common::doAddMasterZone('poweradmin.org');
		Common::doAddMasterZone('poteradmin.org');

		$this->clickAndWait("link=Search zones and records");
		$this->type('css=td > input[name=query]', 'po%');
		$this->clickAndWait('submit');
		$this->verifyTextPresent('poweradmin.org');
		$this->verifyTextPresent('poteradmin.org');

		Common::doRemoveZone('poteradmin.org');
		Common::doRemoveZone('poweradmin.org');
	}

    public function testFindZoneRecord() {
        Common::doLogin();

        Common::doAddMasterZone('poweradmin.org');
        Common::doAddZoneRecord('poweradmin.org', 'www', '127.0.0.1');

        $this->clickAndWait("link=Search zones and records");
        $this->type('css=td > input[name=query]', 'www.poweradmin.org');
        $this->clickAndWait('submit');
        $this->verifyTextPresent('www.poweradmin.org');
        $this->verifyTextPresent('127.0.0.1');

        Common::doRemoveZone('poweradmin.org');
    }

    public function testFindZoneRecordWithUnderscorePattern() {
        Common::doLogin();

        Common::doAddMasterZone('poweradmin.org');
        Common::doAddMasterZone('poteradmin.org');
        Common::doAddZoneRecord('poweradmin.org', 'www', '127.0.0.1');
        Common::doAddZoneRecord('poteradmin.org', 'www', '127.0.0.1');

        $this->clickAndWait("link=Search zones and records");
        $this->type('css=td > input[name=query]', 'www.po_eradmin.org');
        $this->clickAndWait('submit');
        $this->verifyTextPresent('www.poweradmin.org');
        $this->verifyTextPresent('www.poteradmin.org');
        $this->verifyTextPresent('127.0.0.1');

        Common::doRemoveZone('poteradmin.org');
        Common::doRemoveZone('poweradmin.org');
    }

    public function testFindZoneRecordWithPercentPattern() {
        Common::doLogin();

        Common::doAddMasterZone('poweradmin.org');
        Common::doAddMasterZone('poteradmin.org');
        Common::doAddZoneRecord('poweradmin.org', 'www', '127.0.0.1');
        Common::doAddZoneRecord('poteradmin.org', 'www', '127.0.0.1');

        $this->clickAndWait("link=Search zones and records");
        $this->type('css=td > input[name=query]', 'www.po%');
        $this->clickAndWait('submit');
        $this->verifyTextPresent('www.poweradmin.org');
        $this->verifyTextPresent('www.poteradmin.org');
        $this->verifyTextPresent('127.0.0.1');

        Common::doRemoveZone('poteradmin.org');
        Common::doRemoveZone('poweradmin.org');
    }

} 

?>
