<?php
/**
 * Created by PhpStorm.
 * User: dura
 * Date: 10/8/18
 * Time: 1:50 PM
 */

namespace Node\ncacm18;


class Course_Specifications_C extends \Orm_Node {
    protected $class_type = __CLASS__;
    protected $name = 'C. Course Content';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

        $this->set_topics(array());

    }

    public function set_topics($value){
        $property = new \Orm_Property_Table_Dynamic('topics',$value);
        $property->set_description('Topics to be covered (List the main topics of the course in relation to the course learning outcomes)');

        $topic = new \Orm_Property_Text('topic');
        $topic->set_description('List of Topics');
        $topic->set_width(300);
        $property->add_property($topic);

        $contact_hrs = new \Orm_Property_Text('contact_hrs');
        $contact_hrs->set_description('Contact Hours');
        $contact_hrs->set_width(100);
        $property->add_property($contact_hrs);

        $clo = new \Orm_Property_Textarea('clo');
        $clo->set_description('Related CLOs');
        $clo->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $clo->set_width(300);
        $property->add_property($clo);


        $this->set_property($property);

    }


    public function get_topics(){

       return $this->get_property('topics')->get_value();
    }


}