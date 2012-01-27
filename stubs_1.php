<?
if (!Phar::canWrite()) {
	die("Phar is in read-only mode, try php -d phar.readonly=0 stubs_1.php\n");
}

$phar = new Phar('project.phar');
$phar->setStub('<?php __HALT_COMPILER();');