<?php
if (!Phar::canWrite()) {
	die("Phar is in read-only mode, try php -d phar.readonly=0 example2/create.php\n");
}

@unlink(__DIR__ . '/project.phar');
$p = new Phar(__DIR__ . '/project.phar', 0, 'project.phar');
$p['awesome.php'] = '<?php
echo "Hi Phar people! :-) Example 2\n";';