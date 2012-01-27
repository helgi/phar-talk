<?php
if (!Phar::canWrite()) {
	die("Phar is in read-only mode, try php -d phar.readonly=0 stubs_4.php\n");
}

$phar = new Phar('project.phar');
$phar->setDefaultStub('cli.php', 'public/index.php');
echo $phar->getStub();