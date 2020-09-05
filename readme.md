# How to deploy the gas?
#### 1. INSTALL PHP development environment
INSTALL XAMPP is a quick way to  INSTALL PHP development environment. XAMPP is a completely free, easy to install Apache distribution containing MariaDB, PHP, and Perl. The XAMPP open source package has been set up to be incredibly easy to install and to use.

1. DOWNLOAD the 7.2.x / PHP 7.2.x version of XAMPP from https://www.apachefriends.org/download.html for your platform.
2. INSTALL the 7.2.x / PHP 7.2.x version of XAMPP for your platform.
3. START XAMPP(Apache and MySQL).

Be sure to read the install instructions and FAQs:
1. [Linux FAQs](https://www.apachefriends.org/faq_linux.html)
2. [Windows FAQs](https://www.apachefriends.org/faq_windows.html)
3. [OS X FAQs](https://www.apachefriends.org/faq_osx.html)
4. [OS X XAMPP-VM FAQs](https://www.apachefriends.org/faq_stackman.html)

You can find additional help on [forums](https://community.apachefriends.org/) or [Stack Overflow](http://stackoverflow.com/search?q=xampp).

#### 2. INSTALL blast+, HMMER, and Python(MySQLdb, numpy, pandas)
1. [INSTALL blast+](https://www.ncbi.nlm.nih.gov/books/NBK52640/)
2. [INSTALL HMMER](http://www.hmmer.org/documentation.html)
3. INSTALL Python(MySQLdb, numpy, and pandas)

#### 3. GIT CLONE and CONFIGURE GAS
1. GIT CLONE [gas](https://github.com/BlueFishManCN/gas) to the XAMPP/xamppfiles/htdocs.
2. CONFIGURE $_GAS_ROOT_PATH in gas/application/config/constants.php. Like :
```php
$_GAS_ROOT_PATH = '/Applications/XAMPP/xamppfiles/htdocs/gas';
```
3. CONFIGURE $_BLASTP_PATH in gas/application/config/constants.php. Like :
```php
$_BLASTP_PATH = '/usr/local/bin/blastp';
```
4. CONFIGURE $_HMMSEARCH_PATH in gas/application/config/constants.php. Like :
```php
$_HMMSEARCH_PATH = '/usr/local/bin/hmmsearch';
```
5. EXECUTE the gas/application/database/gas.sql to the database.
Like :
```bash
/Applications/XAMPP/xamppfiles/bin/mysql -u root -p < /Applications/XAMPP/htdocs/gas/application/database/gas.sql
```
6. CONFIGURE hostname, username, and password of database gas in gas/application/config/database.php. Like :
```php
$db['default'] = array(
	'dsn'	=> '',
	'hostname' => '127.0.0.1',
	'username' => 'root',
	'password' => '',
	'database' => 'gas',
```
#### 4. Import or update data

#### 5. DEPLOY and VISIT gas frontend
1. GIT CLONE [gas_frontend/web](https://github.com/BlueFishManCN/gas-frontend/tree/master/web) to the XAMPP/xamppfiles/htdocs.
2. VISIT [http://127.0.0.1/web/#/home](http://127.0.0.1/web/#/home).

# How to develop the gas?
#### 1. Backend based on CodeIgniter
[gas backend repo](https://github.com/BlueFishManCN/gas)
[CodeIgniter User Guide](https://www.codeigniter.com/userguide3/index.html)
### 2. Frontend based on Vue and Element
[gas frontend repo](https://github.com/BlueFishManCN/gas-frontend)
[Vue](https://vuejs.org/index.html)
[Vue CLI](https://cli.vuejs.org/)
[Element](https://element.eleme.cn/#/en-US)