<?php
ob_start();

$html = '<img src="">';
$config = array('indent' => TRUE,
                'output-xhtml' => TRUE,
                'show-body-only' => TRUE,
                'wrap' => 200);

$tidy = tidy_parse_string($html,$config,'utf8');
echo $tidy;
?>