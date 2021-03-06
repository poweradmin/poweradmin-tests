<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';
require_once 'functional/common.php';

class TRAC_446_Zone_Update_From_Template_Test extends PHPUnit_Extensions_SeleniumTestCase {

    protected function setUp() {
        $this->setBrowserUrl(BROWSER_URL);
    }

    public function testZoneUpdateFromTemplate() {
        Common::doLogin($this);
        Common::doAddMasterZone($this, 'poweradmin.org');

        $this->clickAndWait("link=List zone templates");
        $this->clickAndWait("link=Add zone template");
        $this->type('templ_name', "www");
        $this->type('templ_descr', "www");
        $this->clickAndWait("commit");

        $this->clickAndWait("link=List zone templates");

        $this->clickAndWait("css=img[alt=\"[ Edit template ]\"]");
        $this->clickAndWait("css=div.content > input.button");
        $this->type('name', "www.[ZONE]");
        $this->select('type', "label=CNAME");
        $this->type('content', "[ZONE]");
        $this->clickAndWait("commit");

        $this->clickAndWait("link=List zones");
        $this->clickAndWait("css=img[alt=\"[ View zone poweradmin.org ]\"]");
        $this->select('zone_template', 'label=www');
        $this->clickAndWait("template_change");

        $this->clickAndWait("link=List zones");
        $this->clickAndWait("css=img[alt=\"[ View zone poweradmin.org ]\"]");
//		$this->verifyValue("record[1][name]", "www.poweradmin.org");
        $this->verifyValue("//input[contains(@name,'name')]", "www.poweradmin.org");
//		$this->verifyValue("record[1][content]", "poweradmin.org");
        $this->verifyValue("//input[contains(@name,'content')]", "poweradmin.org");

        $this->clickAndWait("link=List zone templates");
        $this->clickAndWait("css=img[alt=\"[ Edit template ]\"]");
        $this->clickAndWait("css=img[alt=\"[ Delete record ]\"]");
        $this->clickAndWait("css=input.button");

        $this->clickAndWait("link=List zone templates");
        $this->clickAndWait("css=img[alt=\"[ Delete template ]\"]");
        $this->clickAndWait("css=input.button");

        Common::doRemoveZone($this, 'poweradmin.org');
    }

}
