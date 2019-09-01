<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncapm14;

/**
 * Description of Annual
 *
 * @author user
 */
class Annual extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $code = 'Program_Report';
    protected $name = 'Annual Program Report (APR)';
    protected $link_pdf = true;
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_send_to_review = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_institution('');
            $this->set_date_of_report('');
            $this->set_college('');
            $this->set_department('');
            $this->set_dean('');
            $this->set_branches(array());
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {


        $childrens = array();
        $childrens[] = new Annual_A();
        $childrens[] = new Annual_B();
        $childrens[] = new Annual_C();
        $childrens[] = new Annual_D();
        $childrens[] = new Annual_E();
        $childrens[] = new Annual_F();
        $childrens[] = new Annual_G();
        $childrens[] = new Annual_H();
        $childrens[] = new Annual_I();
        $childrens[] = new Annual_Signature();

        return $childrens;
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Program Eligibility: </strong> The program is to submit the two most recent APRs as part of the requirements for program eligibility using the NCAAA Template.<br/><br/>
        <strong> Post Accreditation: </strong> The program is required to annually complete an APR. The APR is to document a complete academic year.<br/><br/> APR’s are prepared by the program coordinator in consultation with faculty teaching in the program.  The reports are submitted to the head of department or college, and used as the basis for any modifications or changes in the program.  The APR information is used to provide a record of improvements in the program and is used in the Self Study Report for Programs (SSRP) and by external reviews for accreditation.<br/><br/><br/><strong> Annual Program Report </strong>');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

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

    public function set_dean($value)
    {
        $property = new \Orm_Property_Text('dean', $value);
        $property->set_description('3. Dean');
        $this->set_property($property);
    }

    public function get_dean()
    {
        return $this->get_property('dean')->get_value();
    }

    public function set_branches($value)
    {
        $property = new \Orm_Property_Table_Dynamic('branches', $value);
        $property->set_description('4. List All Campus Branch/Locations (approved by Ministry of Higher Education or Higher Council of Education)');

        $campus_branch_location = new \Orm_Property_Textarea('campus_branch_location');
        $campus_branch_location->set_description('Campus Branch/Location');
        $campus_branch_location->set_width(230);
        $campus_branch_location->set_enable_tinymce(0);
        $property->add_property($campus_branch_location);

        $approval_by = new \Orm_Property_Text('approval_by');
        $approval_by->set_description('Approval By');
        $approval_by->set_width(230);
        $property->add_property($approval_by);

        $date = new \Orm_Property_Text('date');
        $date->set_description('Date');
        $date->set_width(230);
        $property->add_property($date);

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
        if (file_exists(rtrim(FCPATH,'/').\Orm_Institution::get_instance()->get_pr_cover())) {
            $background = 'background: url('.base_url(\Orm_Institution::get_instance()->get_pr_cover()).') no-repeat fixed center top transparent; background-size: cover; ';
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
            /** @var \Orm_Program $program_obj */
            $program_obj = $program_node->get_item_obj();
            $department_obj = $program_obj->get_department_obj();
            $college_obj = $department_obj->get_college_obj();

            $this->set_college($college_obj->get_name('english') );
            $this->set_department( $department_obj->get_name('english'));

        }
    }

    public function header_actions(&$actions = array()) {

        if ($this->check_if_editable()) {
            $actions[] = array(
                'class' => 'btn',
                'title' => '<i class="fa fa-database"></i> ' . lang('Integration'),
                'extra' => 'onclick="integration(this, ' . $this->get_id() . ');" ' . data_loading_text(true) . ' title="Extraction of data from other modules"'
            );
        }

        return parent::header_actions($actions);
    }

    public function integration_processes() {
        parent::integration_processes();

        $program_node = $this->get_parent_program_node();
        if (!is_null($program_node) && $program_node->get_id()) {
            $program_obj = $program_node->get_item_obj(); /* @var $program_obj \Orm_Program */
            $department_obj = $program_obj->get_department_obj();
            $college_obj = $department_obj->get_college_obj();

            $campuses_obj = $college_obj->get_campuses();
            $campuses = $this->get_branches();
            if($campuses_obj) {
                $i = 0;
                foreach ($campuses_obj as $campus_obj) {
                    $campuses[$i] = array(
                        'campus_branch_location' => $campus_obj->get_name('english'),
                        'approval_by' => isset($campuses[$i]['approval_by']) ? $campuses[$i]['approval_by'] : '',
                        'date' => isset($campuses[$i]['date']) ? $campuses[$i]['date'] : ''
                    );
                    $i++;
                }
            }

            $this->set_branches($campuses);
            $this->save();
        }
    }

}
