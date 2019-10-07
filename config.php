<?php

define('devOrg', 'Ccit');
define('devOrgLink', 'http://ccit.com/');
define('client', 'Stepup');
define("source", "ccitdatabase.db.10762873.hostedresource.com");
define("sysConFolder", "system");
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    define("adminUrl", 'http://' . $_SERVER['SERVER_NAME'] . '/ccit/');
    define("db", "ccit");
    define("dbUser", "root");
    define("dbPass", "");
} else {
      define("adminUrl", 'http://' . $_SERVER['SERVER_NAME'].'/');
    define("db", "ccitdatabase");
    define("dbUser", "ccitdatabase");
    define("dbPass", "Ccit123!");
}
