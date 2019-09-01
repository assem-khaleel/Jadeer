<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_User_Default extends Orm_User
{

    protected $class_type = __CLASS__;

    public function get_first_name()
    {
        return 'Unknown';
    }

    public function get_last_name()
    {
        return 'User';
    }
}

