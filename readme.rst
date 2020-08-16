#How to deploy the gas?
#### 1. INSTALL PHP development environment
INSTALL XAMPP is a quick way to  INSTALL PHP development environment. XAMPP is a completely free, easy to install Apache distribution containing MariaDB, PHP, and Perl. The XAMPP open source package has been set up to be incredibly easy to install and to use.

step1 : DOWNLOAD the 7.2.x / PHP 7.2.x version of XAMPP from https://www.apachefriends.org/download.html for your platform.
step2 : INSTALL the 7.2.x / PHP 7.2.x version of XAMPP for your platform.
step3 : START XAMPP(Apache and MySQL).

Be sure to read the install instructions and FAQs:
[Linux FAQs](https://www.apachefriends.org/faq_linux.html)
[Windows FAQs](https://www.apachefriends.org/faq_windows.html)
[OS X FAQs](https://www.apachefriends.org/faq_osx.html)
[OS X XAMPP-VM FAQs](https://www.apachefriends.org/faq_stackman.html)
You can find additional help on [forums](https://community.apachefriends.org/) or [Stack Overflow](http://stackoverflow.com/search?q=xampp).

####2. INSTALL blast+, HMMER, and Python(MySQLdb, numpy, pandas)
[INSTALL blast+](https://www.ncbi.nlm.nih.gov/books/NBK52640/)
[INSTALL HMMER](http://www.hmmer.org/documentation.html)
INSTALL Python(MySQLdb, numpy, and pandas)

####3. GIT CLONE and CONFIGURE GAS
step1 : GIT CLONE [gas](https://github.com/BlueFishManCN/gas) to the XAMPP/xamppfiles/htdocs.
step2 : CONFIGURE $_GAS_ROOT_PATH in gas/application/config/constants.php. Like :
```php
$_GAS_ROOT_PATH = '/Applications/XAMPP/xamppfiles/htdocs/gas';
```
step3 : CONFIGURE $_BLASTP_PATH in gas/application/config/constants.php. Like :
```php
$_BLASTP_PATH = '/usr/local/bin/blastp';
```
step4 : CONFIGURE $_HMMSEARCH_PATH in gas/application/config/constants.php. Like :
```php
$_HMMSEARCH_PATH = '/usr/local/bin/hmmsearch';
```
step5 : EXECUTE the gas/application/database/gas.sql to the database.
Like :
```bash
/Applications/XAMPP/xamppfiles/bin/mysql -u root -p < /Applications/XAMPP/htdocs/gas/application/database/gas.sql
```
step6 : CONFIGURE hostname, username, and password of database gas in gas/application/config/database.php. Like :
```php
$db['default'] = array(
	'dsn'	=> '',
	'hostname' => '127.0.0.1',
	'username' => 'root',
	'password' => '',
	'database' => 'gas',
```
####4. Import or update data

####5. DEPLOY gas frontend
step1 : GIT CLONE [gas_frontend/web](https://github.com/BlueFishManCN/gas-frontend) to the XAMPP/xamppfiles/htdocs.
step2 : visit [http://127.0.0.1/web/#/home](http://127.0.0.1/web/#/home).

#How to develop the gas?
###################
What is CodeIgniter
###################

CodeIgniter is an Application Development Framework - a toolkit - for people
who build web sites using PHP. Its goal is to enable you to develop projects
much faster than you could if you were writing code from scratch, by providing
a rich set of libraries for commonly needed tasks, as well as a simple
interface and logical structure to access these libraries. CodeIgniter lets
you creatively focus on your project by minimizing the amount of code needed
for a given task.

*******************
Release Information
*******************

This repo contains in-development code for future releases. To download the
latest stable release please visit the `CodeIgniter Downloads
<https://codeigniter.com/download>`_ page.

**************************
Changelog and New Features
**************************

You can find a list of all changes for each release in the `user
guide change log <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/changelog.rst>`_.

*******************
Server Requirements
*******************

PHP version 5.6 or newer is recommended.

It should work on 5.3.7 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance
issues, as well as missing features.

************
Installation
************

Please see the `installation section <https://codeigniter.com/user_guide/installation/index.html>`_
of the CodeIgniter User Guide.

*******
License
*******

Please see the `license
agreement <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/license.rst>`_.

*********
Resources
*********

-  `User Guide <https://codeigniter.com/docs>`_
-  `Language File Translations <https://github.com/bcit-ci/codeigniter3-translations>`_
-  `Community Forums <http://forum.codeigniter.com/>`_
-  `Community Wiki <https://github.com/bcit-ci/CodeIgniter/wiki>`_
-  `Community Slack Channel <https://codeigniterchat.slack.com>`_

Report security issues to our `Security Panel <mailto:security@codeigniter.com>`_
or via our `page on HackerOne <https://hackerone.com/codeigniter>`_, thank you.

***************
Acknowledgement
***************

The CodeIgniter team would like to thank EllisLab, all the
contributors to the CodeIgniter project and you, the CodeIgniter user.
