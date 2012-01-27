<?php
if (!Phar::canWrite()) {
	die("Phar is in read-only mode, try php -d phar.readonly=0 example3/create.php\n");
}

@unlink('project.phar');
$p = new Phar('example3/project.phar', 0, 'project.phar');
$p->buildFromDirectory(__DIR__);