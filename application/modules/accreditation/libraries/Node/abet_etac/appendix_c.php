<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 30/03/17
 * Time: 12:31 م
 */

namespace Node\abet_etac;


class Appendix_C extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $name = 'Appendix C – Equipment';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;
    protected $orientation = 'landscape';

    public function init()
    {
        parent::init();
        $this->set_majors('');
    }

    public function set_majors($value)
    {
        $property = new \Orm_Property_Textarea('majors', $value);
        $property->set_description('Please list the major pieces of equipment used by the program in support of instruction.');
        $this->set_property($property);
    }

    public function get_majors()
    {
        return $this->get_property('majors')->get_value();
    }


}