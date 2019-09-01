<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit389c6e28ffa9967a4aa296efaf99ab7f
{
    public static $prefixLengthsPsr4 = array (
        'm' => 
        array (
            'mikehaertl\\wkhtmlto\\' => 20,
            'mikehaertl\\tmp\\' => 15,
            'mikehaertl\\shellcommand\\' => 24,
        ),
        'T' => 
        array (
            'TijsVerkoyen\\CssToInlineStyles\\' => 31,
        ),
        'S' => 
        array (
            'Symfony\\Component\\Process\\' => 26,
            'Symfony\\Component\\CssSelector\\' => 30,
            'Selenium\\' => 9,
        ),
        'L' => 
        array (
            'Lcobucci\\JWT\\' => 13,
        ),
        'F' => 
        array (
            'Facebook\\WebDriver\\' => 19,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'mikehaertl\\wkhtmlto\\' => 
        array (
            0 => __DIR__ . '/..' . '/mikehaertl/phpwkhtmltopdf/src',
        ),
        'mikehaertl\\tmp\\' => 
        array (
            0 => __DIR__ . '/..' . '/mikehaertl/php-tmpfile/src',
        ),
        'mikehaertl\\shellcommand\\' => 
        array (
            0 => __DIR__ . '/..' . '/mikehaertl/php-shellcommand/src',
        ),
        'TijsVerkoyen\\CssToInlineStyles\\' => 
        array (
            0 => __DIR__ . '/..' . '/tijsverkoyen/css-to-inline-styles/src',
        ),
        'Symfony\\Component\\Process\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/process',
        ),
        'Symfony\\Component\\CssSelector\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/css-selector',
        ),
        'Selenium\\' => 
        array (
            0 => __DIR__ . '/../..' . '/selenium',
        ),
        'Lcobucci\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/lcobucci/jwt/src',
        ),
        'Facebook\\WebDriver\\' => 
        array (
            0 => __DIR__ . '/..' . '/facebook/webdriver/lib',
        ),
    );

    public static $prefixesPsr0 = array (
        'o' => 
        array (
            'org\\bovigo\\vfs' => 
            array (
                0 => __DIR__ . '/..' . '/mikey179/vfsStream/src/main/php',
            ),
        ),
        'P' => 
        array (
            'PHPExcel' => 
            array (
                0 => __DIR__ . '/..' . '/phpoffice/phpexcel/Classes',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit389c6e28ffa9967a4aa296efaf99ab7f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit389c6e28ffa9967a4aa296efaf99ab7f::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit389c6e28ffa9967a4aa296efaf99ab7f::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}