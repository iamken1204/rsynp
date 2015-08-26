#! /usr/bin/php -d magic_quotes_gpc='off' -f
<?php
ob_implicit_flush();
$rsyncConfig = require(dirname(__FILE__) . '/rsync_config.php');
$dir = trim(shell_exec("pwd -LP"));
$file = $argv[1];

if (strlen(trim($file)) == 0) {
    die("Please give parameter input.");
}
$this_file = $dir . "/" . $file;
if (!is_file($this_file) && !is_dir($this_file)) {
    die("This is not a file or directory.");
}
if (
    preg_match("/\.php$/i", $file) &&
    !preg_match(
        "/No syntax errors detected/i",
        shell_exec("/usr/bin/php -d magic_quotes_gpc='off' -l" . $this_file)
    )
   ) {
    die($this_file . " systax error!");
}
if (is_link($this_file)) {
    die("This is a symbolic link.");
}

foreach ($rsyncConfig['serverList'] as $server) {
    $cmd = sprintf(
        "rsync -rlptoDv --delete %s %s@%s:%s",
        $file,
        $rsyncConfig['hostName'],
        $server,
        $dir . "/"
    );
    echo $cmd . "\r\n";
    echo shell_exec($cmd) . "\r\n";
}
echo "\r\n";
echo "\n******************************* Rsync has completed. *******************************\n\n";
