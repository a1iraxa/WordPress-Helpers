
Well, this is your chance! It looks like PDO is ready; use that instead.

Try checking to see if the PHP MySQL extension module is being loaded:

<?php
    phpinfo();
?>
If it's not there, add the following to the php.ini file:

extension=php_mysql.dll