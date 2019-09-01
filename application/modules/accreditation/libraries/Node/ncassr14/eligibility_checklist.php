<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of course_specifications_a
 *
 * @author laith
 */
class Eligibility_Checklist extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Eligibility for Program Accreditation Checklist';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_institution('');
            $this->set_date('');
            $this->set_info('');
            $this->set_program('');
            $this->set_checklist_table(array());
            $this->set_check_list_note('');
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

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'Check the criteria "Met" column to indicate that the requirement is met. ');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_program($value)
    {
        $property = new \Orm_Property_Text('program', $value);
        $property->set_description('program');
        $this->set_property($property);
    }

    public function get_program()
    {
        return $this->get_property('program')->get_value();
    }

    public function set_checklist_table($value)
    {

        $met = new \Orm_Property_Checkbox('met');
//
        $choices = new \Orm_Property_Select('choices');
        $choices->set_width(200);

        $choices->set_options(array('Y', 'N', 'P'));

        $help = new \Orm_Property_Fixedtext('help', 'Help');

        $property = new \Orm_Property_Table('checklist_table', $value);

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('header_1', 'Program Requirements'), 0, 2);
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('header_2', 'Met'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('header_3', 'Required Evidence'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('header_4', 'NCAAA Confirmed'));


        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('program_Autherized', '1. Program authorized'));
        $property->add_cell(2, 2, $help);
        $property->add_cell(2, 3, $met);
        $property->add_cell(2, 4, new \Orm_Property_Fixedtext('approval_socument', 'Approval document by the University Council/HC for Education or the MoHE'));
        $property->add_cell(2, 5, $choices);


        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('application_Accreditation', '2. Application for Accreditation approved'));
        $property->add_cell(3, 2, $help);
        $property->add_cell(3, 3, $met);
        $property->add_cell(3, 4, new \Orm_Property_Fixedtext('signed', 'Signed by Rector or Vice Rector/ Chair of Board of Trustees'));
        $property->add_cell(3, 5, $choices);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('program_specification', '3. Program Specifications using the NCAAA template (including program learning outcomes)'));
        $property->add_cell(4, 2, $help);
        $property->add_cell(4, 3, $met);
        $property->add_cell(4, 4, new \Orm_Property_Fixedtext('copy', 'Copy  (click T4)'));
        $property->add_cell(4, 5, $choices);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('course_specification', '4. Course Specifications and their Course Reports using the NCAAA templates'));
        $property->add_cell(5, 2, $help);
        $property->add_cell(5, 3, $met);
        $property->add_cell(5, 4, new \Orm_Property_Fixedtext('sample_copy', 'Sample copies (two courses from each semester)  (click T6)'));
        $property->add_cell(5, 5, $choices);

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('course_and_program_requirement', '5. Descriptions of course and program requirements and regulations'));
        $property->add_cell(6, 2, $help);
        $property->add_cell(6, 3, $met);
        $property->add_cell(6, 4, new \Orm_Property_Fixedtext('copies', 'Copies'));
        $property->add_cell(6, 5, $choices);

        $property->add_cell(7, 1, new \Orm_Property_Fixedtext('annual_programmatic', '6. Annual Program Report using the NCAAA template'));
        $property->add_cell(7, 2, $help);
        $property->add_cell(7, 3, $met);
        $property->add_cell(7, 4, new \Orm_Property_Fixedtext('report_copies', 'Copies of the last two reports (click T3)'));
        $property->add_cell(7, 5, $choices);

        $property->add_cell(8, 1, new \Orm_Property_Fixedtext('summery_Report', '7. Summary report of student evaluation survey results'));
        $property->add_cell(8, 2, $help);
        $property->add_cell(8, 3, $met);
        $property->add_cell(8, 4, new \Orm_Property_Fixedtext('report', 'Report about statistical analysis of the three questioners for the last 2 years'));
        $property->add_cell(8, 5, $choices);

        $property->add_cell(9, 1, new \Orm_Property_Fixedtext('alumni', '8. a. Alumni survey results <br/>b. Employer survey results'));
        $property->add_cell(9, 2, $help);
        $property->add_cell(9, 3, $met);
        $property->add_cell(9, 4, new \Orm_Property_Fixedtext('alumni_report', 'a. Alumni survey report with analysis <br/>b. Employer survey report with analysis'));
        $property->add_cell(9, 5, $choices);

        $property->add_cell(10, 1, new \Orm_Property_Fixedtext('program_committee', '9. Program Advisory Committee'));
        $property->add_cell(10, 2, $help);
        $property->add_cell(10, 3, $met);
        $property->add_cell(10, 4, new \Orm_Property_Fixedtext('committee_meeting', 'Sample of the committee meeting minutes and reports for the last two years'));
        $property->add_cell(10, 5, $choices);

        $property->add_cell(11, 1, new \Orm_Property_Fixedtext('program_kpi', '10. Program KPIs and benchmarks with analysis for each indicator'));
        $property->add_cell(11, 2, $help);
        $property->add_cell(11, 3, $met);
        $property->add_cell(11, 4, new \Orm_Property_Fixedtext('program_kpi_report', 'Reports on the results of KPI indicators, benchmarks, and analysis'));
        $property->add_cell(11, 5, $choices);

        $property->add_cell(12, 1, new \Orm_Property_Fixedtext('program_mapping', '11. Program learning outcome mapping'));
        $property->add_cell(12, 2, $help);
        $property->add_cell(12, 3, $met);
        $property->add_cell(12, 4, new \Orm_Property_Fixedtext('program_mapping_matrix', 'Mapping matrix of Program LOs with courses.'));
        $property->add_cell(12, 5, $choices);

        $property->add_cell(13, 1, new \Orm_Property_Fixedtext('ses', '12. Completed Self-Evaluation Scales'));
        $property->add_cell(13, 2, $help);
        $property->add_cell(13, 3, $met);
        $property->add_cell(13, 4, new \Orm_Property_Fixedtext('ses_program', 'Completed Program Self-Evaluation Scales Report (done within the last 12 months) (click D2.P)'));
        $property->add_cell(13, 5, $choices);

        $property->add_cell(14, 1, new \Orm_Property_Fixedtext('ssrp', '13. Initial Self-Study Report for the Program (SSRP)'));
        $property->add_cell(14, 2, $help);
        $property->add_cell(14, 3, $met);
        $property->add_cell(14, 4, new \Orm_Property_Fixedtext('ssrp_draft', 'Complete 1st draft of the SSRP (click T12)'));
        $property->add_cell(14, 5, $choices);

        $this->set_property($property);
    }

    public function get_checklist_table()
    {
        return $this->get_property('checklist_table')->get_value();
    }

    public function set_check_list_note()
    {
        $property = new \Orm_Property_Fixedtext('check_list_note', 'Y = Yes    N = No   P = Partial');
        $this->set_property($property);
    }

    public function get_check_list_note()
    {
        return $this->get_property('check_list_note')->get_value();
    }

    public function after_node_load()
    {
        parent::after_node_load();

        $this->set_institution(\Orm_Institution::get_university_name('english'));
        $this->set_date(date('Y-m-d', strtotime($this->get_date_added())));

        $program_node = $this->get_parent_program_node();
        if (!is_null($program_node) && $program_node->get_id()) {
            $program_obj = $program_node->get_item_obj();
            $this->set_program($program_obj->get_name('english'));
        }
    }

}
