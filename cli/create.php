<?php
if (!Phar::canWrite()) {
	die("Phar is in read-only mode, try php -d phar.readonly=0 cli/create.php\n");
}

@unlink(__DIR__ . '/project.phar');
$p = new Phar(__DIR__ . '/project.phar', 0, 'project.phar');
$p->buildFromDirectory(__DIR__);

$stub = <<<'EOD'
#!/usr/bin/env php
<?php
Phar::interceptFileFuncs();
include "phar://" . __FILE__ . "/cli.php";
__HALT_COMPILER();
EOD;
$p->setStub($stub);

chmod(__DIR__ . '/project.phar', 0744);