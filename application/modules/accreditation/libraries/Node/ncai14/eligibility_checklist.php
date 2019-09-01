<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of eligibility_checklist
 *
 * @author ahmadgx
 */
class Eligibility_Checklist extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Eligibility for Institutional Accreditation Checklist';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_institution('');
            $this->set_date('');
            $this->set_info('');
            $this->set_checklist_table(array());
    }

    public function set_institution($value)
    {
        $property = new \Orm_Property_Text('institution', $value);
        $property->set_description('Name of Institution');
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

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'All eligibility criteria will need to be met before consideration can be given to accreditation.<br/>'
            . 'Tick the column beside each criterion to indicate if it is met or write in the next column the date by which that criterion will be met. (Must be no later than one month) ');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_checklist_table($value)
    {

        $met = new \Orm_Property_Checkbox('met');
        $confirmed = new \Orm_Property_text('confirmed');
        $confirmed->set_width(100);

        $property = new \Orm_Property_Table('checklist_table', $value);

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('header_1', 'Eligibility Check List'), 0, 2);
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('header_2', 'Criteria Met'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('header_3', 'Required Evidence'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('header_4', 'Confirmed (NCAAA)'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('first', '1.'));
        $property->add_cell(2, 2, new \Orm_Property_Fixedtext('final_license', 'Final license by approved government institution'));
        $property->add_cell(2, 3, $met);
        $property->add_cell(2, 4, new \Orm_Property_Fixedtext('copy', 'Copy'));
        $property->add_cell(2, 5, $confirmed);


        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('first', '2.'));
        $property->add_cell(3, 2, new \Orm_Property_Fixedtext('final_license', 'Activities consistent with license or approval'));
        $property->add_cell(3, 3, $met);
        $property->add_cell(3, 4, new \Orm_Property_Fixedtext('copy', 'Document/ Report to support consistency'));
        $property->add_cell(3, 5, $confirmed);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('first', '3.'));
        $property->add_cell(4, 2, new \Orm_Property_Fixedtext('final_license', 'Mission approved and consistent with license or approval'));
        $property->add_cell(4, 3, $met);
        $property->add_cell(4, 4, new \Orm_Property_Fixedtext('copy', 'Documents/Copy of the decision/ copy of the approved strategic plan.'));
        $property->add_cell(4, 5, $confirmed);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('first', '4.'));
        $property->add_cell(5, 2, new \Orm_Property_Fixedtext('final_license', 'Strategic and actual  plans,  including a plan for continuous quality  assurance'));
        $property->add_cell(5, 3, $met);
        $property->add_cell(5, 4, new \Orm_Property_Fixedtext('copy', 'A copy of the approved strategic plan.'));
        $property->add_cell(5, 5, $confirmed);

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('first', '5.'));
        $property->add_cell(6, 2, new \Orm_Property_Fixedtext('final_license', 'Availability of policies, regulations and terms of reference'));
        $property->add_cell(6, 3, $met);
        $property->add_cell(6, 4, new \Orm_Property_Fixedtext('copy', 'Copy'));
        $property->add_cell(6, 5, $confirmed);

        $property->add_cell(7, 1, new \Orm_Property_Fixedtext('first', '6.'));
        $property->add_cell(7, 2, new \Orm_Property_Fixedtext('final_license', 'Published guides or handbooks for students'));
        $property->add_cell(7, 3, $met);
        $property->add_cell(7, 4, new \Orm_Property_Fixedtext('copy', 'Copy'));
        $property->add_cell(7, 5, $confirmed);

        $property->add_cell(8, 1, new \Orm_Property_Fixedtext('first', '7.'));
        $property->add_cell(8, 2, new \Orm_Property_Fixedtext('final_license', 'Program specifications for all programs'));
        $property->add_cell(8, 3, $met);
        $property->add_cell(8, 4, new \Orm_Property_Fixedtext('copy', 'Copy of each'));
        $property->add_cell(8, 5, $confirmed);

        $property->add_cell(9, 1, new \Orm_Property_Fixedtext('first', '8.'));
        $property->add_cell(9, 2, new \Orm_Property_Fixedtext('final_license', 'Course specifications '));
        $property->add_cell(9, 3, $met);
        $property->add_cell(9, 4, new \Orm_Property_Fixedtext('copy', 'Sample (three courses from each level)'));
        $property->add_cell(9, 5, $confirmed);

        $property->add_cell(10, 1, new \Orm_Property_Fixedtext('first', '9.'));
        $property->add_cell(10, 2, new \Orm_Property_Fixedtext('final_license', 'Regulations and descriptions of processes for program approval, changes, and review'));
        $property->add_cell(10, 3, $met);
        $property->add_cell(10, 4, new \Orm_Property_Fixedtext('copy', 'A Copy of approved manual or documents'));
        $property->add_cell(10, 5, $confirmed);

        $property->add_cell(11, 1, new \Orm_Property_Fixedtext('first', '10.'));
        $property->add_cell(11, 2, new \Orm_Property_Fixedtext('final_license', 'Systems for monitoring quality and improving programs'));
        $property->add_cell(11, 3, $met);
        $property->add_cell(11, 4, new \Orm_Property_Fixedtext('copy', 'Guidebook for the internal quality system'));
        $property->add_cell(11, 5, $confirmed);

        $property->add_cell(12, 1, new \Orm_Property_Fixedtext('first', '11.'));
        $property->add_cell(12, 2, new \Orm_Property_Fixedtext('final_license', 'Central maintenance analysis and reporting of statistical data'));
        $property->add_cell(12, 3, $met);
        $property->add_cell(12, 4, new \Orm_Property_Fixedtext('copy', 'Evidence and reports about the analysis of results'));
        $property->add_cell(12, 5, $confirmed);

        $property->add_cell(13, 1, new \Orm_Property_Fixedtext('first', '12.'));
        $property->add_cell(13, 2, new \Orm_Property_Fixedtext('final_license', 'Student surveys'));
        $property->add_cell(13, 3, $met);
        $property->add_cell(13, 4, new \Orm_Property_Fixedtext('copy', 'Summary Reports'));
        $property->add_cell(13, 5, $confirmed);

        $property->add_cell(14, 1, new \Orm_Property_Fixedtext('first', '13.'));
        $property->add_cell(14, 2, new \Orm_Property_Fixedtext('final_license', 'Quality assurance system covering all standards'));
        $property->add_cell(14, 3, $met);
        $property->add_cell(14, 4, new \Orm_Property_Fixedtext('copy', 'Reports/ manual'));
        $property->add_cell(14, 5, $confirmed);

        $property->add_cell(15, 1, new \Orm_Property_Fixedtext('first', '14.'));
        $property->add_cell(15, 2, new \Orm_Property_Fixedtext('final_license', 'Data on Key Performance Indicators and benchmarks'));
        $property->add_cell(15, 3, $met);
        $property->add_cell(15, 4, new \Orm_Property_Fixedtext('copy', 'Reports'));
        $property->add_cell(15, 5, $confirmed);

        $property->add_cell(16, 1, new \Orm_Property_Fixedtext('first', '15.'));
        $property->add_cell(16, 2, new \Orm_Property_Fixedtext('final_license', 'Arrangements for comparative benchmarks'));
        $property->add_cell(16, 3, $met);
        $property->add_cell(16, 4, new \Orm_Property_Fixedtext('copy', 'Reports'));
        $property->add_cell(16, 5, $confirmed);

        $property->add_cell(17, 1, new \Orm_Property_Fixedtext('first', '16.'));
        $property->add_cell(17, 2, new \Orm_Property_Fixedtext('final_license', 'Systems for maintenance and provision of data, including research (if applicable)'));
        $property->add_cell(17, 3, $met);
        $property->add_cell(17, 4, new \Orm_Property_Fixedtext('copy', 'Reports'));
        $property->add_cell(17, 5, $confirmed);

        $property->add_cell(18, 1, new \Orm_Property_Fixedtext('first', '17.'));
        $property->add_cell(18, 2, new \Orm_Property_Fixedtext('final_license', 'Systems for maintenance of data on community service activities'));
        $property->add_cell(18, 3, $met);
        $property->add_cell(18, 4, new \Orm_Property_Fixedtext('copy', 'Reports'));
        $property->add_cell(18, 5, $confirmed);

        $property->add_cell(19, 1, new \Orm_Property_Fixedtext('first', '18.'));
        $property->add_cell(19, 2, new \Orm_Property_Fixedtext('final_license', 'Students graduated'));
        $property->add_cell(19, 3, $met);
        $property->add_cell(19, 4, new \Orm_Property_Fixedtext('copy', 'Alumni Guidebook or Graduation Data'));
        $property->add_cell(19, 5, $confirmed);

        $property->add_cell(20, 1, new \Orm_Property_Fixedtext('first', '19.'));
        $property->add_cell(20, 2, new \Orm_Property_Fixedtext('final_license', 'Compliance with standards for accreditation:  Self evaluation scales are complete and an initial  draft of the SSRI'));
        $property->add_cell(20, 3, $met);
        $property->add_cell(20, 4, new \Orm_Property_Fixedtext('copy', 'Completed self-evaluation scales report and the first draft of the SSRI'));
        $property->add_cell(20, 5, $confirmed);


        $this->set_property($property);
    }

    public function get_checklist_table()
    {
        return $this->get_property('checklist_table')->get_value();
    }

}
