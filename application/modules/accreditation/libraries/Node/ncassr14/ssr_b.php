<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ssr_b
 *
 * @author duaa
 */
class Ssr_B extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'B. General Program Profile Information';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_program_title('');
            $this->set_program_code('');
            $this->set_credit_hours('');
            $this->set_award('');
            $this->set_major_tracks('');
            $this->set_professional_occupations('');
            $this->set_name_of_program_chair('');
            $this->set_branches('');
            $this->set_date_of_approval_of_program('');
            $this->set_date_of_approval_authorized('');
            $this->set_date_of_most_recent('');
            $this->set_provide_institutional('');
            $this->set_note('');
    }

    public function set_program_title($value)
    {
        $property = new \Orm_Property_Text('program_title', $value);
        $property->set_description('1. Program title');
        $this->set_property($property);
    }

    public function get_program_title()
    {
        return $this->get_property('program_title')->get_value();
    }

    public function set_program_code($value)
    {
        $property = new \Orm_Property_Text('program_code', $value);
        $property->set_description('Program code');
        $this->set_property($property);
    }

    public function get_program_code()
    {
        return $this->get_property('program_code')->get_value();
    }

    public function set_credit_hours($value)
    {
        $property = new \Orm_Property_Text('credit_hours', $value);
        $property->set_description('2. Credit hours required for completion of the program');
        $this->set_property($property);
    }

    public function get_credit_hours()
    {
        return $this->get_property('credit_hours')->get_value();
    }

    public function set_award($value)
    {
        $property = new \Orm_Property_Text('award', $value);
        $property->set_description('3. Award(s) granted on completion of the program(for community college programs, add degree granting policy)');
        $this->set_property($property);
    }

    public function get_award()
    {
        return $this->get_property('award')->get_value();
    }

    public function set_major_tracks($value)
    {
        $property = new \Orm_Property_Textarea('major_tracks', $value);
        $property->set_enable_tinymce(true);
        $property->set_description('4. Major tracks or pathways within the program');
        $this->set_property($property);
    }

    public function get_major_tracks()
    {
        return $this->get_property('major_tracks')->get_value();
    }

    public function set_professional_occupations($value)
    {
        $property = new \Orm_Property_Textarea('professional_occupations', $value);
        $property->set_description('5. Professional occupations(licensed occupations,if any)for which graduates are prepared');
        $this->set_property($property);
    }

    public function get_professional_occupations()
    {
        return $this->get_property('professional_occupations')->get_value();
    }

    public function set_name_of_program_chair($value)
    {
        $property = new \Orm_Property_Text('name_of_program_chair', $value);
        $property->set_description('6. Name of program chair/ coordinator.If a program coordinator or manager has been appointed for the female section as well as the male section,include names of both');
        $this->set_property($property);
    }

    public function get_name_of_program_chair()
    {
        return $this->get_property('name_of_program_chair')->get_value();
    }

    public function set_branches($value)
    {
        $property = new \Orm_Property_Textarea('branches', $value);
        $property->set_description('7. Branches/locations of the program.If offered on several campuses or by distance education as well as on-campus, including details');
        $this->set_property($property);
    }

    public function get_branches()
    {
        return $this->get_property('branches')->get_value();
    }

    public function set_date_of_approval_of_program($value)
    {
        $property = new \Orm_Property_Text('date_of_approval_of_program', $value);
        $property->set_description('8. Date of approval of program specification within the institution');
        $this->set_property($property);
    }

    public function get_date_of_approval_of_program()
    {
        return $this->get_property('date_of_approval_of_program')->get_value();
    }

    public function set_date_of_approval_authorized($value)
    {
        $property = new \Orm_Property_Text('date_of_approval_authorized', $value);
        $property->set_description('9. Date of approval by the authorized body (Ministry of Education “MOE” for private institutions) and Council of Higher Education for public institutions).');
        $this->set_property($property);
    }

    public function get_date_of_approval_authorized()
    {
        return $this->get_property('date_of_approval_authorized')->get_value();
    }

    public function set_date_of_most_recent($value)
    {
        $property = new \Orm_Property_Text('date_of_most_recent', $value);
        $property->set_description('10. Date of most recent self-study(if any)');
        $this->set_property($property);
    }

    public function get_date_of_most_recent()
    {
        return $this->get_property('date_of_most_recent')->get_value();
    }

    public function set_provide_institutional($value)
    {
        $property = new \Orm_Property_Textarea('provide_institutional', $value);
        $property->set_description('11. Provide Institutional and Program level administrative flowcharts');
        $this->set_property($property);
    }

    public function get_provide_institutional()
    {
        return $this->get_property('provide_institutional')->get_value();
    }

    public function set_note($value)
    {
        $property = new \Orm_Property_Fixedtext('note', $value);
        $property->set_description('Note that a number of other documents giving general information about the program should be provided in addition to the program report.See list at the end of this template');
        $this->set_property($property);
    }

    public function get_note()
    {
        return $this->get_property('note')->get_value();
    }

    public function after_node_load()
    {
        parent::after_node_load();

        $program_node = $this->get_parent_program_node();
        if (!is_null($program_node) && $program_node->get_id()) {
            $program_obj = $program_node->get_item_obj();/** @var \Orm_Program $program_obj */
            $this->set_program_title($program_obj->get_name('english'));
            $this->set_program_code($program_obj->get_number('english'));
            $this->set_credit_hours($program_obj->get_credit_hours());
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
            $campuses = $college_obj->get_campuses();

            $majors = '';
            foreach($program_obj->get_majors() as $major) {
                $majors .= '<li>'.$major->get_name('english').'</li>';
            }
            
            if($majors) {
                $this->set_major_tracks('<ul>'.$majors.'</ul>');
            }

            if($campuses) {
                $html = '<ul>';
                foreach ($campuses as $campus_obj) {
                    $html .= '<li>'.$campus_obj->get_name('english').'</li>';
                }
                $html .= '</ul>';
                $this->set_branches($html);
            }
        }
        $this->save();
    }
}