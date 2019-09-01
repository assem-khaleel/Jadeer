<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncapm14;

/**
 * Description of program_specifications_a
 *
 * @author ahmadgx
 */
class Program_Specifications_A extends \Orm_Node
{

    protected $class_type = __class__;
    protected $name = 'A. Program Identification and General Information';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_program_title('');
            $this->set_program_code('');
            $this->set_total_credit_hour('');
            $this->set_program_completion('');
            $this->set_tracks_and_pathway('');
            $this->set_exit_point('');
            $this->set_professional_occupations('');
            $this->set_new_program('');
            $this->set_planned_starting_date('');
            $this->set_continuing_program('');
            $this->set_program_review('');
            $this->set_note('');
            $this->set_accreditation_review('');
            $this->set_other('');
            $this->set_program_coordinator('');
            $this->set_approval_date(array());
    }

    /*
     * program title
     */

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

    /*
     * program code
     */

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

    /*
     * total credit hour
     */

    public function set_total_credit_hour($value)
    {
        $property = new \Orm_Property_Text('total_credit_hour', $value);
        $property->set_description('2. Total credit hours needed for completion of the program');
        $this->set_property($property);
    }

    public function get_total_credit_hour()
    {
        return $this->get_property('total_credit_hour')->get_value();
    }

    /*
     * program completion
     */

    public function set_program_completion($value)
    {
        $property = new \Orm_Property_Text('program_completion', $value);
        $property->set_description('3. Award granted on completion of the program');
        $this->set_property($property);
    }

    public function get_program_completion()
    {
        return $this->get_property('program_completion')->get_value();
    }

    /*
     * tracks and pathway
     */

    public function set_tracks_and_pathway($value)
    {
        $property = new \Orm_Property_Textarea('tracks_and_pathway', $value);
        $property->set_description('4. Major tracks/pathways or specializations within the program (eg. transportation or structural engineering within a civil engineering program or counselling or school psychology within a psychology program)');
        $this->set_property($property);
    }

    public function get_tracks_and_pathway()
    {
        return $this->get_property('tracks_and_pathway')->get_value();
    }

    /*
     * exit point
     */

    public function set_exit_point($value)
    {
        $property = new \Orm_Property_Text('exit_point', $value);
        $property->set_description('5. Intermediate Exit Points and Awards (if any) (eg. associate degree within a bachelor degree program)');
        $this->set_property($property);
    }

    public function get_exit_point()
    {
        return $this->get_property('exit_point')->get_value();
    }

    /*
     *  Professional occupations
     */

    public function set_professional_occupations($value)
    {
        $property = new \Orm_Property_Textarea('professional_occupations', $value);
        $property->set_description('6. Professional occupations (licensed occupations, if any) for which graduates are prepared. (If there is an early exit point from the program (eg. diploma or associate degree) include professions  or occupations at each exit point)');
        $this->set_property($property);
    }

    public function get_professional_occupations()
    {
        return $this->get_property('professional_occupations')->get_value();
    }

    /*
     * program
     */

    public function set_new_program($value)
    {
        $property = new \Orm_Property_Radio('new_program', $value);
        $property->set_description('7. (a) New Program');
        $property->set_options(array('Yes', 'No'));
        $this->set_property($property);
    }

    public function get_new_program()
    {
        return $this->get_property('new_program')->get_value();
    }

    /*
     * planned starting date
     */

    public function set_planned_starting_date($value)
    {
        $property = new \Orm_Property_Text('planned_starting_date', $value);
        $property->set_description('Planned starting date');
        $this->set_property($property);
    }

    public function get_planned_starting_date()
    {
        return $this->get_property('planned_starting_date')->get_value();
    }

    /*
     * Continuing Program 
     */

    public function set_continuing_program($value)
    {
        $property = new \Orm_Property_Radio('continuing_program', $value);
        $property->set_description('(b) Continuing Program');
        $property->set_options(array('Yes', 'No'));
        $this->set_property($property);
    }

    public function get_continuing_program()
    {
        return $this->get_property('continuing_program')->get_value();
    }

    /*
     * program review
     */

    public function set_program_review($value)
    {
        $property = new \Orm_Property_Text('program_review', $value);
        $property->set_description('Year of most recent major program review');
        $this->set_property($property);
    }

    public function get_program_review()
    {
        return $this->get_property('program_review')->get_value();
    }

    public function set_note($value)
    {
        $property = new \Orm_Property_Text('note', $value);
        $property->set_description('Organization involved in recent major review (eg. internal within the institution),');
        $this->set_property($property);
    }

    public function get_note()
    {
        return $this->get_property('note')->get_value();
    }

    public function set_accreditation_review($value)
    {
        $property = new \Orm_Property_Text('accreditation_review', $value);
        $property->set_description('Accreditation review by');
        $this->set_property($property);
    }

    public function get_accreditation_review()
    {
        return $this->get_property('accreditation_review')->get_value();
    }

    public function set_other($value)
    {
        $property = new \Orm_Property_Text('other', $value);
        $property->set_description('Other');
        $this->set_property($property);
    }

    public function get_other()
    {
        return $this->get_property('other')->get_value();
    }

    /*
     * program coordinator
     */

    public function set_program_coordinator($value)
    {
        $property = new \Orm_Property_Text('program_coordinator', $value);
        $property->set_description('8. Name of program chair or coordinator.  If a program chair or coordinator has been appointed for the female section as well as the male section, include names of both');
        $this->set_property($property);
    }

    public function get_program_coordinator()
    {
        return $this->get_property('program_coordinator')->get_value();
    }

    /*
     * approval date
     */

    public function set_approval_date($value)
    {

        $property = new \Orm_Property_Table_Dynamic('approval_date', $value);
        $property->set_description('9. Date of approval by the authorized body (by MoE).');

        $campus_branch_location = new \Orm_Property_Textarea('campus_branch_location');
        $campus_branch_location->set_description('Campus Branch/Location');
        $campus_branch_location->set_width(290);
        $campus_branch_location->set_enable_tinymce(0);
        $property->add_property($campus_branch_location);

        $approval_by = new \Orm_Property_Text('approval_by');
        $approval_by->set_description('Approval By');
        $approval_by->set_width(200);
        $property->add_property($approval_by);

        $date = new \Orm_Property_Text('date');
        $date->set_description('Date');
        $date->set_width(200);
        $property->add_property($date);


        $this->set_property($property);
    }

    public function get_approval_date()
    {
        return $this->get_property('distribution_of_grades')->get_value();
    }

    public function after_node_load()
    {
        parent::after_node_load();

        $program_node = $this->get_parent_program_node();
        if (!is_null($program_node) && $program_node->get_id()) {
            /** @var \Orm_Program $program_obj */
            $program_obj = $program_node->get_item_obj();

            $this->set_program_title($program_obj->get_name('english'));
            $this->set_program_code($program_obj->get_number('english'));
            $this->set_total_credit_hour($program_obj->get_credit_hours());
        }
    }

    public function header_actions(&$actions = array()) {

        if ($this->check_if_editable()) {
            if(\License::get_instance()->check_module('kpi')) {
                $actions[] = array(
                    'class' => 'btn',
                    'title' => '<i class="fa fa-database"></i> ' . lang('Integration'),
                    'extra' => 'onclick="integration(this, ' . $this->get_id() . ');" ' . data_loading_text(true) . ' title="Extraction of data from other modules"'
                );
            }
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

            $majors = '';
            foreach($program_obj->get_majors() as $major) {
                $majors .= '<li>'.$major->get_name('english').'</li>';
            }
            if($majors) {
                $this->set_tracks_and_pathway('<ul>'.$majors.'</ul>');
            }

            $campuses_obj = $college_obj->get_campuses();
            $campuses = $this->get_approval_date();
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
            $this->set_approval_date($campuses);
        }

        $this->save();
    }

}
