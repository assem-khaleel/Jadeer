# Jadeer Readme

This package installs the offical [CodeIgniter](https://www.codeigniter.com) (version `3.1.2`) .

You can update CodeIgniter system folder to latest version by copy the new system dir .

## Folder Structure

```
codeigniter/
├── application/
├── composer.json
├── composer.lock
├── .htaccess
│── index.php
│── system
└── vendor/
    └── codeigniter/
        └── framework/
            └── system/
```

## Requirements

* PHP 5.3.2 or later
* `composer` command (See [Composer Installation](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx))
* Git

## How to Use

### Install CodeIgniter

And it changes `application/config/config.php`:

~~~
$config['composer_autoload'] = FALSE;
↓
$config['composer_autoload'] = realpath(APPPATH . '../vendor/autoload.php');
~~~

~~~
$config['index_page'] = 'index.php';
↓
$config['index_page'] = '';
~~~

### Run PHP built-in server (PHP 5.4 or later)

```
$ bin/
```

### Fonts (google)

```
goofoffline outDir=./assets/fonts/Open-Sans outCss=gf.css "http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,800,300&subset=latin"
```