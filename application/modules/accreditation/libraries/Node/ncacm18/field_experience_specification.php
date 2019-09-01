<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 05/07/18
 * Time: 02:43 م
 */

namespace Node\ncacm18;


class Field_Experience_Specification extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $code = 'Field_Exp_Specification';
    protected $name = 'Field Experience Specification';
    protected $link_pdf = true;
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_send_to_review = true;

    function init()
    {
        parent::init();

        $this->set_institution('');
        $this->set_date('');
        $this->set_college('');
        $this->set_department('');
        $this->set_program('');
        $this->set_track('');
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $childrens = array();
        $childrens[] = new Field_Experience_Specification_A();
        $childrens[] = new Field_Experience_Specification_B();
        $childrens[] = new Field_Experience_Specification_C();
        $childrens[] = new Field_Experience_Specification_D();
        $childrens[] = new Field_Experience_Specification_E();
        $childrens[] = new Field_Experience_Sp_Signature();

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
        $property->set_description('Date of Report');
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

    public function set_program($value)
    {
        $property = new \Orm_Property_Text('program', $value);
        $property->set_description('Program');
        $this->set_property($property);
    }

    public function get_program()
    {
        return $this->get_property('program')->get_value();
    }

    public function set_track($value)
    {
        $property = new \Orm_Property_Text('track', $value);
        $property->set_description('Track (if any)');
        $this->set_property($property);
    }

    public function get_track()
    {
        return $this->get_property('track')->get_value();
    }

    public function get_pdf_cover() {

        /** @var \Orm_Course $course */
        $course = $this->get_parent_course_node()->get_item_obj();
        /** @var \Orm_Semester $semester */
        $semester = $this->get_system_obj()->get_item_obj();

        $background = '';
        if (file_exists(rtrim(FCPATH,'/').\Orm_Institution::get_instance()->get_fes_cover())) {
            $background = 'background: url('.base_url(\Orm_Institution::get_instance()->get_fes_cover()).') no-repeat fixed center top transparent; background-size: cover; ';
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

    }



}