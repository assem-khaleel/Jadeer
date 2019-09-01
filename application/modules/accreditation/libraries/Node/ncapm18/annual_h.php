<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 11/10/18
 * Time: 11:27 ص
 */

namespace Node\ncapm18;


class Annual_H extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'H. Program Improvement Plan';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

        $this->set_plan(array());
    }

    public function set_plan($value){
        $property = new \Orm_Property_Table_Dynamic('plan',$value);
        $property->set_is_responsive(1);
        $recommend = new \Orm_Property_Textarea('recommend');
        $recommend->set_description('Recommendations');
        $recommend->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $recommend->set_width(200);
        $property->add_property($recommend);

        $actions = new \Orm_Property_Textarea('actions');
        $actions->set_description('Actions');
        $actions->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $actions->set_width(200);
        $property->add_property($actions);

        $responsible = new \Orm_Property_Text('responsible');
        $responsible->set_description('Responsible Person');
        $responsible->set_width(200);
        $property->add_property($responsible);

        $start = new \Orm_Property_Text('start');
        $start->set_description('Start');
        $start->set_width(100);
        $start->set_group('Date');
        $property->add_property($start);

        $end = new \Orm_Property_Text('end');
        $end->set_description('End');
        $end->set_width(100);
        $end->set_group('Date');
        $property->add_property($end);

        $achieve = new \Orm_Property_Textarea('achieve');
        $achieve->set_description('Achievement indicator');
        $achieve->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $achieve->set_width(200);
        $property->add_property($achieve);

        $target = new \Orm_Property_Text('target');
        $target->set_description('Target Benchmark');
        $target->set_width(100);
        $property->add_property($target);

        $this->set_property($property);
    }
    public function get_plan(){
        return $this->get_property('plan')->get_value();
    }
}