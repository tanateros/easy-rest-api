Install
=
Migrate ./dump.sql to MySQL DB.

Update a file for actual DB config ./config/config.ini.

Add new host (at the example test.com). If nginx then need hide prefix in uri "/index.php", if Apache2 need use mod_rewrite (in .htaccess or in conf-file) (next is rewrite ./config/routes.ini for remove "/index.php")

Last:
<code> composer install </code>

Require
=
- PHP 5.6+

- MySQL 5.*

- curl or other analog tools

- web-server (Apache 2.4+, nginx etc.)

Using
=

<code>curl -X POST -H 'Content-Type: application/json' -d '{"table":"News"}' http://test-ru.my/index.php/api/Table</code>
<code>curl -X POST -H 'Content-Type: application/json' -d '{"table":"News","id":"1"}' http://test-ru.my/index.php/api/Table</code>

<code>curl -X POST -H 'Content-Type: application/json' -d '{"sessionId":"1","email":"airmail@code-pilots.com"}' http://test-ru.my/index.php/api/SessionSubscribe</code>
