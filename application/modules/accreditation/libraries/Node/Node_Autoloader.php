<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Node_Autoloader
 *
 * $this->load->library('Node/Node_Autoloader');
 * Node_Autoloader::register();
 *
 */
class Node_Autoloader
{
    /** @const string */
    const NAMESPACE_PREFIX = 'Node\\';

    /**
     * Register
     *
     * @param bool $throw
     * @param bool $prepend
     * @return void
     */
    public static function register($throw = true, $prepend = false)
    {
        spl_autoload_register(array(new self, 'node_autoload'), $throw, $prepend);
    }

    /**
     * Autoload
     *
     * @param string $class
     * @return void
     */
    public static function node_autoload($class)
    {
        $prefixLength = strlen(self::NAMESPACE_PREFIX);
        if (0 === strncmp(self::NAMESPACE_PREFIX, $class, $prefixLength)) {
            $file = str_replace('\\', DIRECTORY_SEPARATOR, substr($class, $prefixLength));
            $file = realpath(__DIR__ . (empty($file) ? '' : DIRECTORY_SEPARATOR) . strtolower($file) . '.php');
            if (file_exists($file)) {
                /** @noinspection PhpIncludeInspection Dynamic includes */
                require_once $file;
            }
        }
    }
}

