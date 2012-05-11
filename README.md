# Requirements

All tests should work fine with:
* PHPUnit 3.4.13
* selenium-server-standalone-2.21.0.jar
* Firefox 12 


# How to run tests

1. Start Selenium server:

    java -jar selenium-server-standalone-2.21.0.jar

2. Get the latest source code and go to parent directory

    svn checkout https://www.poweradmin.org/svn/trunk poweradmin/ 
    cd poweradmin
    phpunit tests

You can select what type of tests you want to run:

     phpunit tests/components	(only core functions)
     phpunit tests/functional	(only web UI, browser and selenium server is required)
     phpunit tests/regression


# Settings

There is phpunit.xml.dist file which you can copy to phpunit.xml and make changes in settings
(e.g. browser or server url).

