<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 09/10/18
 * Time: 05:19 م
 */

namespace Node\ncapm18;


class Annual_G extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $name = 'G. Challenges and difficulties';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

        $this->set_challenge(array());
    }

    public function set_challenge($value){

        $challenge_table = new \Orm_Property_Table_Dynamic('challenge_table', $value);

        $difficult = new \Orm_Property_Textarea('difficult');
        $difficult->set_description('Challenges and difficulties');
        $difficult->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $difficult->set_width(200);
        $challenge_table->add_property($difficult);

        $implications = new \Orm_Property_Textarea('implications');
        $implications->set_description('Implications on the program');
        $implications->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $implications->set_width(200);
        $challenge_table->add_property($implications);

        $action = new \Orm_Property_Textarea('action');
        $action->set_description('Action taken');
        $action->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $action->set_width(200);
        $challenge_table->add_property($action);


        $property = new \Orm_Property_Table('challenge', $value);
        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('text', '1.Program management difficulties (if any)'));
        $property->add_cell(2, 1, $challenge_table);
        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('text', '2.Internal challenges'));
        $property->add_cell(4, 1, $challenge_table);
        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('text', '3.External challenges  '));
        $property->add_cell(6, 1, $challenge_table);

        $this->set_property($property);
    }
    public function get_challenge(){
        return $this->get_property('challenge')->get_value();
    }

}