# phuxtil-find

Easy interface for output of `find` unix command


> In Unix-like and some other operating systems, find is a command-line utility that searches one or more directory trees of a file system, locates files based on some user-specified criteria and applies a user-specified action on each matched file.

### Installation

```
composer require phuxtil/find
```

_Note_: Use v1.x for compatibility with PHP v7.0.x

### Usage

###### find sample output
```
1560682188|1560682181|1560682181|0755|root|root|0|0|d|10245134|0|160|5|remote_fs/|/tmp/remote_fs/
1560682162|1560682181|1560682181|0644|root|root|0|0|f|10269956|8|1210|1|test.txt|/tmp/remote_fs/test.txt
1560682162|1560682181|1560682181|0644|root|root|0|0|f|10269956|8|1210|1|test_link.txt|/tmp/remote_fs/test_link.txt
```



##### Configuration

Use `Phuxtil\Find\FindConfigurator` for configuration options.

```php
$configurator = (new FindConfigurator())
     ->setFormat('%As|%Cs|%Ts|%#m|%u|%g|%U|%G|%y|%i|%b|%s|%n|%f|%p')
     ->setFormatDelimiter('|')
     ->setLineDelimiter("\n")
     ->setFindOutput(...);
```
 

##### Facade

```php
$results = (new FindFacade())->process($configurator);
```

```php
[
    0 => Phuxtil\SplFileInfo\VirtualSplFileInfo {
        path: "/tmp"
        filename: "remote_fs"
        basename: "remote_fs"
        pathname: "/tmp/remote_fs"
        extension: ""
        realPath: "/tmp/remote_fs"
        aTime: 2019-06-16 12:49:48
        mTime: 2019-06-16 12:49:41
        cTime: 2019-06-16 12:49:41
        inode: "10245134"
        size: "160"
        perms: 0755
        owner: "0"
        group: "0"
        type: "dir"
        writable: true
        readable: true
        executable: true
        file: false
        dir: true
        link: false
        linkTarget: -1
      }
      1 => Phuxtil\SplFileInfo\VirtualSplFileInfo {
        path: "/tmp/remote_fs"
        filename: "test.txt"
        basename: "test.txt"
        pathname: "/tmp/remote_fs/test.txt"
        extension: "txt"
        realPath: "/tmp/remote_fs/test.txt"
        aTime: 2019-06-16 12:49:22
        mTime: 2019-06-16 12:49:41
        cTime: 2019-06-16 12:49:41
        inode: "10269956"
        size: "1210"
        perms: 0644
        owner: "0"
        group: "0"
        type: "file"
        writable: true
        readable: true
        executable: false
        file: true
        dir: false
        link: false
        linkTarget: -1
      }
      2 => Phuxtil\SplFileInfo\VirtualSplFileInfo {
        path: "/tmp/remote_fs"
        filename: "test_link.txt"
        basename: "test_link.txt"
        pathname: "/tmp/remote_fs/test_link.txt"
        extension: "txt"
        realPath: "/tmp/remote_fs/test_link.txt"
        aTime: 2019-06-16 12:49:22
        mTime: 2019-06-16 12:49:41
        cTime: 2019-06-16 12:49:41
        inode: "10269956"
        size: "1210"
        perms: 0644
        owner: "0"
        group: "0"
        type: "file"
        writable: true
        readable: true
        executable: false
        file: true
        dir: false
        link: false
        linkTarget: -1
      }
]
```

The result is an array containing `VirtualSplFileInfo` objects which are compatible with `\SplFileInfo`.

```php
echo $results[0]->getPathname();    # /tmp/remote_fs
echo $results[1]->isReadable();     # true
echo $results[2]->getSize();        # 1210
```

#### TDD

See [`tests`](https://github.com/oliwierptak/phuxtil-find/blob/master/tests/Functional/Find/FindFacadeTest.php) for details.
