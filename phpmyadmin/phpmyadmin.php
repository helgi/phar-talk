<?php
if (!Phar::canWrite()) {
	die("Phar is in read-only mode, try php -d phar.readonly=0 phpmyadmin.php\n");
}

@unlink(__DIR__ . '/phpmyadmin.phar');
$a = new Phar(__DIR__ . '/phpmyadmin.phar', 0, 'phpmyadmin.phar');
$a->buildFromDirectory("phpMyAdmin-3.4.9-english");
$a->startBuffering();
$a["config.inc.php"] = <<<'EOD'
<?php
/* Servers configuration */
$i = 0;

/* Server localhost (config:root) [1] */
$i++;
$cfg['Servers'][$i]['host'] = 'localhost';
$cfg['Servers'][$i]['extension'] = 'mysqli';
$cfg['Servers'][$i]['connect_type'] = 'tcp';
$cfg['Servers'][$i]['compress'] = false;
$cfg['Servers'][$i]['auth_type'] = 'config';
$cfg['Servers'][$i]['user'] = ‘phar’;
$cfg['Servers'][$i]['password'] = ‘phar’;


/* End of servers configuration */
if (strpos(PHP_OS, 'WIN') !== false) {
    $cfg['UploadDir'] = getcwd();
} else {
    $cfg['UploadDir'] = '/tmp/pharphpmyadmin';
    @mkdir('/tmp/pharphpmyadmin');
    @chmod('/tmp/pharphpmyadmin', 0777);
}
EOD;
$a->setStub('<?php
Phar::interceptFileFuncs();
set_include_path("phar://" . __FILE__);
Phar::webPhar("phpmyadmin.phar", "index.php");
echo "phpMyAdmin is intended to be executed from a web browser\n";
exit -1;
__HALT_COMPILER();
');
$a->stopBuffering();