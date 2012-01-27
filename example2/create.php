<?php
if (!Phar::canWrite()) {
	die("Phar is in read-only mode, try php -d phar.readonly=0 example2/create.php\n");
}

@unlink('project.phar');
$p = new Phar('example2/project.phar');
$p['awesome.php'] = '<?php
echo "Hi Phar people! :-) Example 2\n";';