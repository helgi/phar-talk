<?php
if (!Phar::canWrite()) {
	die("Phar is in read-only mode, try php -d phar.readonly=0 autoload/create.php\n");
}

@unlink('project.phar');
$p = new Phar('project.phar', 0, 'project.phar');
$p->buildFromDirectory(__DIR__);

$stub = <<<'EOD'
#!/usr/bin/env php
<?php
Phar::interceptFileFuncs();
function __autoload ($load) {
	include "phar://" . __FILE__ . "/$load.php";
}
include "phar://" . __FILE__ . "/cli.php";
__HALT_COMPILER();
EOD;
$p->setStub($stub);

chmod('project.phar', 0744);