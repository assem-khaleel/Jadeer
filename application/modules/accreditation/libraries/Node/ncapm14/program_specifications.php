<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncapm14;
use Node\ncai14\Ssri_Signatures;

/**
 * Description of program_specifications
 *
 * @author ahmadgx
 */
class Program_Specifications extends \Orm_Node
{

    protected $class_type = __class__;
    protected $code = 'Program_Specification';
    protected $name = 'Program Specifications (PS)';
    protected $link_pdf = true;
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_send_to_review = true;

    function init()
    {
        parent::init();

            $this->set_program_specifications();
            $this->set_institution('');
            $this->set_date_of_report('');
            $this->set_college('');
            $this->set_department('');
            $this->set_dean('');
            $this->set_program_flowchart('');
            $this->set_branches(array());
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {
        $childrens = array();
        $childrens[] = new Program_Specifications_A();
        $childrens[] = new Program_Specifications_B();
        $childrens[] = new Program_Specifications_C();
        $childrens[] = new Program_Specifications_D();
        $childrens[] = new Program_Specifications_E();
        $childrens[] = new Program_Specifications_F();
        $childrens[] = new Program_Specifications_G();
        $childrens[] = new Program_Specifications_H();
        $childrens[] = new Program_Specifications_I();
        $childrens[] = new Ssri_Signatures();

        return $childrens;
    }

    /*
     * introduction
     */

    public function set_program_specifications()
    {
        $property = new \Orm_Property_Fixedtext('program_specifications', '<i>For guidance on the completion of this template, please refer to  Chapter 2,  of Part 2 of  Handbook 2 Internal Quality Assurance Arrangement and to the Guidelines on Using the Template for a Program Specification in Attachment 2 (b).</i>');
        $this->set_property($property);
    }

    public function get_program_specifications()
    {
        return $this->get_property('program_specifications')->get_value();
    }

    /*
     * Institution
     */

    public function set_institution($value)
    {
        $property = new \Orm_Property_Text('institution', $value);
        $property->set_description('1. Institution');
        $this->set_property($property);
    }

    public function get_institution()
    {
        return $this->get_property('institution')->get_value();
    }

    /*
     * Date of Report
     */

    public function set_date_of_report($value)
    {
        $property = new \Orm_Property_Text('date_of_report', $value);
        $property->set_description('Date');
        $this->set_property($property);
    }

    public function get_date_of_report()
    {
        return $this->get_property('date_of_report')->get_value();
    }

    /*
     * college/department
     */

    public function set_college($value)
    {
        $property = new \Orm_Property_Text('college', $value);
        $property->set_description('2. College');
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

    /*
     * dean
     */

    public function set_dean($value)
    {
        $property = new \Orm_Property_Text('dean', $value);
        $property->set_description('3. Dean/Department Head');
        $this->set_property($property);
    }

    public function get_dean()
    {
        return $this->get_property('dean')->get_value();
    }

    /*
     * program flowchart
     */

    public function set_program_flowchart($value)
    {
        $property = new \Orm_Property_Textarea('program_flowchart', $value);
        $property->set_description('4. Insert program and college administrative flowchart');
        $this->set_property($property);
    }

    public function get_program_flowchart()
    {
        return $this->get_property('program_flowchart')->get_value();
    }

    /*
     * branches
     */

    public function set_branches($value)
    {
        $property = new \Orm_Property_Add_More('branches', $value);
        $property->set_description('5. List all branches/locations offering this program');

        $branch = new \Orm_Property_Text('branch');
        $branch->set_description('Branch/Location');
        $property->add_property($branch);

        $this->set_property($property);
    }

    public function get_branches()
    {
        return $this->get_property('branches')->get_value();
    }

    public function get_pdf_cover() {

        /** @var \Orm_Program $program */
        $program = $this->get_parent_program_node()->get_item_obj();
        /** @var \Orm_Semester $semester */
        $semester = $this->get_system_obj()->get_item_obj();

        $background = '';
        if (file_exists(rtrim(FCPATH,'/').\Orm_Institution::get_instance()->get_ps_cover())) {
            $background = 'background: url('.base_url(\Orm_Institution::get_instance()->get_ps_cover()).') no-repeat fixed center top transparent; background-size: cover; ';
        }

        $cover = '<html>';
        $cover .= '<head>';
        $cover .= '<meta charset="utf-8">';
        $cover .= '</head>';
        $cover .= '<body style="'.$background.'padding-top:600px;">';
        $cover .= '<div style="padding:20px 0; display:block; position: relative; overflow: auto; text-align: center; font-family: \'Open Sans\', sans-serif; font-weight:bold; font-size: 18pt; color: #02577e; background-color: rgba(255,255,255,0.5);">';
        $cover .= $program->get_code('english') .' '. $program->get_name('english').'<br>';
        $cover .= 'Academic Year ('.$semester->get_year().')<br>';
        $cover .= $program->get_department_obj()->get_name('english') .'<br>';
        $cover .= $program->get_department_obj()->get_college_obj()->get_name('english') .'<br>';
        $cover .= '</div>';
        $cover .= '</body>';
        $cover .= '</html>';

        return $cover;
    }

    public function after_node_load()
    {
        parent::after_node_load();

        $this->set_institution(\Orm_Institution::get_university_name('english'));
        $this->set_date_of_report(date('Y-m-d', strtotime($this->get_date_added())));

        $program_node = $this->get_parent_program_node();
        if (!is_null($program_node) && $program_node->get_id()) {
            $program_obj = $program_node->get_item_obj();
            $department_obj = $program_obj->get_department_obj();
            $college_obj = $department_obj->get_college_obj();

            $this->set_college($college_obj->get_name('english'));
            $this->set_department( $department_obj->get_name('english'));
        }
    }

}
