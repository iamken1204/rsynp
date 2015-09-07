#! /usr/bin/php -d magic_quotes_gpc='off' -f
<?php
ob_implicit_flush();
$rsyncConfig = require(dirname(__FILE__) . '/rsynp_config.php');
$dir = trim(shell_exec("pwd -LP"));
$file = $argv[1];

if (strlen(trim($file)) == 0) {
    die("Please give parameter input.\n");
}
$this_file = $dir . "/" . $file;
if (!is_file($this_file) && !is_dir($this_file)) {
    die("This is not a file or directory.\n");
}
if (
    preg_match("/\.php$/i", $file) &&
    !preg_match(
        "/No syntax errors detected/i",
        shell_exec("/usr/bin/php -d magic_quotes_gpc='off' -l" . $this_file)
    )
   ) {
    die($this_file . " systax error!\n");
}
if (is_link($this_file)) {
    die("This is a symbolic link.\n");
}

$hostPath = empty($rsyncConfig['hostPath']) ? $dir : $rsyncConfig['hostPath'];
$hostPath .= '/';
$excludeCmd = "--exclude-from '" . $rsyncConfig['rsynpPath'] . "/exclude.txt'";
echo $excludeCmd;exit;
foreach ($rsyncConfig['serverList'] as $server) {
    $cmd = sprintf(
        "rsync -rlptoDv --delete %s %s %s@%s:%s",
        $excludeCmd,
        $file,
        $rsyncConfig['hostName'],
        $server,
        $hostPath
    );
    echo $cmd . "\r\n";
    echo shell_exec($cmd) . "\r\n";
}
echo "\r\n";
echo "\n******************************* Rsync has completed. *******************************\n\n";
