<?php
if (!Phar::canWrite()) {
	die("Phar is in read-only mode, try php -d phar.readonly=0 combo/create.php\n");
}

@unlink(__DIR__ . '/project.phar');
$p = new Phar(__DIR__ . '/project.phar', 0, 'project.phar');
$p->buildFromDirectory(__DIR__);

$stub = <<<'EOD'
<?php
Phar::interceptFileFuncs();
Phar::mungServer(array('REQUEST_URI', 'PHP_SELF', 'SCRIPT_NAME'));
Phar::WebPhar(null, 'web.php');
include "phar://" . __FILE__ . DIRECTORY_SEPARATOR . "cli.php";
__HALT_COMPILER();
EOD;
$p->setStub($stub);