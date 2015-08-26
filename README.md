# rsynp
rsynp Rsync php

## Requirements
* `/usr/bin/php`

## How to use
* clone
```shell
$ cd ~
$ git clone https://github.com/iamken1204/rsynp.git
```

* refined your rsync config
```shell
$ vim ~/rsynp/rsynp_config.php
```

* synchronize
```shell
# In your project directory.
$ ~/rsynp/rsynp.php ./
$ ~/rsynp/rsynp.php someProgram.php
$ ~/rsynp/rsynp.php ./someDirectory/bbb.php
```
