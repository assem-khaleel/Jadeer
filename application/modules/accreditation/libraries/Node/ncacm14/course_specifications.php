<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncacm14;

/**
 * Description of course_specifications
 *
 * @author laith
 */
class Course_Specifications extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $code = 'Course_Specification';
    protected $name = 'Course Specifications (CS)';
    protected $link_pdf = true;
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_send_to_review = true;

    public function init()
    {
        parent::init();

            $this->set_institution('');
            $this->set_date('');
            $this->set_college('');
            $this->set_department('');
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $childrens = array();
        $childrens[] = new Course_Specifications_A();
        $childrens[] = new Course_Specifications_B();
        $childrens[] = new Course_Specifications_C();
        $childrens[] = new Course_Specifications_D();
        $childrens[] = new Course_Specifications_E();
        $childrens[] = new Course_Specifications_F();
        $childrens[] = new Course_Specifications_G();
        $childrens[] = new Course_Signature();

        return $childrens;
    }

    public function set_institution($value)
    {
        $property = new \Orm_Property_Text('institution', $value);
        $property->set_description('Institution');
        $this->set_property($property);
    }

    public function get_institution()
    {
        return $this->get_property('institution')->get_value();
    }

    public function set_date($value)
    {
        $property = new \Orm_Property_Text('date', $value);
        $property->set_description('Date');
        $this->set_property($property);
    }

    public function get_date()
    {
        return $this->get_property('date')->get_value();
    }

    public function set_college($value)
    {
        $property = new \Orm_Property_Text('college', $value);
        $property->set_description('College');
        $this->set_property($property);
    }

    public function get_college()
    {
        return $this->get_property('college')->get_value();
    }
    public function set_department($value)
    {
        $property = new \Orm_Property_Text('department', $value);
        $property->set_description('Department');
        $this->set_property($property);
    }

    public function get_department()
    {
        return $this->get_property('department')->get_value();
    }

    public function get_pdf_cover() {

        /** @var \Orm_Course $course */
        $course = $this->get_parent_course_node()->get_item_obj();
        /** @var \Orm_Semester $semester */
        $semester = $this->get_system_obj()->get_item_obj();

        $background = '';
        if (file_exists(rtrim(FCPATH,'/').\Orm_Institution::get_instance()->get_cs_cover())) {
            $background = 'background: url('.base_url(\Orm_Institution::get_instance()->get_cs_cover()).') no-repeat fixed center top transparent; background-size: cover; ';
        }

        $cover = '<html>';
        $cover .= '<head>';
        $cover .= '<meta charset="utf-8">';
        $cover .= '</head>';
        $cover .= '<body style="'.$background.'padding-top:600px;">';
        $cover .= '<div style="padding:20px 0; display:block; position: relative; overflow: auto; text-align: center; font-family: \'Open Sans\', sans-serif; font-weight:bold; font-size: 18pt; color: #02577e; background-color: rgba(255,255,255,0.5);">';
        $cover .= $course->get_code('english') .' '. $course->get_name('english').'<br>';
        $cover .= $semester->get_name().'<br>';
        $cover .= $course->get_department_obj()->get_name('english') .'<br>';
        $cover .= $course->get_department_obj()->get_college_obj()->get_name('english') .'<br>';
        $cover .= '</div>';
        $cover .= '</body>';
        $cover .= '</html>';

        return $cover;
    }

    public function after_node_load()
    {
        parent::after_node_load();

        $this->set_institution(\Orm_Institution::get_university_name('english'));
        $this->set_date(date('Y-m-d', strtotime($this->get_date_added())));

//        $course_node = $this->get_parent_course_node();
//        if (!is_null($course_node) && $course_node->get_id()) {
//            $department_obj = $course_node->get_item_obj()->get_program_obj()->get_department_obj();
//            $this->set_college($department_obj->get_college_obj()->get_name('english') . ' / ' . $department_obj->get_name('english'));
//        }
    }

    public function tree_item_actions(\Orm_Tree_Item &$tree_item)
    {
//        if ($this->get_parent_obj()->get_class_type() != \Orm_Node::COURSE_SECTION) {
//            $course_node = $this->get_parent_course_node();
//            if (!is_null($course_node) && $course_node->get_id()) {
//                $plan = $course_node->get_item_obj();
//                /* @var $plan \Orm_Program_Plan */
//                if ($plan->get_program_obj()->get_department_id() == $plan->get_course_obj()->get_department_id()) {
//                    $tree_item->add_action('fa fa-share-alt', '/accreditation/share/' . $this->get_id(), 'title="' . lang('Share') . '"', 'btn-primary');
//                }
//            }
//        }

        parent::tree_item_actions($tree_item);
    }

}
