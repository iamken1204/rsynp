<?php

// hostPath default is empty, reflects to your working directory
// e.g. you are in path /home/www/some.kind.site/,
// then rsynp will rsync your files to remote:/home/www/some.kind/site/
return [
    'hostName' => 'www-data',
    'hostPath' => '',
    'serverList' => [
        // '10.1.2.3',
        // '10.1.4.5'
    ],
];
