<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 11/10/18
 * Time: 12:32 م
 */

namespace Node\ncapm18;


class Program_Specifications_B extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $name = 'B. Reasons for establishing the Program';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

        $this->set_reasons('');
        $this->set_institutional_reasons('');

    }

    public function set_reasons($value){
        $property =  new \Orm_Property_Textarea('reasons',$value);
        $property->set_description('1.National level reasons (Economical, social, cultural, technological reasons and national needs and development …. etc.)');
        $this->set_property($property);
    }
    public function get_reasons()
    {
        return $this->get_property('reasons')->get_value();
    }

    public function set_institutional_reasons($value){
        $property =  new \Orm_Property_Textarea('institutional_reasons',$value);
        $property->set_description('2. Institutional level reasons (Relevance of the program to the mission and goals of the institution …. etc.)');
        $this->set_property($property);
    }
    public function get_institutional_reasons(){
        return $this->get_property('institutional_reasons')->get_value();
    }

}