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

* set your rsync config
```shell
$ vim ~/rsynp/rsynp_config.php
```

* (optional) add files or folders you want to ignore
```shell
$ vim ~/rsynp/exclude.txt
```

* synchronize
```shell
# In your project directory.
# all your files and folders under working directory
$ ~/rsynp/rsynp.php ./
# single file
$ ~/rsynp/rsynp.php someProgram.php
# single in specific path
$ ~/rsynp/rsynp.php ./someDirectory/bbb.php
# single folder, note there has no slash(/) after folder name
$ ~/rsynp/rsynp.php config
```
