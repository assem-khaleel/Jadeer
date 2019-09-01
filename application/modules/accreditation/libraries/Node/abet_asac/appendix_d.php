<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\abet_asac;

/**
 * Description of appendix_d
 *
 * @author ahmadgx
 */
class Appendix_D extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Appendix D – Institutional Summary';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;
    protected $orientation = 'landscape';

    public function init()
    {
        parent::init();

            $this->set_note('');
            $this->set_institution('');
            $this->set_institution_name('');
            $this->set_institution_address('');
            $this->set_chief_name('');
            $this->set_self_study_report('');
            $this->set_organizations('');
            $this->set_type_of_control('');
            $this->set_type_of_control_description('');
            $this->set_educational_unit('');
            $this->set_educational_unit_description('');
            $this->set_academic_support('');
            $this->set_academic_support_units('');
            $this->set_nonacademic_support('');
            $this->set_nonacademic_support_units('');
            $this->set_credit_unit();
            $this->set_credit_unit_description('');
            $this->set_tables('');
            $this->set_program('');
            $this->set_program_enrollment(array());
            $this->set_program_enrollment_note('');
            $this->set_program_name('');
            $this->set_new_year('');
            $this->set_presonnel(array());
            $this->set_presonnel_note('');
    }

    public function set_note()
    {
        $property = new \Orm_Property_Fixedtext('note', 'Programs are requested to provide the following information.');
        $this->set_property($property);
    }

    public function get_note()
    {
        $this->get_property('note')->get_value();
    }

    public function set_institution()
    {
        $property = new \Orm_Property_Fixedtext('institution', '<strong>1. The Institution</strong>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_institution()
    {
        $this->get_property('institution')->get_value();
    }

    public function set_institution_name($value)
    {
        $property = new \Orm_Property_Text('institution_name', $value);
        $property->set_description('a. Name of the institution');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_institution_name()
    {
        $this->get_property('institution_name')->get_value();
    }

    public function set_institution_address($value)
    {
        $property = new \Orm_Property_Text('institution_address', $value);
        $property->set_description('address of the institution');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_institution_address()
    {
        $this->get_property('institution_address')->get_value();
    }

    public function set_chief_name($value)
    {
        $property = new \Orm_Property_Text('chief_name', $value);
        $property->set_description('b. Name and title of the chief executive officer of the institution');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_chief_name()
    {
        $this->get_property('chief_name')->get_value();
    }

    public function set_self_study_report($value)
    {
        $property = new \Orm_Property_Text('self_study_report', $value);
        $property->set_description('c. Name and title of the person submitting the Self-Study Report.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_self_study_report()
    {
        $this->get_property('self_study_report')->get_value();
    }

    public function set_organizations($value)
    {
        $property = new \Orm_Property_Textarea('organizations', $value);
        $property->set_description('d. Name the organizations by which the institution is now accredited, and the dates of the initial and most recent accreditation evaluations.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_organizations()
    {
        $this->get_property('organizations')->get_value();
    }

    public function set_type_of_control()
    {
        $property = new \Orm_Property_Fixedtext('type_of_control', '<strong>2. Type of Control</strong>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_type_of_control()
    {
        $this->get_property('type_of_control')->get_value();
    }

    public function set_type_of_control_description($value)
    {
        $property = new \Orm_Property_Textarea('type_of_control_description', $value);
        $property->set_description('Description of the type of managerial control of the institution, e.g., private-non-profit, private-other, denominational, state, federal, public-other, etc.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_type_of_control_description()
    {
        $this->get_property('type_of_control_description')->get_value();
    }

    public function set_educational_unit()
    {
        $property = new \Orm_Property_Fixedtext('educational_unit', '<strong>3. Educational Unit</strong>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_educational_unit()
    {
        $this->get_property('educational_unit')->get_value();
    }

    public function set_educational_unit_description($value)
    {
        $property = new \Orm_Property_Textarea('educational_unit_description', $value);
        $property->set_description('Describe the educational unit in which the program is located including the administrative chain of responsibility from the individual responsible for the program to the chief executive officer of the institution.  Include names and titles.  An organization chart may be included.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_educational_unit_description()
    {
        $this->get_property('educational_unit_description')->get_value();
    }

    public function set_academic_support()
    {
        $property = new \Orm_Property_Fixedtext('academic_support', '<strong>4. Academic Support Units</strong>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_academic_support()
    {
        $this->get_property('academic_support')->get_value();
    }

    public function set_academic_support_units($value)
    {
        $property = new \Orm_Property_Textarea('academic_support_units', $value);
        $property->set_description('List the names and titles of the individuals responsible for each of the units that teach courses required by the program being evaluated, e.g., mathematics, physics, etc.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_academic_support_units()
    {
        $this->get_property('academic_support_units')->get_value();
    }

    public function set_nonacademic_support()
    {
        $property = new \Orm_Property_Fixedtext('nonacademic_support', '<strong>5. Non-academic Support Units</strong>');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_nonacademic_support()
    {
        $this->get_property('nonacademic_support')->get_value();
    }

    public function set_nonacademic_support_units($value)
    {
        $property = new \Orm_Property_Textarea('nonacademic_support_units', $value);
        $property->set_description('List the names and titles of the individuals responsible for each of the units that provide non-academic support to the program being evaluated, e.g., library, computing facilities, placement, tutoring, etc.  ');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_nonacademic_support_units()
    {
        $this->get_property('nonacademic_support_units')->get_value();
    }

    public function set_credit_unit()
    {
        $property = new \Orm_Property_Fixedtext('credit_unit', '<strong>6. Credit Unit</strong>');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_credit_unit()
    {
        $this->get_property('credit_unit')->get_value();
    }

    public function set_credit_unit_description($value)
    {
        $property = new \Orm_Property_Textarea('credit_unit_description', $value);
        $property->set_description('It is assumed that one semester or quarter credit normally represents one class hour or three laboratory hours per week.  One academic year normally represents at least 28 weeks of classes,exclusive of final examinations.  If other standards are used for this program, the differences should be indicated.');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_credit_unit_description()
    {
        $this->get_property('credit_unit_description')->get_value();
    }

    public function set_tables()
    {
        $property = new \Orm_Property_Fixedtext('tables', '<strong>7. Tables</strong> <br/>Complete the following tables for the program undergoing evaluation.');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_tables()
    {
        $this->get_property('tables')->get_value();
    }

    public function set_program($value)
    {
        $property = new \Orm_Property_Text('program', $value);
        $property->set_description('Program Name');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_program()
    {
        return $this->get_property('program')->get_value();
    }

    public function set_program_enrollment($value)
    {
        $fulltime = new \Orm_Property_Fixedtext('fulltime', 'FT');
        $parttime = new \Orm_Property_Fixedtext('parttime', 'PT');
        $academic_year = new \Orm_Property_Text('academic_year');
        $academic_year->set_width(200);
        $first_year = new \Orm_Property_Text('first_year');
        $first_year->set_width(200);
        $second_year = new \Orm_Property_Text('second_year');
        $second_year->set_width(200);
        $third_year = new \Orm_Property_Text('third_year');
        $third_year->set_width(200);
        $fourth_year = new \Orm_Property_Text('fourth_year');
        $fourth_year->set_width(200);
        $fifth_year = new \Orm_Property_Text('fifth_year');
        $fifth_year->set_width(200);
        $under_graduate = new \Orm_Property_Text('under_graduate');
        $under_graduate->set_width(200);
        $total_grad = new \Orm_Property_Text('total_grad');
        $total_grad->set_width(200);
        $associates_awarded = new \Orm_Property_Text('associates_awarded');
        $associates_awarded->set_width(200);
        $bachelors_awarded = new \Orm_Property_Text('bachelors_awarded');
        $bachelors_awarded->set_width(200);
        $master_awarded = new \Orm_Property_Text('master_awarded');
        $master_awarded->set_width(200);
        $doctorates_awarded = new \Orm_Property_Text('doctorates_awarded');
        $doctorates_awarded->set_width(200);

        $property = new \Orm_Property_Table('program_enrollment', $value);
        $property->set_description('Table D-1.  Program Enrollment and Degree Data');
        $property->set_group('group_7');
        $property->set_is_responsive(true);

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('empty', ''), 2, 0);
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('academic_year', 'Academic Year'), 2, 2);
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('enrollment_year', 'Enrollment Year'), 0, 5);
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('undergraduate_total', 'Total Undergrad'), 2, 0);
        $property->add_cell(1, 5, new \Orm_Property_Fixedtext('grad_total', 'Total Grad'), 2, 0);
        $property->add_cell(1, 6, new \Orm_Property_Fixedtext('degree_awarded', 'Degrees Awarded'), 0, 4);

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('first', '1st'));
        $property->add_cell(2, 2, new \Orm_Property_Fixedtext('second', '2nd'));
        $property->add_cell(2, 3, new \Orm_Property_Fixedtext('third', '3rd'));
        $property->add_cell(2, 4, new \Orm_Property_Fixedtext('fourth', '4th'));
        $property->add_cell(2, 5, new \Orm_Property_Fixedtext('fifth', '5th'));
        $property->add_cell(2, 6, new \Orm_Property_Fixedtext('associates', 'Associates'));
        $property->add_cell(2, 7, new \Orm_Property_Fixedtext('bachelors', 'Bachelors'));
        $property->add_cell(2, 8, new \Orm_Property_Fixedtext('masters', 'Masters'));
        $property->add_cell(2, 9, new \Orm_Property_Fixedtext('doctorates', 'Doctorates'));

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('current', 'Current Year'), 2, 0);
        $property->add_cell(3, 2, $academic_year, 2, 0);
        $property->add_cell(3, 3, $fulltime);
        $property->add_cell(3, 4, $first_year);
        $property->add_cell(3, 5, $second_year);
        $property->add_cell(3, 6, $third_year);
        $property->add_cell(3, 7, $fourth_year);
        $property->add_cell(3, 8, $fifth_year);
        $property->add_cell(3, 9, $under_graduate);
        $property->add_cell(3, 10, $total_grad);
        $property->add_cell(3, 11, $associates_awarded);
        $property->add_cell(3, 12, $bachelors_awarded);
        $property->add_cell(3, 13, $master_awarded);
        $property->add_cell(3, 14, $doctorates_awarded);

        $property->add_cell(4, 1, $parttime);
        $property->add_cell(4, 2, $first_year);
        $property->add_cell(4, 3, $second_year);
        $property->add_cell(4, 4, $third_year);
        $property->add_cell(4, 5, $fourth_year);
        $property->add_cell(4, 6, $fifth_year);
        $property->add_cell(4, 7, $under_graduate);
        $property->add_cell(4, 8, $total_grad);
        $property->add_cell(4, 9, $associates_awarded);
        $property->add_cell(4, 10, $bachelors_awarded);
        $property->add_cell(4, 11, $master_awarded);
        $property->add_cell(4, 12, $doctorates_awarded);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('current', '1'), 2, 0);
        $property->add_cell(5, 2, $academic_year, 2, 0);
        $property->add_cell(5, 3, $fulltime);
        $property->add_cell(5, 4, $first_year);
        $property->add_cell(5, 5, $second_year);
        $property->add_cell(5, 6, $third_year);
        $property->add_cell(5, 7, $fourth_year);
        $property->add_cell(5, 8, $fifth_year);
        $property->add_cell(5, 9, $under_graduate);
        $property->add_cell(5, 10, $total_grad);
        $property->add_cell(5, 11, $associates_awarded);
        $property->add_cell(5, 12, $bachelors_awarded);
        $property->add_cell(5, 13, $master_awarded);
        $property->add_cell(5, 14, $doctorates_awarded);

        $property->add_cell(6, 1, $parttime);
        $property->add_cell(6, 2, $first_year);
        $property->add_cell(6, 3, $second_year);
        $property->add_cell(6, 4, $third_year);
        $property->add_cell(6, 5, $fourth_year);
        $property->add_cell(6, 6, $fifth_year);
        $property->add_cell(6, 7, $under_graduate);
        $property->add_cell(6, 8, $total_grad);
        $property->add_cell(6, 9, $associates_awarded);
        $property->add_cell(6, 10, $bachelors_awarded);
        $property->add_cell(6, 11, $master_awarded);
        $property->add_cell(6, 12, $doctorates_awarded);

        $property->add_cell(7, 1, new \Orm_Property_Fixedtext('current', '2'), 2, 0);
        $property->add_cell(7, 2, $academic_year, 2, 0);
        $property->add_cell(7, 3, $fulltime);
        $property->add_cell(7, 4, $first_year);
        $property->add_cell(7, 5, $second_year);
        $property->add_cell(7, 6, $third_year);
        $property->add_cell(7, 7, $fourth_year);
        $property->add_cell(7, 8, $fifth_year);
        $property->add_cell(7, 9, $under_graduate);
        $property->add_cell(7, 10, $total_grad);
        $property->add_cell(7, 11, $associates_awarded);
        $property->add_cell(7, 12, $bachelors_awarded);
        $property->add_cell(7, 13, $master_awarded);
        $property->add_cell(7, 14, $doctorates_awarded);

        $property->add_cell(8, 1, $parttime);
        $property->add_cell(8, 2, $first_year);
        $property->add_cell(8, 3, $second_year);
        $property->add_cell(8, 4, $third_year);
        $property->add_cell(8, 5, $fourth_year);
        $property->add_cell(8, 6, $fifth_year);
        $property->add_cell(8, 7, $under_graduate);
        $property->add_cell(8, 8, $total_grad);
        $property->add_cell(8, 9, $associates_awarded);
        $property->add_cell(8, 10, $bachelors_awarded);
        $property->add_cell(8, 11, $master_awarded);
        $property->add_cell(8, 12, $doctorates_awarded);

        $property->add_cell(9, 1, new \Orm_Property_Fixedtext('current', '3'), 2, 0);
        $property->add_cell(9, 2, $academic_year, 2, 0);
        $property->add_cell(9, 3, $fulltime);
        $property->add_cell(9, 4, $first_year);
        $property->add_cell(9, 5, $second_year);
        $property->add_cell(9, 6, $third_year);
        $property->add_cell(9, 7, $fourth_year);
        $property->add_cell(9, 8, $fifth_year);
        $property->add_cell(9, 9, $under_graduate);
        $property->add_cell(9, 10, $total_grad);
        $property->add_cell(9, 11, $associates_awarded);
        $property->add_cell(9, 12, $bachelors_awarded);
        $property->add_cell(9, 13, $master_awarded);
        $property->add_cell(9, 14, $doctorates_awarded);

        $property->add_cell(10, 1, $parttime);
        $property->add_cell(10, 2, $first_year);
        $property->add_cell(10, 3, $second_year);
        $property->add_cell(10, 4, $third_year);
        $property->add_cell(10, 5, $fourth_year);
        $property->add_cell(10, 6, $fifth_year);
        $property->add_cell(10, 7, $under_graduate);
        $property->add_cell(10, 8, $total_grad);
        $property->add_cell(10, 9, $associates_awarded);
        $property->add_cell(10, 10, $bachelors_awarded);
        $property->add_cell(10, 11, $master_awarded);
        $property->add_cell(10, 12, $doctorates_awarded);


        $property->add_cell(11, 1, new \Orm_Property_Fixedtext('current', '4'), 2, 0);
        $property->add_cell(11, 2, $academic_year, 2, 0);
        $property->add_cell(11, 3, $fulltime);
        $property->add_cell(11, 4, $first_year);
        $property->add_cell(11, 5, $second_year);
        $property->add_cell(11, 6, $third_year);
        $property->add_cell(11, 7, $fourth_year);
        $property->add_cell(11, 8, $fifth_year);
        $property->add_cell(11, 9, $under_graduate);
        $property->add_cell(11, 10, $total_grad);
        $property->add_cell(11, 11, $associates_awarded);
        $property->add_cell(11, 12, $bachelors_awarded);
        $property->add_cell(11, 13, $master_awarded);
        $property->add_cell(11, 14, $doctorates_awarded);

        $property->add_cell(12, 1, $parttime);
        $property->add_cell(12, 2, $first_year);
        $property->add_cell(12, 3, $second_year);
        $property->add_cell(12, 4, $third_year);
        $property->add_cell(12, 5, $fourth_year);
        $property->add_cell(12, 6, $fifth_year);
        $property->add_cell(12, 7, $under_graduate);
        $property->add_cell(12, 8, $total_grad);
        $property->add_cell(12, 9, $associates_awarded);
        $property->add_cell(12, 10, $bachelors_awarded);
        $property->add_cell(12, 11, $master_awarded);
        $property->add_cell(12, 12, $doctorates_awarded);
        $this->set_property($property);
    }

    public function get_program_enrollment()
    {
        return $this->get_property('program_enrollment')->get_value();
    }

    public function set_program_enrollment_note()
    {
        $property = new \Orm_Property_Fixedtext('program_enrollment_note', 'Give official fall term enrollment figures (head count) for the current and preceding four academic years and undergraduate and graduate degrees conferred during each of those years.  The "current" year means the academic year preceding the on-site visit.'
            . ' <br/> <br/>FT-full time <br/>PT-part time');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_program_enrollment_note()
    {
        return $this->get_property('program_enrollment_note')->get_value();
    }

    public function set_program_name($value)
    {
        $property = new \Orm_Property_Text('program_name', $value);
        $property->set_description('Name of the Program');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_program_name()
    {
        return $this->get_property('program_name')->get_value();
    }

    public function set_new_year($value)
    {
        $property = new \Orm_Property_Text('new_year', $value);
        $property->set_description('Year');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_new_year()
    {
        return $this->get_property('new_year')->get_value();
    }

    public function set_presonnel($value)
    {
        $fulltime = new \Orm_Property_Text('fulltime');
        $fulltime->set_width(200);
        $parttime = new \Orm_Property_Text('parttime');
        $parttime->set_width(200);
        $fte = new \Orm_Property_Text('fte');
        $fte->set_width(200);

        $property = new \Orm_Property_Table('presonnel', $value);
        $property->set_description('Table D-2. Personnel');
        $property->set_group('group_7');


        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('empty', ''), 2, 0);
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('head_count', 'HEAD COUNT'), 0, 2);
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('fte', 'FTE( 2)'), 2, 0);

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('ft', 'FT'));
        $property->add_cell(2, 2, new \Orm_Property_Fixedtext('pt', 'PT'));

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('admin', 'Administrative (2)'));
        $property->add_cell(3, 2, $fulltime);
        $property->add_cell(3, 3, $parttime);
        $property->add_cell(3, 4, $fte);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('faculty', 'Faculty (tenure-track)(3)'));
        $property->add_cell(4, 2, $fulltime);
        $property->add_cell(4, 3, $parttime);
        $property->add_cell(4, 4, $fte);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('other_faculty', 'Other Faculty (excluding student Assistants)'));
        $property->add_cell(5, 2, $fulltime);
        $property->add_cell(5, 3, $parttime);
        $property->add_cell(5, 4, $fte);

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('student_Teaching', 'Student Teaching Assistants(4)'));
        $property->add_cell(6, 2, $fulltime);
        $property->add_cell(6, 3, $parttime);
        $property->add_cell(6, 4, $fte);

        $property->add_cell(7, 1, new \Orm_Property_Fixedtext('technicians', 'Technicians/Specialists'));
        $property->add_cell(7, 2, $fulltime);
        $property->add_cell(7, 3, $parttime);
        $property->add_cell(7, 4, $fte);

        $property->add_cell(8, 1, new \Orm_Property_Fixedtext('office', 'Office/Clerical Employees'));
        $property->add_cell(8, 2, $fulltime);
        $property->add_cell(8, 3, $parttime);
        $property->add_cell(8, 4, $fte);

        $property->add_cell(9, 1, new \Orm_Property_Fixedtext('other', 'Others (5)'));
        $property->add_cell(9, 2, $fulltime);
        $property->add_cell(9, 3, $parttime);
        $property->add_cell(9, 4, $fte);

        $this->set_property($property);
    }

    public function get_presonnel()
    {
        return $this->get_property('presonnel')->get_value();
    }

    public function set_presonnel_note()
    {
        $property = new \Orm_Property_Fixedtext('presonnel_note', 'Report data for the program being evaluated. <br/> <br/>'
            . '(1) Data on this table should be for the fall term immediately preceding the visit.  Updated tables for the fall term when the ABET team is visiting are to be prepared and presented to the team when they arrive. <br/> <br/>'
            . '(2) Persons holding joint administrative/faculty positions or other combined assignments should be allocated to each category according to the fraction of the appointment assigned to that category. <br/> <br/>'
            . '(3) For faculty members, 1 FTE equals what your institution defines as a full-time load <br/> <br/>'
            . '(4) For student teaching assistants, 1 FTE equals 20 hours per week of work (or service). For undergraduate and graduate students, 1 FTE equals 15 semester credit-hours (or 24 quarter credit-hours) per term of institutional course work, meaning all courses — science, humanities and social sciences, etc. <br/> <br/>'
            . '(5) Specify any other category considered appropriate, or leave blank. ');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_presonnel_note()
    {
        return $this->get_property('presonnel_note')->get_value();
    }

    public function after_node_load()
    {
        parent::after_node_load();

        $this->set_new_year($this->get_year());
        $this->set_institution_name(\Orm_Institution::get_university_name('english'));

        $program_node = $this->get_parent_program_node();
        if (!is_null($program_node) && $program_node->get_id()) {
            $program_obj = $program_node->get_item_obj();

            $this->set_program($program_obj->get_name('english'));
            $this->set_program_name($program_obj->get_name('english'));
        }
    }

}
