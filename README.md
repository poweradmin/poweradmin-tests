# Requirements

All tests should work fine with:
* PHPUnit 3.6.10
* PEAR phpunit/PHPUnit_Selenium
* selenium-server-standalone-2.21.0.jar
* Firefox 12 


# How to run tests

1. Start Selenium server:

    java -jar selenium-server-standalone-2.21.0.jar

2. Get the latest source code and also fetch tests repository:

    git clone git://github.com/poweradmin/poweradmin.git
    cd poweradmin
    git clone git://github.com/poweradmin/poweradmin-tests.git tests

3. Run select type of tests:

    phpunit components	(only core functions)
    phpunit functional	(only web UI, browser and selenium server is required)
    phpunit regression


# Settings

There is phpunit.xml.dist file which you can copy to phpunit.xml and make changes in settings
(e.g. browser or server url).

