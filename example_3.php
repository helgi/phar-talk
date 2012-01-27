<?php
header('Content-type: text/javascript');
echo file_get_contents('phar://example3/project.phar/js/zepto.js');