<?php
$cmd = '/var/www/html/quizroomubknew/panel/lib/wordtohtml/mammoth/node_modules/mammoth/bin/mammoth sample.docx --output-dir sample';
$a=shell_exec($cmd);
var_dump($a);
die('a');
?>
