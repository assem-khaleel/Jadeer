<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of program_profile
 *
 * @author ahmadgx
 */
class Program_Profile extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $code = 'Program_Profile';
    protected $name = 'Program Profile';
    protected $link_pdf = true;
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_send_to_review = true;
    protected $orientation = 'landscape';

    public function init()
    {
        parent::init();

            $this->set_introduction();
            $this->set_institution('');
            $this->set_college('');
            $this->set_department('');
            $this->set_title_of_program('');
            $this->set_code_of_program('');
            $this->set_college_dean(array());
            $this->set_college_vice_dean(array());
            $this->set_department_head(array());
            $this->set_start_date('');
            $this->set_credit_hour('');
            $this->set_award('');
            $this->set_major_tracks('');
            $this->set_professional_occupations('');
            $this->set_branches('');
            $this->set_date_of_approval_of_program('');
            $this->set_date_of_approval_authorized('');
            $this->set_date_of_most_recent('');
            $this->set_table_1(array());
            $this->set_table_1_note();
            $this->set_table_2(array());
            $this->set_table_2_note();
            $this->set_table_3(array());
            $this->set_table_3_note();
            $this->set_table_4(array());
            $this->set_table_5(array());
            $this->set_table_5_note();
            $this->set_table_6(array());
            $this->set_table_7(array());
            $this->set_table_7_note();
            $this->set_table_8(array());
            $this->set_table_8_note();
    }

    public function set_introduction()
    {
        $property = new \Orm_Property_Fixedtext('introduction', '<strong>INTRODUCTION <br/> <br/>The aim of this template is to collect information and data associated with the Program. The Program information and data should be updated annually, and will be used for aggregated national benchmarking. <br/> <br/>Program Data</strong>');
        $this->set_property($property);
    }

    public function get_introduction()
    {
        return $this->get_property('introduction')->get_value();
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

    public function set_college($value)
    {
        $property = new \Orm_Property_Text('college', $value);
        $property->set_description('Name of College in which the Program is offered');
        $this->set_property($property);
    }

    public function get_college()
    {
        return $this->get_property('college')->get_value();
    }

    public function set_department($value)
    {
        $property = new \Orm_Property_Text('department', $value);
        $property->set_description('Name of Department in which the Program is offered');
        $this->set_property($property);
    }

    public function get_department()
    {
        return $this->get_property('department')->get_value();
    }

    public function set_title_of_program($value)
    {
        $property = new \Orm_Property_Text('title_of_program', $value);
        $property->set_description('Name of the Program');
        $this->set_property($property);
    }

    public function get_title_of_program()
    {
        return $this->get_property('title_of_program')->get_value();
    }

    public function set_code_of_program($value)
    {
        $property = new \Orm_Property_Text('code_of_program', $value);
        $property->set_description('Code of the Program');
        $this->set_property($property);
    }

    public function get_code_of_program()
    {
        return $this->get_property('code_of_program')->get_value();
    }

    public function set_college_dean($value)
    {
        $property = new \Orm_Property_Table('college_dean', $value);
        $property->set_description('Name and Contact Details  for the College Dean');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('college_Dean_name', 'Name'));
        $property->add_cell(1, 2, new \Orm_Property_Text('name'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('contact_info', 'Contact Information'), 0, 2);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('college_Dean_address', 'Address'));
        $property->add_cell(3, 2, new \Orm_Property_Text('address'));

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('college_Dean_telephone', 'Telephone'));
        $property->add_cell(4, 2, new \Orm_Property_Text('telephone'));

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('college_Dean_email', 'Email'));
        $property->add_cell(5, 2, new \Orm_Property_Text('email'));

        $this->set_property($property);
    }

    public function get_college_dean()
    {
        return $this->get_property('college_dean')->get_value();
    }

    public function generate_ams_college_dean(&$ams_form = array(), $ams_file = null, $class_type = null)
    {

        $college_dean = $this->get_property('college_dean');
        /** @var $college_dean \Orm_Property_Table */

        $college_dean->get_cell_property(1,2)->generate_ams_property($ams_form, $ams_file, $class_type);
        $college_dean->get_cell_property(3,2)->generate_ams_property($ams_form, $ams_file, $class_type);
        $college_dean->get_cell_property(4,2)->generate_ams_property($ams_form, $ams_file, $class_type);
        $college_dean->get_cell_property(5,2)->generate_ams_property($ams_form, $ams_file, $class_type);
    }

    public function set_college_vice_dean($value)
    {
        $property = new \Orm_Property_Table('college_vice_dean', $value);
        $property->set_description('Name and Contact Details for the College Vice Dean for Quality Assurance (if any)');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('college_vice_dean_name', 'Name'));
        $property->add_cell(1, 2, new \Orm_Property_Text('name'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('contact_info', 'Contact Information'), 0, 2);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('college_vice_dean_address', 'Address'));
        $property->add_cell(3, 2, new \Orm_Property_Text('address'));

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('college_vice_dean_telephone', 'Telephone'));
        $property->add_cell(4, 2, new \Orm_Property_Text('telephone'));

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('college_vice_dean_email', 'Email'));
        $property->add_cell(5, 2, new \Orm_Property_Text('email'));

        $this->set_property($property);
    }

    public function get_college_vice_dean()
    {
        return $this->get_property('college_vice_dean')->get_value();
    }

    public function generate_ams_college_vice_dean(&$ams_form = array(), $ams_file = null, $class_type = null)
    {

        $college_dean = $this->get_property('college_vice_dean');
        /** @var $college_dean \Orm_Property_Table */

        $college_dean->get_cell_property(1,2)->generate_ams_property($ams_form, $ams_file, $class_type);
        $college_dean->get_cell_property(3,2)->generate_ams_property($ams_form, $ams_file, $class_type);
        $college_dean->get_cell_property(4,2)->generate_ams_property($ams_form, $ams_file, $class_type);
        $college_dean->get_cell_property(5,2)->generate_ams_property($ams_form, $ams_file, $class_type);
    }

    public function set_department_head($value)
    {
        $property = new \Orm_Property_Table('department_head', $value);
        $property->set_description('Name and Contact Details for the Head of the Department');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('department_head_name', 'Name'));
        $property->add_cell(1, 2, new \Orm_Property_Text('name'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('contact_info', 'Contact Information'), 0, 2);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('department_head_address', 'Address'));
        $property->add_cell(3, 2, new \Orm_Property_Text('address'));

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('department_head_telephone', 'Telephone'));
        $property->add_cell(4, 2, new \Orm_Property_Text('telephone'));

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('department_head_email', 'Email'));
        $property->add_cell(5, 2, new \Orm_Property_Text('email'));

        $this->set_property($property);
    }

    public function get_department_head()
    {
        return $this->get_property('department_head')->get_value();
    }

    public function generate_ams_department_head(&$ams_form = array(), $ams_file = null, $class_type = null)
    {

        $college_dean = $this->get_property('department_head');
        /** @var $college_dean \Orm_Property_Table */

        $college_dean->get_cell_property(1,2)->generate_ams_property($ams_form, $ams_file, $class_type);
        $college_dean->get_cell_property(3,2)->generate_ams_property($ams_form, $ams_file, $class_type);
        $college_dean->get_cell_property(4,2)->generate_ams_property($ams_form, $ams_file, $class_type);
        $college_dean->get_cell_property(5,2)->generate_ams_property($ams_form, $ams_file, $class_type);
    }

    public function set_start_date($value)
    {
        $property = new \Orm_Property_Text('start_date', $value);
        $property->set_description('1. Program Start Date');
        $this->set_property($property);
    }

    public function get_start_date()
    {
        return $this->get_property('start_date')->get_value();
    }

    public function set_credit_hour($value)
    {
        $property = new \Orm_Property_Text('credit_hour', $value);
        $property->set_description('2. Credit hours required for completion of the program');
        $this->set_property($property);
    }

    public function get_credit_hour()
    {
        return $this->get_property('credit_hour')->get_value();
    }

    public function set_award($value)
    {
        $property = new \Orm_Property_Textarea('award', $value);
        $property->set_description('3. Award (s) granted on completion of the program (for community college programs, add degree granting policy)');
        $this->set_property($property);
    }

    public function get_award()
    {
        return $this->get_property('award')->get_value();
    }

    public function set_major_tracks($value)
    {
        $property = new \Orm_Property_Textarea('major_tracks', $value);
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
        $property->set_description('5. Professional occupations (licensed occupations, if any)  for which graduates are prepared ');
        $this->set_property($property);
    }

    public function get_professional_occupations()
    {
        return $this->get_property('professional_occupations')->get_value();
    }

    public function set_branches($value)
    {
        $property = new \Orm_Property_Textarea('branches', $value);
        $property->set_description('6. Branches/locations of the program. If offered on several campuses or by distance education as well as on-campus, including details.');
        $this->set_property($property);
    }

    public function get_branches()
    {
        return $this->get_property('branches')->get_value();
    }

    public function set_date_of_approval_of_program($value)
    {
        $property = new \Orm_Property_Text('date_of_approval_of_program', $value);
        $property->set_description('7. Date of approval of program specification within the institution');
        $this->set_property($property);
    }

    public function get_date_of_approval_of_program()
    {
        return $this->get_property('date_of_approval_of_program')->get_value();
    }

    public function set_date_of_approval_authorized($value)
    {
        $property = new \Orm_Property_Text('date_of_approval_authorized', $value);
        $property->set_description('8. Date of approval by the authorized body (Ministry of Education “MOE” for private institution and Council of Higher Education for public institutions).');
        $this->set_property($property);
    }

    public function get_date_of_approval_authorized()
    {
        return $this->get_property('date_of_approval_authorized')->get_value();
    }

    public function set_date_of_most_recent($value)
    {
        $property = new \Orm_Property_Text('date_of_most_recent', $value);
        $property->set_description('9. Date of most recent self-study (if any)');
        $this->set_property($property);
    }

    public function get_date_of_most_recent()
    {
        return $this->get_property('date_of_most_recent')->get_value();
    }

    public function set_table_1($value)
    {
        $property = new \Orm_Property_Table_Dynamic('table_1', $value);
        $property->set_description('Table1. Periodic Program Performance Indicators');

        $code = new \Orm_Property_Text('code');
        $code->set_description('Code');
        $code->set_width(100);
        $property->add_property($code);

        $indicator = new \Orm_Property_Text('indicator');
        $indicator->set_description('Indicator');
        $property->add_property($indicator);

        $value = new \Orm_Property_Text('value');
        $value->set_description('Value');
        $value->set_width(100);
        $property->add_property($value);

        $this->set_property($property);
    }

    public function get_table_1()
    {
        return $this->get_property('table_1')->get_value();
    }

    public function set_table_1_note()
    {
        $property = new \Orm_Property_Fixedtext('table_1_note', '<strong>*Full time equivalent (FTE) for faculty members: 1 FTE equals what MOE defines as a full-time load for faculty members.</strong>');
        $this->set_property($property);
    }

    public function get_table_1_note()
    {
        return $this->get_property('table_1_note')->get_value();
    }

    public function set_table_2($value)
    {

        $total_Student_enrollment_s = new \Orm_Property_Text('total_Student_enrollment_s');
        $total_Student_enrollment_s->set_width(100);
        $total_Student_enrollment_o = new \Orm_Property_Text('total_Student_enrollment_o');
        $total_Student_enrollment_o->set_width(100);
        $numb_of_phd_holders_s = new \Orm_Property_Text('numb_of_phd_holders_s');
        $numb_of_phd_holders_s->set_width(100);
        $numb_of_phd_holders_o = new \Orm_Property_Text('numb_of_phd_holders_o');
        $numb_of_phd_holders_o->set_width(100);
        $numb_of_Teaching_staff_s = new \Orm_Property_Text('numb_of_Teaching_staff_s');
        $numb_of_Teaching_staff_s->set_width(100);
        $numb_of_Teaching_staff_o = new \Orm_Property_Text('numb_of_Teaching_staff_o');
        $numb_of_Teaching_staff_o->set_width(100);
        $avg_class_size = new \Orm_Property_Text('avg_class_size');
        $avg_class_size->set_width(100);
        $avg_teaching_load = new \Orm_Property_Text('avg_teaching_load');
        $avg_teaching_load->set_width(100);
        $_student_to_teaching_staff = new \Orm_Property_Text('student_to_teaching_staff');
        $_student_to_teaching_staff->set_width(100);

        $property = new \Orm_Property_Table('table_2', $value);
        $property->set_description('Table 2. Periodic Program Data');
        $property->set_is_responsive(true);

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('gender', 'Gender'), 2, 0);
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('total_Student_enrollment', 'Total Students Enrollment'), 0, 2);
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('numb_of_phd_holders', 'No. of PhD holders in Teaching Staff'), 0, 2);
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('numb_of_Teaching_staff', 'No. of Teaching Staff'), 0, 2);
        $property->add_cell(1, 5, new \Orm_Property_Fixedtext('avg_class_size', 'Average Class Size'), 2, 0);
        $property->add_cell(1, 6, new \Orm_Property_Fixedtext('avg_teaching_load', 'Average Teaching Load'), 2, 0);
        $property->add_cell(1, 7, new \Orm_Property_Fixedtext('total_student_to_teaching_staff', 'Ratio of Students to Teaching Staff'), 2, 0);

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('s', 'S*'));
        $property->add_cell(2, 2, new \Orm_Property_Fixedtext('o', 'O**'));
        $property->add_cell(2, 3, new \Orm_Property_Fixedtext('s', 'S'));
        $property->add_cell(2, 4, new \Orm_Property_Fixedtext('o', 'O'));
        $property->add_cell(2, 5, new \Orm_Property_Fixedtext('s', 'S '));
        $property->add_cell(2, 6, new \Orm_Property_Fixedtext('o', 'O'));


        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('m', 'M'));
        $property->add_cell(3, 2, $total_Student_enrollment_s);
        $property->add_cell(3, 3, $total_Student_enrollment_o);
        $property->add_cell(3, 4, $numb_of_phd_holders_s);
        $property->add_cell(3, 5, $numb_of_phd_holders_o);
        $property->add_cell(3, 6, $numb_of_Teaching_staff_s);
        $property->add_cell(3, 7, $numb_of_Teaching_staff_o);
        $property->add_cell(3, 8, $avg_class_size);
        $property->add_cell(3, 9, $avg_teaching_load);
        $property->add_cell(3, 10, $_student_to_teaching_staff);




        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('f', 'F'));
        $property->add_cell(4, 2, $total_Student_enrollment_s);
        $property->add_cell(4, 3, $total_Student_enrollment_o);
        $property->add_cell(4, 4, $numb_of_phd_holders_s);
        $property->add_cell(4, 5, $numb_of_phd_holders_o);
        $property->add_cell(4, 6, $numb_of_Teaching_staff_s);
        $property->add_cell(4, 7, $numb_of_Teaching_staff_o);
        $property->add_cell(4, 8, $avg_class_size);
        $property->add_cell(4, 9, $avg_teaching_load);
        $property->add_cell(4, 10, $_student_to_teaching_staff);





        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('total', 'Total'));
        $property->add_cell(5, 2, $total_Student_enrollment_s);
        $property->add_cell(5, 3, $total_Student_enrollment_o);
        $property->add_cell(5, 4, $numb_of_phd_holders_s);
        $property->add_cell(5, 5, $numb_of_phd_holders_o);
        $property->add_cell(5, 6, $numb_of_Teaching_staff_s);
        $property->add_cell(5, 7, $numb_of_Teaching_staff_o);
        $property->add_cell(5, 8, $avg_class_size);
        $property->add_cell(5, 9, $avg_teaching_load);
        $property->add_cell(5, 10, $_student_to_teaching_staff);



        $this->set_property($property);
    }

    public function get_table_2()
    {
        return $this->get_property('table_2')->get_value();
    }

    public function set_table_2_note()
    {
        $property = new \Orm_Property_Fixedtext('table_2_note', '<ul>'
            . '<li>*S: Saudi Nationality</li>'
            . '<li>**O: Other Nationality</li>'
            . '<li>M: Male </li>'
            . '<li>F: Female </li>'
            . '</ul>'
            . '<strong>Note:</strong> Teaching staff includes teaching assistants, language instructors, lecturers, and assistant, associate and full professors. This does not include research or laboratory assistants. Academic staff who oversee the planning and delivery of teaching programs are included (e.g., head of department, dean for a college, rector and vice rectors).');
        $this->set_property($property);
    }

    public function get_table_2_note()
    {
        return $this->get_property('table_2_note')->get_value();
    }

    public function set_table_3($value)
    {
        $values = new \Orm_Property_Text('values');
        $values->set_width(100);

        $property = new \Orm_Property_Table('table_3', $value);
        $property->set_description('Table 3. Summary of Program Teaching Staff');
        $property->set_is_responsive(true);


        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('professor', 'Professor'), 0, 4);
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('associate_professor', 'Associate  Professor'), 0, 4);
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('assistant_professor', 'Assistant  Professor'), 0, 4);
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('lecture', 'Lecturer'), 0, 4);
        $property->add_cell(1, 5, new \Orm_Property_Fixedtext('teaching', 'Teaching Assistants/Language Instructors'), 0, 4);
        $property->add_cell(1, 6, new \Orm_Property_Fixedtext('total', 'Total'),0,2);


        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('male', 'M'), 0, 2);
        $property->add_cell(2, 2, new \Orm_Property_Fixedtext('female', 'F'), 0, 2);
        $property->add_cell(2, 3, new \Orm_Property_Fixedtext('male', 'M'), 0, 2);
        $property->add_cell(2, 4, new \Orm_Property_Fixedtext('female', 'F'), 0, 2);
        $property->add_cell(2, 5, new \Orm_Property_Fixedtext('male', 'M'), 0, 2);
        $property->add_cell(2, 6, new \Orm_Property_Fixedtext('female', 'F'), 0, 2);
        $property->add_cell(2, 7, new \Orm_Property_Fixedtext('male', 'M'), 0, 2);
        $property->add_cell(2, 8, new \Orm_Property_Fixedtext('female', 'F'), 0, 2);
        $property->add_cell(2, 9, new \Orm_Property_Fixedtext('male', 'M'), 0, 2);
        $property->add_cell(2, 10, new \Orm_Property_Fixedtext('female', 'F'), 0, 2);
        $property->add_cell(2, 11, new \Orm_Property_Fixedtext('male', 'M'), 2, 0);
        $property->add_cell(2, 12, new \Orm_Property_Fixedtext('female', 'F'), 2,0);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('ft', 'FT'));
        $property->add_cell(3, 2, new \Orm_Property_Fixedtext('pt', 'PT'));
        $property->add_cell(3, 3, new \Orm_Property_Fixedtext('ft', 'FT'));
        $property->add_cell(3, 4, new \Orm_Property_Fixedtext('pt', 'PT'));
        $property->add_cell(3, 5, new \Orm_Property_Fixedtext('ft', 'FT'));
        $property->add_cell(3, 6, new \Orm_Property_Fixedtext('pt', 'PT'));
        $property->add_cell(3, 7, new \Orm_Property_Fixedtext('ft', 'FT'));
        $property->add_cell(3, 8, new \Orm_Property_Fixedtext('pt', 'PT'));
        $property->add_cell(3, 9, new \Orm_Property_Fixedtext('ft', 'FT'));
        $property->add_cell(3, 10, new \Orm_Property_Fixedtext('pt', 'PT'));
        $property->add_cell(3, 11, new \Orm_Property_Fixedtext('ft', 'FT'));
        $property->add_cell(3, 12, new \Orm_Property_Fixedtext('pt', 'PT'));
        $property->add_cell(3, 13, new \Orm_Property_Fixedtext('ft', 'FT'));
        $property->add_cell(3, 14, new \Orm_Property_Fixedtext('pt', 'PT'));
        $property->add_cell(3, 15, new \Orm_Property_Fixedtext('ft', 'FT'));
        $property->add_cell(3, 16, new \Orm_Property_Fixedtext('pt', 'PT'));
        $property->add_cell(3, 17, new \Orm_Property_Fixedtext('ft', 'FT'));
        $property->add_cell(3, 18, new \Orm_Property_Fixedtext('pt', 'PT'));
        $property->add_cell(3, 19, new \Orm_Property_Fixedtext('ft', 'FT'));
        $property->add_cell(3, 20, new \Orm_Property_Fixedtext('pt', 'PT'));


        $property->add_cell(4, 1,$values);
        $property->add_cell(4, 2,$values);
        $property->add_cell(4, 3,$values);
        $property->add_cell(4, 4,$values);
        $property->add_cell(4, 5,$values);
        $property->add_cell(4, 6,$values);
        $property->add_cell(4, 7,$values);
        $property->add_cell(4, 8,$values);
        $property->add_cell(4, 9,$values);
        $property->add_cell(4, 10,$values);
        $property->add_cell(4, 11,$values);
        $property->add_cell(4, 12,$values);
        $property->add_cell(4, 13,$values);
        $property->add_cell(4, 14,$values);
        $property->add_cell(4, 15,$values);
        $property->add_cell(4, 16,$values);
        $property->add_cell(4, 17,$values);
        $property->add_cell(4, 18,$values);
        $property->add_cell(4, 19,$values);
        $property->add_cell(4, 20,$values);
        $property->add_cell(4, 21,$values);
        $property->add_cell(4, 22,$values);

        $this->set_property($property);
    }

    public function get_table_3()
    {
        return $this->get_property('table_3')->get_value();
    }

    public function set_table_3_note()
    {
        $property = new \Orm_Property_Fixedtext('table_3_note', '<strong>'
            . '<ul>'
            . '<li>FT: Full time</li>'
            . '<li>PT: Part time</li>'
            . '</ul>'
            . '</strong>');
        $this->set_property($property);
    }

    public function get_table_3_note()
    {
        return $this->get_property('table_3_note')->get_value();
    }

    public function set_table_4($value)
    {
        $undergraduate_diploma_m = new \Orm_Property_Text('undergraduate_diploma_m');
        $undergraduate_diploma_m->set_width(100);
        $undergraduate_diploma_f = new \Orm_Property_Text('undergraduate_diploma_f');
        $undergraduate_diploma_f->set_width(100);
        $undergraduate_bachelor_m = new \Orm_Property_Text('undergraduate_bachelor_m');
        $undergraduate_bachelor_m->set_width(100);
        $undergraduate_bachelor_f = new \Orm_Property_Text('undergraduate_bachelor_f');
        $undergraduate_bachelor_f->set_width(100);
        $postgraduates_high_diploma_m = new \Orm_Property_Text('postgraduates_high_diploma_m');
        $postgraduates_high_diploma_m->set_width(100);
        $postgraduates_high_diploma_f = new \Orm_Property_Text('postgraduates_high_diploma_f');
        $postgraduates_high_diploma_f->set_width(100);
        $postgraduates_master_m = new \Orm_Property_Text('postgraduates_master_m');
        $postgraduates_master_m->set_width(100);
        $postgraduates_master_f = new \Orm_Property_Text('postgraduates_master_f');
        $postgraduates_master_f->set_width(100);
        $postgraduates_phd_m = new \Orm_Property_Text('postgraduates_phd_m');
        $postgraduates_phd_m->set_width(100);
        $postgraduates_phd_f = new \Orm_Property_Text('postgraduates_phd_f');
        $postgraduates_phd_f->set_width(100);

        $property = new \Orm_Property_Table('table_4', $value);
        $property->set_description('Table 4. Numbers of Graduates in Each Program Offered by the Department in the Most Recent Year');
        $property->set_is_responsive(true);

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('nationality', 'Nationality'), 3, 0);
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('undergraduate', 'Undergraduates'), 0, 4);
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('postgraduates', 'Postgraduates'), 0, 6);

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('undergraduate_diploma', 'Diploma'), 0, 2);
        $property->add_cell(2, 2, new \Orm_Property_Fixedtext('undergraduate_bachelor', 'Bachelor'), 0, 2);
        $property->add_cell(2, 3, new \Orm_Property_Fixedtext('postgraduates_high_diploma', 'Higher Diploma'), 0, 2);
        $property->add_cell(2, 4, new \Orm_Property_Fixedtext('postgraduates_master', 'Master'), 0, 2);
        $property->add_cell(2, 5, new \Orm_Property_Fixedtext('postgraduates_phd', 'Ph.D.'), 0, 2);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('m', 'M'));
        $property->add_cell(3, 2, new \Orm_Property_Fixedtext('f', 'F'));
        $property->add_cell(3, 3, new \Orm_Property_Fixedtext('m', 'M'));
        $property->add_cell(3, 4, new \Orm_Property_Fixedtext('f', 'F'));
        $property->add_cell(3, 5, new \Orm_Property_Fixedtext('m', 'M'));
        $property->add_cell(3, 6, new \Orm_Property_Fixedtext('f', 'F'));
        $property->add_cell(3, 7, new \Orm_Property_Fixedtext('m', 'M'));
        $property->add_cell(3, 8, new \Orm_Property_Fixedtext('f', 'F'));
        $property->add_cell(3, 9, new \Orm_Property_Fixedtext('m', 'M'));
        $property->add_cell(3, 10, new \Orm_Property_Fixedtext('f', 'F'));

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('saudi', 'Saudi'));
        $property->add_cell(4, 2, $undergraduate_diploma_m);
        $property->add_cell(4, 3, $undergraduate_diploma_f);
        $property->add_cell(4, 4, $undergraduate_bachelor_m);
        $property->add_cell(4, 5, $undergraduate_bachelor_f);
        $property->add_cell(4, 6, $postgraduates_high_diploma_m);
        $property->add_cell(4, 7, $postgraduates_high_diploma_f);
        $property->add_cell(4, 8, $postgraduates_master_m);
        $property->add_cell(4, 9, $postgraduates_master_f);
        $property->add_cell(4, 10, $postgraduates_phd_m);
        $property->add_cell(4, 11, $postgraduates_phd_f);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('others', 'Others'));
        $property->add_cell(5, 2, $undergraduate_diploma_m);
        $property->add_cell(5, 3, $undergraduate_diploma_f);
        $property->add_cell(5, 4, $undergraduate_bachelor_m);
        $property->add_cell(5, 5, $undergraduate_bachelor_f);
        $property->add_cell(5, 6, $postgraduates_high_diploma_m);
        $property->add_cell(5, 7, $postgraduates_high_diploma_f);
        $property->add_cell(5, 8, $postgraduates_master_m);
        $property->add_cell(5, 9, $postgraduates_master_f);
        $property->add_cell(5, 10, $postgraduates_phd_m);
        $property->add_cell(5, 11, $postgraduates_phd_f);

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('total', 'Total'));
        $property->add_cell(6, 2, $undergraduate_diploma_m);
        $property->add_cell(6, 3, $undergraduate_diploma_f);
        $property->add_cell(6, 4, $undergraduate_bachelor_m);
        $property->add_cell(6, 5, $undergraduate_bachelor_f);
        $property->add_cell(6, 6, $postgraduates_high_diploma_m);
        $property->add_cell(6, 7, $postgraduates_high_diploma_f);
        $property->add_cell(6, 8, $postgraduates_master_m);
        $property->add_cell(6, 9, $postgraduates_master_f);
        $property->add_cell(6, 10, $postgraduates_phd_m);
        $property->add_cell(6, 11, $postgraduates_phd_f);

        $this->set_property($property);
    }

    public function get_table_4()
    {
        return $this->get_property('table_4')->get_value();
    }

    public function set_table_5($value)
    {
        $oncmpus_program_fulltime_m = new \Orm_Property_Text('oncmpus_program_fulltime_m');
        $oncmpus_program_fulltime_m->set_width(100);
        $oncmpus_program_fulltime_f = new \Orm_Property_Text('oncmpus_program_fulltime_f');
        $oncmpus_program_fulltime_f->set_width(100);
        $oncmpus_program_parttime_m = new \Orm_Property_Text('oncmpus_program_parttime_m');
        $oncmpus_program_parttime_m->set_width(100);
        $oncmpus_program_parttime_f = new \Orm_Property_Text('oncmpus_program_parttime_f');
        $oncmpus_program_parttime_f->set_width(100);
        $oncmpus_program_fte_m = new \Orm_Property_Text('oncmpus_program_fte_m');
        $oncmpus_program_fte_m->set_width(100);
        $oncmpus_program_fte_f = new \Orm_Property_Text('oncmpus_program_fte_f');
        $oncmpus_program_fte_f->set_width(100);
        $distance_education_fulltime_m = new \Orm_Property_Text('distance_education_fulltime_m');
        $distance_education_fulltime_m->set_width(100);
        $distance_education_fulltime_f = new \Orm_Property_Text('distance_education_fulltime_f');
        $distance_education_fulltime_f->set_width(100);
        $distance_education_parttime_m = new \Orm_Property_Text('distance_education_parttime_m');
        $distance_education_parttime_m->set_width(100);
        $distance_education_parttime_f = new \Orm_Property_Text('distance_education_parttime_f');
        $distance_education_parttime_f->set_width(100);
        $distance_education_fte_m = new \Orm_Property_Text('distance_education_fte_m');
        $distance_education_fte_m->set_width(100);
        $distance_education_fte_f = new \Orm_Property_Text('distance_education_fte_f');
        $distance_education_fte_f->set_width(100);

        $property = new \Orm_Property_Table('table_5', $value);
        $property->set_description('Table 5. Mode of Instruction – Student Enrollment (excluding preparatory year program)');
        $property->set_is_responsive(true);

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('nationality', 'Nationality'), 3, 0);
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('on_campus_program', 'On Campus Program'), 0, 6);
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('distance_education', 'Distance Education Program'), 0, 6);

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('on_campus_program_fulltime', 'Full time.'), 0, 2);
        $property->add_cell(2, 2, new \Orm_Property_Fixedtext('on_campus_program_parttime', 'Part time'), 0, 2);
        $property->add_cell(2, 3, new \Orm_Property_Fixedtext('on_campus_program_fte', 'FTE'), 0, 2);
        $property->add_cell(2, 4, new \Orm_Property_Fixedtext('distance_education_fulltime', 'Full time.'), 0, 2);
        $property->add_cell(2, 5, new \Orm_Property_Fixedtext('distance_education_parttime', 'Part time'), 0, 2);
        $property->add_cell(2, 6, new \Orm_Property_Fixedtext('distance_education_fte', 'FTE'), 0, 2);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('m', 'M'));
        $property->add_cell(3, 2, new \Orm_Property_Fixedtext('f', 'F'));
        $property->add_cell(3, 3, new \Orm_Property_Fixedtext('m', 'M'));
        $property->add_cell(3, 4, new \Orm_Property_Fixedtext('f', 'F'));
        $property->add_cell(3, 5, new \Orm_Property_Fixedtext('m', 'M'));
        $property->add_cell(3, 6, new \Orm_Property_Fixedtext('f', 'F'));
        $property->add_cell(3, 7, new \Orm_Property_Fixedtext('m', 'M'));
        $property->add_cell(3, 8, new \Orm_Property_Fixedtext('f', 'F'));
        $property->add_cell(3, 9, new \Orm_Property_Fixedtext('m', 'M'));
        $property->add_cell(3, 10, new \Orm_Property_Fixedtext('f', 'F'));
        $property->add_cell(3, 11, new \Orm_Property_Fixedtext('m', 'M'));
        $property->add_cell(3, 12, new \Orm_Property_Fixedtext('f', 'F'));

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('saudi', 'Saudi'));
        $property->add_cell(4, 2, $oncmpus_program_fulltime_m);
        $property->add_cell(4, 3, $oncmpus_program_fulltime_f);
        $property->add_cell(4, 4, $oncmpus_program_parttime_m);
        $property->add_cell(4, 5, $oncmpus_program_parttime_f);
        $property->add_cell(4, 6, $oncmpus_program_fte_m);
        $property->add_cell(4, 7, $oncmpus_program_fte_f);
        $property->add_cell(4, 8, $distance_education_fulltime_m);
        $property->add_cell(4, 9, $distance_education_fulltime_f);
        $property->add_cell(4, 10, $distance_education_parttime_m);
        $property->add_cell(4, 11, $distance_education_parttime_f);
        $property->add_cell(4, 12, $distance_education_fte_m);
        $property->add_cell(4, 13, $distance_education_fte_f);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('others', 'Others'));
        $property->add_cell(5, 2, $oncmpus_program_fulltime_m);
        $property->add_cell(5, 3, $oncmpus_program_fulltime_f);
        $property->add_cell(5, 4, $oncmpus_program_parttime_m);
        $property->add_cell(5, 5, $oncmpus_program_parttime_f);
        $property->add_cell(5, 6, $oncmpus_program_fte_m);
        $property->add_cell(5, 7, $oncmpus_program_fte_f);
        $property->add_cell(5, 8, $distance_education_fulltime_m);
        $property->add_cell(5, 9, $distance_education_fulltime_f);
        $property->add_cell(5, 10, $distance_education_parttime_m);
        $property->add_cell(5, 11, $distance_education_parttime_f);
        $property->add_cell(5, 12, $distance_education_fte_m);
        $property->add_cell(5, 13, $distance_education_fte_f);

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('total', 'Total'));
        $property->add_cell(6, 2, $oncmpus_program_fulltime_m);
        $property->add_cell(6, 3, $oncmpus_program_fulltime_f);
        $property->add_cell(6, 4, $oncmpus_program_parttime_m);
        $property->add_cell(6, 5, $oncmpus_program_parttime_f);
        $property->add_cell(6, 6, $oncmpus_program_fte_m);
        $property->add_cell(6, 7, $oncmpus_program_fte_f);
        $property->add_cell(6, 8, $distance_education_fulltime_m);
        $property->add_cell(6, 9, $distance_education_fulltime_f);
        $property->add_cell(6, 10, $distance_education_parttime_m);
        $property->add_cell(6, 11, $distance_education_parttime_f);
        $property->add_cell(6, 12, $distance_education_fte_m);
        $property->add_cell(6, 13, $distance_education_fte_f);

        $this->set_property($property);
    }

    public function get_table_5()
    {
        return $this->get_property('table_5')->get_value();
    }

    public function set_table_5_note()
    {
        $property = new \Orm_Property_Fixedtext('table_5_note', '<strong>Note:</strong>FTE (full time equivalent) for part time students- assume a full time load is 15 credit hours and divide the number of credit hours taken by each student by 15 (use this formula only for part time students).');
        $this->set_property($property);
    }

    public function get_table_5_note()
    {
        return $this->get_property('table_5_note')->get_value();
    }

    public function set_table_6($value)
    {
        $oncmpus_program_fulltime_m = new \Orm_Property_Text('oncmpus_program_fulltime_m');
        $oncmpus_program_fulltime_m->set_width(100);
        $oncmpus_program_fulltime_f = new \Orm_Property_Text('oncmpus_program_fulltime_f');
        $oncmpus_program_fulltime_f->set_width(100);
        $oncmpus_program_parttime_m = new \Orm_Property_Text('oncmpus_program_parttime_m');
        $oncmpus_program_parttime_m->set_width(100);
        $oncmpus_program_parttime_f = new \Orm_Property_Text('oncmpus_program_parttime_f');
        $oncmpus_program_parttime_f->set_width(100);
        $oncmpus_program_fte_m = new \Orm_Property_Text('oncmpus_program_fte_m');
        $oncmpus_program_fte_m->set_width(100);
        $oncmpus_program_fte_f = new \Orm_Property_Text('oncmpus_program_fte_f');
        $oncmpus_program_fte_f->set_width(100);
        $distance_education_fulltime_m = new \Orm_Property_Text('distance_education_fulltime_m');
        $distance_education_fulltime_m->set_width(100);
        $distance_education_fulltime_f = new \Orm_Property_Text('distance_education_fulltime_f');
        $distance_education_fulltime_f->set_width(100);
        $distance_education_parttime_m = new \Orm_Property_Text('distance_education_parttime_m');
        $distance_education_parttime_m->set_width(100);
        $distance_education_parttime_f = new \Orm_Property_Text('distance_education_parttime_f');
        $distance_education_parttime_f->set_width(100);
        $distance_education_fte_m = new \Orm_Property_Text('distance_education_fte_m');
        $distance_education_fte_m->set_width(100);
        $distance_education_fte_f = new \Orm_Property_Text('distance_education_fte_f');
        $distance_education_fte_f->set_width(100);

        $property = new \Orm_Property_Table('table_6', $value);
        $property->set_description('Table 6. Mode of Instruction – Teaching Staff (excluding preparatory year program)');
        $property->set_is_responsive(true);

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('nationality', 'Nationality'), 3, 0);
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('on_campus_program', 'On Campus Program'), 0, 6);
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('distance_education', 'Distance Education Program'), 0, 6);

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('on_campus_program_fulltime', 'Full time'), 0, 2);
        $property->add_cell(2, 2, new \Orm_Property_Fixedtext('on_campus_program_parttime', 'Part time'), 0, 2);
        $property->add_cell(2, 3, new \Orm_Property_Fixedtext('on_campus_program_fte', 'FTE'), 0, 2);
        $property->add_cell(2, 4, new \Orm_Property_Fixedtext('distance_education_fulltime', 'Full time'), 0, 2);
        $property->add_cell(2, 5, new \Orm_Property_Fixedtext('distance_education_parttime', 'Part time'), 0, 2);
        $property->add_cell(2, 6, new \Orm_Property_Fixedtext('distance_education_fte', 'FTE'), 0, 2);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('m', 'M'));
        $property->add_cell(3, 2, new \Orm_Property_Fixedtext('f', 'F'));
        $property->add_cell(3, 3, new \Orm_Property_Fixedtext('m', 'M'));
        $property->add_cell(3, 4, new \Orm_Property_Fixedtext('f', 'F'));
        $property->add_cell(3, 5, new \Orm_Property_Fixedtext('m', 'M'));
        $property->add_cell(3, 6, new \Orm_Property_Fixedtext('f', 'F'));
        $property->add_cell(3, 7, new \Orm_Property_Fixedtext('m', 'M'));
        $property->add_cell(3, 8, new \Orm_Property_Fixedtext('f', 'F'));
        $property->add_cell(3, 9, new \Orm_Property_Fixedtext('m', 'M'));
        $property->add_cell(3, 10, new \Orm_Property_Fixedtext('f', 'F'));
        $property->add_cell(3, 11, new \Orm_Property_Fixedtext('m', 'M'));
        $property->add_cell(3, 12, new \Orm_Property_Fixedtext('f', 'F'));

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('saudi', 'Saudi'));
        $property->add_cell(4, 2, $oncmpus_program_fulltime_m);
        $property->add_cell(4, 3, $oncmpus_program_fulltime_f);
        $property->add_cell(4, 4, $oncmpus_program_parttime_m);
        $property->add_cell(4, 5, $oncmpus_program_parttime_f);
        $property->add_cell(4, 6, $oncmpus_program_fte_m);
        $property->add_cell(4, 7, $oncmpus_program_fte_f);
        $property->add_cell(4, 8, $distance_education_fulltime_m);
        $property->add_cell(4, 9, $distance_education_fulltime_f);
        $property->add_cell(4, 10, $distance_education_parttime_m);
        $property->add_cell(4, 11, $distance_education_parttime_f);
        $property->add_cell(4, 12, $distance_education_fte_m);
        $property->add_cell(4, 13, $distance_education_fte_f);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('others', 'Others'));
        $property->add_cell(5, 2, $oncmpus_program_fulltime_m);
        $property->add_cell(5, 3, $oncmpus_program_fulltime_f);
        $property->add_cell(5, 4, $oncmpus_program_parttime_m);
        $property->add_cell(5, 5, $oncmpus_program_parttime_f);
        $property->add_cell(5, 6, $oncmpus_program_fte_m);
        $property->add_cell(5, 7, $oncmpus_program_fte_f);
        $property->add_cell(5, 8, $distance_education_fulltime_m);
        $property->add_cell(5, 9, $distance_education_fulltime_f);
        $property->add_cell(5, 10, $distance_education_parttime_m);
        $property->add_cell(5, 11, $distance_education_parttime_f);
        $property->add_cell(5, 12, $distance_education_fte_m);
        $property->add_cell(5, 13, $distance_education_fte_f);

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('total', 'Total'));
        $property->add_cell(6, 2, $oncmpus_program_fulltime_m);
        $property->add_cell(6, 3, $oncmpus_program_fulltime_f);
        $property->add_cell(6, 4, $oncmpus_program_parttime_m);
        $property->add_cell(6, 5, $oncmpus_program_parttime_f);
        $property->add_cell(6, 6, $oncmpus_program_fte_m);
        $property->add_cell(6, 7, $oncmpus_program_fte_f);
        $property->add_cell(6, 8, $distance_education_fulltime_m);
        $property->add_cell(6, 9, $distance_education_fulltime_f);
        $property->add_cell(6, 10, $distance_education_parttime_m);
        $property->add_cell(6, 11, $distance_education_parttime_f);
        $property->add_cell(6, 12, $distance_education_fte_m);
        $property->add_cell(6, 13, $distance_education_fte_f);

        $this->set_property($property);
    }

    public function get_table_6()
    {
        return $this->get_property('table_6')->get_value();
    }

    public function set_table_7($value)
    {
        $undergraduate_programs_four_year_4 = new \Orm_Property_Text('undergraduate_programs_four_year_4');
        $undergraduate_programs_four_year_4->set_width(100);
        $undergraduate_programs_four_year_5 = new \Orm_Property_Text('undergraduate_programs_four_year_5');
        $undergraduate_programs_four_year_5->set_width(100);
        $undergraduate_programs_four_year_6 = new \Orm_Property_Text('undergraduate_programs_four_year_6');
        $undergraduate_programs_four_year_6->set_width(100);
        $undergraduate_programs_five_year_4 = new \Orm_Property_Text('undergraduate_programs_five_year_4');
        $undergraduate_programs_five_year_4->set_width(100);
        $undergraduate_programs_five_year_5 = new \Orm_Property_Text('undergraduate_programs_five_year_5');
        $undergraduate_programs_five_year_5->set_width(100);
        $undergraduate_programs_five_year_6 = new \Orm_Property_Text('undergraduate_programs_five_year_6');
        $undergraduate_programs_five_year_6->set_width(100);
        $undergraduate_programs_six_year_4 = new \Orm_Property_Text('undergraduate_programs_six_year_4');
        $undergraduate_programs_six_year_4->set_width(100);
        $undergraduate_programs_six_year_5 = new \Orm_Property_Text('undergraduate_programs_six_year_5');
        $undergraduate_programs_six_year_5->set_width(100);
        $undergraduate_programs_six_year_6 = new \Orm_Property_Text('undergraduate_programs_six_year_6');
        $undergraduate_programs_six_year_6->set_width(100);
        $postgraduate_programs_master_completion_rate = new \Orm_Property_Text('postgraduate_programs_master_completion_rate');
        $postgraduate_programs_master_completion_rate->set_width(100);
        $postgraduate_programs_phd_completion_rate = new \Orm_Property_Text('postgraduate_programs_phd_completion_rate');
        $postgraduate_programs_phd_completion_rate->set_width(100);

        $property = new \Orm_Property_Table('table_7', $value);
        $property->set_description('Table 7. Program Completion Rate/Graduation Rate* Offered by the Department');
        $property->set_is_responsive(true);

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('gender', 'Gender'), 3, 0);
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('undergraduate_programs', 'Undergraduate Programs'), 0, 9);
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('postgraduate_programs', 'Postgraduate Programs'), 0, 2);

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('undergraduate_programs_four_year', 'Four-Year Program'), 0, 3);
        $property->add_cell(2, 2, new \Orm_Property_Fixedtext('undergraduate_programs_five_year', 'Five-Year Program'), 0, 3);
        $property->add_cell(2, 3, new \Orm_Property_Fixedtext('undergraduate_programs_six_year', 'Six-Year Program'), 0, 3);
        $property->add_cell(2, 4, new \Orm_Property_Fixedtext('postgraduate_programs_master', 'Masters'));
        $property->add_cell(2, 5, new \Orm_Property_Fixedtext('postgraduate_programs_phd', 'Ph.D.'));

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('undergraduate_programs_four_year_4', '4'));
        $property->add_cell(3, 2, new \Orm_Property_Fixedtext('undergraduate_programs_four_year_5', '5'));
        $property->add_cell(3, 3, new \Orm_Property_Fixedtext('undergraduate_programs_four_year_6', '6'));
        $property->add_cell(3, 4, new \Orm_Property_Fixedtext('undergraduate_programs_five_year_4', '5'));
        $property->add_cell(3, 5, new \Orm_Property_Fixedtext('undergraduate_programs_five_year_5', '6'));
        $property->add_cell(3, 6, new \Orm_Property_Fixedtext('undergraduate_programs_five_year_6', '7'));
        $property->add_cell(3, 7, new \Orm_Property_Fixedtext('undergraduate_programs_six_year_4', '6'));
        $property->add_cell(3, 8, new \Orm_Property_Fixedtext('undergraduate_programs_six_year_5', '7'));
        $property->add_cell(3, 9, new \Orm_Property_Fixedtext('undergraduate_programs_six_year_6', '8'));
        $property->add_cell(3, 10, new \Orm_Property_Fixedtext('postgraduate_programs_master_completion_rate', 'Completion Rate in Specified Time**'));
        $property->add_cell(3, 11, new \Orm_Property_Fixedtext('postgraduate_programs_phd_completion_rate', 'Completion Rate in Specified Time**'));


        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('m', 'M'));
        $property->add_cell(4, 2, $undergraduate_programs_four_year_4);
        $property->add_cell(4, 3, $undergraduate_programs_four_year_5);
        $property->add_cell(4, 4, $undergraduate_programs_four_year_6);
        $property->add_cell(4, 5, $undergraduate_programs_five_year_4);
        $property->add_cell(4, 6, $undergraduate_programs_five_year_5);
        $property->add_cell(4, 7, $undergraduate_programs_five_year_6);
        $property->add_cell(4, 8, $undergraduate_programs_six_year_4);
        $property->add_cell(4, 9, $undergraduate_programs_six_year_5);
        $property->add_cell(4, 10, $undergraduate_programs_six_year_6);
        $property->add_cell(4, 11, $postgraduate_programs_master_completion_rate);
        $property->add_cell(4, 12, $postgraduate_programs_phd_completion_rate);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('f', 'F'));
        $property->add_cell(5, 2, $undergraduate_programs_four_year_4);
        $property->add_cell(5, 3, $undergraduate_programs_four_year_5);
        $property->add_cell(5, 4, $undergraduate_programs_four_year_6);
        $property->add_cell(5, 5, $undergraduate_programs_five_year_4);
        $property->add_cell(5, 6, $undergraduate_programs_five_year_5);
        $property->add_cell(5, 7, $undergraduate_programs_five_year_6);
        $property->add_cell(5, 8, $undergraduate_programs_six_year_4);
        $property->add_cell(5, 9, $undergraduate_programs_six_year_5);
        $property->add_cell(5, 10, $undergraduate_programs_six_year_6);
        $property->add_cell(5, 11, $postgraduate_programs_master_completion_rate);
        $property->add_cell(5, 12, $postgraduate_programs_phd_completion_rate);

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('avg', 'Average'));
        $property->add_cell(6, 2, $undergraduate_programs_four_year_4);
        $property->add_cell(6, 3, $undergraduate_programs_four_year_5);
        $property->add_cell(6, 4, $undergraduate_programs_four_year_6);
        $property->add_cell(6, 5, $undergraduate_programs_five_year_4);
        $property->add_cell(6, 6, $undergraduate_programs_five_year_5);
        $property->add_cell(6, 7, $undergraduate_programs_five_year_6);
        $property->add_cell(6, 8, $undergraduate_programs_six_year_4);
        $property->add_cell(6, 9, $undergraduate_programs_six_year_5);
        $property->add_cell(6, 10, $undergraduate_programs_six_year_6);
        $property->add_cell(6, 11, $postgraduate_programs_master_completion_rate);
        $property->add_cell(6, 12, $postgraduate_programs_phd_completion_rate);
        $this->set_property($property);
    }

    public function get_table_7()
    {
        return $this->get_property('table_7')->get_value();
    }

    public function set_table_7_note()
    {
        $property = new \Orm_Property_Fixedtext('table_7_note', '<strong>Initial Cohort: </strong>All students who enter an academic Program as first-time, full-time, degree seeking undergraduate students for the given Fall Semester. <br/> <br/>'
            . '<strong>*Completion rate/Graduation rate for undergraduate students:</strong>The percentage of the cohort class in a given Fall Semester who graduated within a designated period of time. For example, in a four-year program, the "Four-Year Graduation" rate for the Fall Semester 2008 cohort class is the percentage of the Fall Semester 2008 cohort class who graduated from the institution before Fall Semester 2012, while the “Six-Year Graduation” rate for the Fall Semester 2008 cohort class is the percentage of the Fall Semester 2008 cohort class who graduated from the institution before Fall Semester 2014. <br/> <br/>'
            . '<strong>** Completion rate for postgraduate students:</strong>The proportion of students entering postgraduate programs who complete those programs in specified time. The time should be specified in the table.');
        $this->set_property($property);
    }

    public function get_table_7_note()
    {
        return $this->get_property('table_7_note')->get_value();
    }

    public function set_table_8($value)
    {
        $property = new \Orm_Property_Table_Dynamic('table_8', $value);
        $property->set_description('Table 8. Teaching Staff Qualifications');
        $property->set_is_responsive(true);

        $teaching_staff_name = new \Orm_Property_Text('teaching_staff_name');
        $teaching_staff_name->set_description('Teaching Staff Name');
        $teaching_staff_name->set_width(100);
        $property->add_property($teaching_staff_name);

        $gender = new \Orm_Property_Radio('gender');
        $gender->set_description('Gender');
        $gender->set_options(array('M', "F"));
        $gender->set_width(50);
        $property->add_property($gender);

        $nationality = new \Orm_Property_Text('nationality');
        $nationality->set_description('Nationality');
        $nationality->set_width(60);
        $property->add_property($nationality);

        $year = new \Orm_Property_Text('year');
        $year->set_description('Total Years at Current Program');
        $year->set_width(50);
        $property->add_property($year);

        $academic_rank = new \Orm_Property_Text('academic_rank');
        $academic_rank->set_description('Academic Rank');
        $academic_rank->set_width(60);
        $property->add_property($academic_rank);

        $general_specialty = new \Orm_Property_Text('general_specialty');
        $general_specialty->set_description('General Specialty');
        $general_specialty->set_width(60);
        $property->add_property($general_specialty);

        $specific_specialty = new \Orm_Property_Text('specific_specialty');
        $specific_specialty->set_description('Specific Specialty');
        $specific_specialty->set_width(60);
        $property->add_property($specific_specialty);

        $graduated_From = new \Orm_Property_Text('graduated_From');
        $graduated_From->set_description('Institution  Graduated From');
        $graduated_From->set_width(60);
        $property->add_property($graduated_From);

        $highest_degree = new \Orm_Property_Text('highest_degree');
        $highest_degree->set_description('Highest Degree Obtained');
        $highest_degree->set_width(60);
        $property->add_property($highest_degree);

        $study_mode = new \Orm_Property_Text('study_mode');
        $study_mode->set_description('*Study Mode');
        $study_mode->set_width(60);
        $property->add_property($study_mode);

        $course_list = new \Orm_Property_Textarea('course_list');
        $course_list->set_description('List of Courses Taught This Academic Year');
        $course_list->set_width(60);
        $course_list->set_enable_tinymce(0);
        $property->add_property($course_list);

        $full_part_time = new \Orm_Property_Radio("full_part_time");
        $full_part_time->set_description('Full or Part Time');
        $full_part_time->set_options(array('PT', "FT"));
        $full_part_time->set_width(50);
        $property->add_property($full_part_time);

        $this->set_property($property);
    }

    public function get_table_8()
    {
        return $this->get_property('table_8')->get_value();
    }

    public function set_table_8_note()
    {
        $property = new \Orm_Property_Fixedtext('table_8_note', '<strong>*(On Campus Programs, Distance Learning)</strong>');
        $this->set_property($property);
    }

    public function get_table_8_note()
    {
        return $this->get_property('table_8_note')->get_value();
    }

    public function after_node_load()
    {
        parent::after_node_load();
        $this->set_institution(\Orm_Institution::get_university_name('english'));
        $program_node = $this->get_parent_program_node();
        if (!is_null($program_node) && $program_node->get_id()) {
            $program_obj = $program_node->get_item_obj(); /* @var $program_obj \Orm_Program */
            $department_obj = $program_obj->get_department_obj();
            $this->set_college($department_obj->get_college_obj()->get_name('english'));
            $this->set_department( $department_obj->get_name('english'));
            $this->set_title_of_program($program_obj->get_name('english'));
            $this->set_code_of_program($program_obj->get_code('english'));
            $this->set_credit_hour($program_obj->get_credit_hours());
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

            $this->set_award($program_obj->get_name('english'));


            if(\License::get_instance()->check_module('kpi') && \Modules::load('kpi')) {
                $kpis = \Orm_Kpi::get_all(array('category_id' => \Orm_Kpi::KPI_ACCREDITATION, 'college_id' => $college_obj->get_id()));

                $indicators = array();
                foreach ($kpis as $i => $kpi) {

                    $info = $kpi->get_info(\Orm_Kpi_Detail::TYPE_PROGRAM, array('college_id' => $college_obj->get_id(), 'program_id' => $program_obj->get_id(),'academic_year' => $this->get_year()));

                    $indicators[$i]['code'] = $kpi->get_code();
                    $indicators[$i]['indicator'] = nl2br($kpi->get_title());
                    $indicators[$i]['value'] = $info['actual_benchmarks'];
                }
                $this->set_table_1($indicators);
            }

            if (\Orm::get_ci()->config->item('integration_enabled')) {

                if (!is_null($program_node) && $program_node->get_id()) {


                    $academic_year = $this->get_year();

                    $faculty_count_m_s = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 's' ,'program_id' => $program_obj->get_id(), 'academic_year' => $this->get_year()), 'teaching_staff');
                    $faculty_count_m_o = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 'o' ,'program_id' => $program_obj->get_id(), 'academic_year' => $this->get_year()), 'teaching_staff');

                    $faculty_count_f_s = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 's' ,'program_id' => $program_obj->get_id(), 'academic_year' => $this->get_year()), 'teaching_staff');
                    $faculty_count_f_o = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 'o' ,'program_id' => $program_obj->get_id(), 'academic_year' => $this->get_year()), 'teaching_staff');

                    $student_enrolled_m_s = \Orm_Data_Level_Enrolled::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 's' ,'program_id' => $program_obj->get_id(), 'academic_year' => $this->get_year()));
                    $student_enrolled_m_o = \Orm_Data_Level_Enrolled::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 'o' ,'program_id' => $program_obj->get_id(), 'academic_year' => $this->get_year()));

                    $student_enrolled_f_s = \Orm_Data_Level_Enrolled::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 's' ,'program_id' => $program_obj->get_id(), 'academic_year' => $this->get_year()));
                    $student_enrolled_f_o = \Orm_Data_Level_Enrolled::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 'o' ,'program_id' => $program_obj->get_id(), 'academic_year' => $this->get_year()));

                    $workload_classsize_m = \Orm_Data_Workload::get_average(array('gender' => \Orm_User::GENDER_FEMALE, 'program_id' => $program_obj->get_id(), 'academic_year' => $this->get_year()));
                    $workload_classsize_f = \Orm_Data_Workload::get_average(array('gender' => \Orm_User::GENDER_MALE, 'program_id' => $program_obj->get_id(), 'academic_year' => $this->get_year()));

                    $workload_m = round($workload_classsize_m['work_load'], 2);
                    $class_size_m = round($workload_classsize_m['class_size'], 2);

                    $workload_f = round($workload_classsize_f['work_load'], 2);
                    $class_size_f = round($workload_classsize_f['class_size'], 2);

                    $table_2 = array();
                    $table_2[3][2]['total_Student_enrollment_s'] = $student_enrolled_m_s;
                    $table_2[3][3]['total_Student_enrollment_o'] = $student_enrolled_m_o;
                    $table_2[3][4]['numb_of_phd_holders_s'] = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 's' ,'program_id' => $program_obj->get_id(), 'academic_year' => $academic_year), 'phd_holder');
                    $table_2[3][5]['numb_of_phd_holders_o'] = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 'o' ,'program_id' => $program_obj->get_id(), 'academic_year' => $academic_year), 'phd_holder');
                    $table_2[3][6]['numb_of_Teaching_staff_s'] = $faculty_count_m_s;
                    $table_2[3][7]['numb_of_Teaching_staff_o'] = $faculty_count_m_o;
                    $table_2[3][8]['avg_class_size'] = $class_size_m;
                    $table_2[3][9]['avg_teaching_load'] = $workload_m;
                    $table_2[3][10]['student_to_teaching_staff'] = round(($faculty_count_m_o + $faculty_count_m_s)? (($student_enrolled_m_s + $student_enrolled_m_o) / ($faculty_count_m_o + $faculty_count_m_s)) : 0) . ':' . '1';

                    $table_2[4][2]['total_Student_enrollment_s'] = $student_enrolled_f_s;
                    $table_2[4][3]['total_Student_enrollment_o'] = $student_enrolled_f_o;
                    $table_2[4][4]['numb_of_phd_holders_s'] = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 's' ,'program_id' => $program_obj->get_id(), 'academic_year' => $academic_year), 'phd_holder');
                    $table_2[4][5]['numb_of_phd_holders_o'] = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 'o' ,'program_id' => $program_obj->get_id(), 'academic_year' => $academic_year), 'phd_holder');
                    $table_2[4][6]['numb_of_Teaching_staff_s'] = $faculty_count_f_s;
                    $table_2[4][7]['numb_of_Teaching_staff_o'] = $faculty_count_f_o;
                    $table_2[4][8]['avg_class_size'] = $class_size_f;
                    $table_2[4][9]['avg_teaching_load'] = $workload_f;
                    $table_2[4][10]['student_to_teaching_staff'] = round(($faculty_count_f_o + $faculty_count_f_s)? (($student_enrolled_f_s + $student_enrolled_f_o) / ($faculty_count_f_o + $faculty_count_f_s)) : 0) . ':' . '1';

                    $table_2[5][2]['total_Student_enrollment_s'] = ($student_enrolled_m_s + $student_enrolled_f_s);
                    $table_2[5][3]['total_Student_enrollment_o'] = ($student_enrolled_m_o + $student_enrolled_f_o);
                    $table_2[5][4]['numb_of_phd_holders_s'] = \Orm_Data_Periodic_Program::get_sum(array('nationality' => 's' ,'program_id' => $program_obj->get_id(), 'academic_year' => $academic_year), 'phd_holder');
                    $table_2[5][5]['numb_of_phd_holders_o'] = \Orm_Data_Periodic_Program::get_sum(array('nationality' => 'o' ,'program_id' => $program_obj->get_id(), 'academic_year' => $academic_year), 'phd_holder');
                    $table_2[5][6]['numb_of_Teaching_staff_s'] = $faculty_count_m_s + $faculty_count_f_s;
                    $table_2[5][7]['numb_of_Teaching_staff_o'] = $faculty_count_m_o + $faculty_count_f_o;
                    $table_2[5][8]['avg_class_size'] = ($class_size_m + $class_size_f) / 2;
                    $table_2[5][9]['avg_teaching_load'] = ($workload_m + $workload_f) / 2;
                    $table_2[5][10]['student_to_teaching_staff'] = round(($faculty_count_m_o + $faculty_count_m_s + $faculty_count_f_o + $faculty_count_f_s)? (($student_enrolled_m_s + $student_enrolled_m_o + $student_enrolled_f_s + $student_enrolled_f_o) / ($faculty_count_m_o + $faculty_count_m_s + $faculty_count_f_o + $faculty_count_f_s)) : 0) . ':' . '1';

                    $this->set_table_2($table_2);

                    $table_3 = array();

                    $faculty_count = \Orm_Data_Faculty::get_one(array('academic_year' => $this->get_year(),'program_id' => $program_obj->get_id()));

                    $table_3[4][1]['values'] = $faculty_count->get_prof_male();
                    $table_3[4][2]['values'] = 0;
                    $table_3[4][3]['values'] = $faculty_count->get_prof_female();
                    $table_3[4][4]['values'] = 0;
                    $table_3[4][5]['values'] = $faculty_count->get_associate_prof_male();
                    $table_3[4][6]['values'] = 0;
                    $table_3[4][7]['values'] = $faculty_count->get_associate_prof_female();
                    $table_3[4][8]['values'] = 0;
                    $table_3[4][9]['values'] = $faculty_count->get_assistant_prof_male();
                    $table_3[4][10]['values'] = 0;
                    $table_3[4][11]['values'] = $faculty_count->get_assistant_prof_female();
                    $table_3[4][12]['values'] = 0;
                    $table_3[4][13]['values'] = $faculty_count->get_instructor_male();
                    $table_3[4][14]['values'] = 0;
                    $table_3[4][15]['values'] = $faculty_count->get_instructor_female();
                    $table_3[4][16]['values'] = 0;
                    $table_3[4][17]['values'] = $faculty_count->get_teaching_assistant_male();
                    $table_3[4][18]['values'] = 0;
                    $table_3[4][19]['values'] = $faculty_count->get_teaching_assistant_female();
                    $table_3[4][20]['values'] = 0;
                    $table_3[4][21]['values'] = $faculty_count->get_total();
                    $table_3[4][22]['values'] = 0;

                    $this->set_table_3($table_3);

                    $table_4 = array();


                    $bsc_ids =  array_column(\Orm_Program::get_model()->get_all(array('department_id' => $program_obj->get_department_id(),'degree_id' => '5'),0,0,array(),\Orm::FETCH_ARRAY),'id');
                    $diploma_ids =  array_column(\Orm_Program::get_model()->get_all(array('department_id' => $program_obj->get_department_id(),'degree_id' => '3'),0,0,array(),\Orm::FETCH_ARRAY),'id');
                    $higher_diploma_ids =  array_column(\Orm_Program::get_model()->get_all(array('department_id' => $program_obj->get_department_id(),'degree_id' => '6'),0,0,array(),\Orm::FETCH_ARRAY),'id');
                    $masters_ids =  array_column(\Orm_Program::get_model()->get_all(array('department_id' => $program_obj->get_department_id(),'degree_id' => '8'),0,0,array(),\Orm::FETCH_ARRAY),'id');
                    $phd_ids =  array_column(\Orm_Program::get_model()->get_all(array('department_id' => $program_obj->get_department_id(),'degree_id' => '10'),0,0,array(),\Orm::FETCH_ARRAY),'id');
                    $bsc_ids[] = 0;
                    $diploma_ids[] = 0;
                    $higher_diploma_ids[] = 0;
                    $masters_ids[] = 0;
                    $phd_ids[] = 0;

                    $table_4[4][2]['undergraduate_diploma_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $diploma_ids,'gender' => \Orm_User::GENDER_MALE,'nationality' => 's','academic_year'=>$this->get_year()),'graduate');
                    $table_4[4][3]['undergraduate_diploma_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $diploma_ids,'gender' => \Orm_User::GENDER_FEMALE,'nationality' => 's','academic_year'=>$this->get_year()),'graduate');
                    $table_4[4][4]['undergraduate_bachelor_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_ids,'gender' => \Orm_User::GENDER_MALE,'nationality' => 's','academic_year'=>$this->get_year()),'graduate');
                    $table_4[4][5]['undergraduate_bachelor_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_ids,'gender' => \Orm_User::GENDER_FEMALE,'nationality' => 's','academic_year'=>$this->get_year()),'graduate');
                    $table_4[4][6]['postgraduates_high_diploma_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $higher_diploma_ids,'gender' => \Orm_User::GENDER_MALE,'nationality' => 's','academic_year'=>$this->get_year()),'graduate');
                    $table_4[4][7]['postgraduates_high_diploma_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $higher_diploma_ids,'gender' => \Orm_User::GENDER_FEMALE,'nationality' => 's','academic_year'=>$this->get_year()),'graduate');
                    $table_4[4][8]['postgraduates_master_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $masters_ids,'gender' => \Orm_User::GENDER_MALE,'nationality' => 's','academic_year'=>$this->get_year()),'graduate');
                    $table_4[4][9]['postgraduates_master_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $masters_ids,'gender' => \Orm_User::GENDER_FEMALE,'nationality' => 's','academic_year'=>$this->get_year()),'graduate');
                    $table_4[4][10]['postgraduates_phd_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_ids,'gender' => \Orm_User::GENDER_MALE,'nationality' => 's','academic_year'=>$this->get_year()),'graduate');
                    $table_4[4][11]['postgraduates_phd_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_ids,'gender' => \Orm_User::GENDER_FEMALE,'nationality' => 's','academic_year'=>$this->get_year()),'graduate');

                    $table_4[5][2]['undergraduate_diploma_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $diploma_ids,'gender' => \Orm_User::GENDER_MALE,'nationality' => 'o','academic_year'=>$this->get_year()),'graduate');
                    $table_4[5][3]['undergraduate_diploma_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $diploma_ids,'gender' => \Orm_User::GENDER_FEMALE,'nationality' => 'o','academic_year'=>$this->get_year()),'graduate');
                    $table_4[5][4]['undergraduate_bachelor_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_ids,'gender' => \Orm_User::GENDER_MALE,'nationality' => 'o','academic_year'=>$this->get_year()),'graduate');
                    $table_4[5][5]['undergraduate_bachelor_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_ids,'gender' => \Orm_User::GENDER_FEMALE,'nationality' => 'o','academic_year'=>$this->get_year()),'graduate');
                    $table_4[5][6]['postgraduates_high_diploma_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $higher_diploma_ids,'gender' => \Orm_User::GENDER_MALE,'nationality' => 'o','academic_year'=>$this->get_year()),'graduate');
                    $table_4[5][7]['postgraduates_high_diploma_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $higher_diploma_ids,'gender' => \Orm_User::GENDER_FEMALE,'nationality' => 'o','academic_year'=>$this->get_year()),'graduate');
                    $table_4[5][8]['postgraduates_master_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $masters_ids,'gender' => \Orm_User::GENDER_MALE,'nationality' => 'o','academic_year'=>$this->get_year()),'graduate');
                    $table_4[5][9]['postgraduates_master_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $masters_ids,'gender' => \Orm_User::GENDER_FEMALE,'nationality' => 'o','academic_year'=>$this->get_year()),'graduate');
                    $table_4[5][10]['postgraduates_phd_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_ids,'gender' => \Orm_User::GENDER_MALE,'nationality' => 'o','academic_year'=>$this->get_year()),'graduate');
                    $table_4[5][11]['postgraduates_phd_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_ids,'gender' => \Orm_User::GENDER_FEMALE,'nationality' => 'o','academic_year'=>$this->get_year()),'graduate');

                    $table_4[6][2]['undergraduate_diploma_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $diploma_ids,'gender' => \Orm_User::GENDER_MALE,'academic_year'=>$this->get_year()),'graduate');
                    $table_4[6][3]['undergraduate_diploma_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $diploma_ids,'gender' => \Orm_User::GENDER_FEMALE,'academic_year'=>$this->get_year()),'graduate');
                    $table_4[6][4]['undergraduate_bachelor_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_ids,'gender' => \Orm_User::GENDER_MALE,'academic_year'=>$this->get_year()),'graduate');
                    $table_4[6][5]['undergraduate_bachelor_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_ids,'gender' => \Orm_User::GENDER_FEMALE,'academic_year'=>$this->get_year()),'graduate');
                    $table_4[6][6]['postgraduates_high_diploma_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $higher_diploma_ids,'gender' => \Orm_User::GENDER_MALE,'academic_year'=>$this->get_year()),'graduate');
                    $table_4[6][7]['postgraduates_high_diploma_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $higher_diploma_ids,'gender' => \Orm_User::GENDER_FEMALE,'academic_year'=>$this->get_year()),'graduate');
                    $table_4[6][8]['postgraduates_master_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $masters_ids,'gender' => \Orm_User::GENDER_MALE,'academic_year'=>$this->get_year()),'graduate');
                    $table_4[6][9]['postgraduates_master_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $masters_ids,'gender' => \Orm_User::GENDER_FEMALE,'academic_year'=>$this->get_year()),'graduate');
                    $table_4[6][10]['postgraduates_phd_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_ids,'gender' => \Orm_User::GENDER_MALE,'academic_year'=>$this->get_year()),'graduate');
                    $table_4[6][11]['postgraduates_phd_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_ids,'gender' => \Orm_User::GENDER_FEMALE,'academic_year'=>$this->get_year()),'graduate');

                    $this->set_table_4($table_4);

                    $table_5 = array();

                    $table_5[4][2]['oncmpus_program_fulltime_m'] = \Orm_Data_Graduate::get_sum(array('program_id' => $program_obj->get_id(),'gender' => \Orm_User::GENDER_MALE,'nationality' => 's','academic_year'=>$this->get_year()),'enrolled');
                    $table_5[4][3]['oncmpus_program_fulltime_f'] = \Orm_Data_Graduate::get_sum(array('program_id' => $program_obj->get_id(),'gender' => \Orm_User::GENDER_FEMALE,'nationality' => 's','academic_year'=>$this->get_year()),'enrolled');
                    $table_5[4][4]['oncmpus_program_parttime_m'] = 0;
                    $table_5[4][5]['oncmpus_program_parttime_f'] = 0;
                    $table_5[4][6]['oncmpus_program_fte_m'] = 0;
                    $table_5[4][7]['oncmpus_program_fte_f'] = 0;
                    $table_5[4][8]['distance_education_fulltime_m'] = 0;
                    $table_5[4][9]['distance_education_fulltime_f'] = 0;
                    $table_5[4][10]['distance_education_parttime_m'] = 0;
                    $table_5[4][11]['distance_education_parttime_f'] = 0;
                    $table_5[4][12]['distance_education_fte_m'] = 0;
                    $table_5[4][13]['distance_education_fte_f'] = 0;
                    $table_5[5][2]['oncmpus_program_fulltime_m'] = \Orm_Data_Graduate::get_sum(array('program_id' => $program_obj->get_id(),'gender' => \Orm_User::GENDER_MALE,'nationality' => 'o','academic_year'=>$this->get_year()),'enrolled');
                    $table_5[5][3]['oncmpus_program_fulltime_f'] = \Orm_Data_Graduate::get_sum(array('program_id' => $program_obj->get_id(),'gender' => \Orm_User::GENDER_FEMALE,'nationality' => 'o','academic_year'=>$this->get_year()),'enrolled');
                    $table_5[5][4]['oncmpus_program_parttime_m'] = 0;
                    $table_5[5][5]['oncmpus_program_parttime_f'] = 0;
                    $table_5[5][6]['oncmpus_program_fte_m'] = 0;
                    $table_5[5][7]['oncmpus_program_fte_f'] = 0;
                    $table_5[5][8]['distance_education_fulltime_m'] = 0;
                    $table_5[5][9]['distance_education_fulltime_f'] = 0;
                    $table_5[5][10]['distance_education_parttime_m'] = 0;
                    $table_5[5][11]['distance_education_parttime_f'] = 0;
                    $table_5[5][12]['distance_education_fte_m'] = 0;
                    $table_5[5][13]['distance_education_fte_f'] = 0;
                    $table_5[6][2]['oncmpus_program_fulltime_m'] = \Orm_Data_Graduate::get_sum(array('program_id' => $program_obj->get_id(),'gender' => \Orm_User::GENDER_MALE,'academic_year'=>$this->get_year()),'enrolled');
                    $table_5[6][3]['oncmpus_program_fulltime_f'] = \Orm_Data_Graduate::get_sum(array('program_id' => $program_obj->get_id(),'gender' => \Orm_User::GENDER_FEMALE,'academic_year'=>$this->get_year()),'enrolled');
                    $table_5[6][4]['oncmpus_program_parttime_m'] = 0;
                    $table_5[6][5]['oncmpus_program_parttime_f'] = 0;
                    $table_5[6][6]['oncmpus_program_fte_m'] = 0;
                    $table_5[6][7]['oncmpus_program_fte_f'] = 0;
                    $table_5[6][8]['distance_education_fulltime_m'] = 0;
                    $table_5[6][9]['distance_education_fulltime_f'] = 0;
                    $table_5[6][10]['distance_education_parttime_m'] = 0;
                    $table_5[6][11]['distance_education_parttime_f'] = 0;
                    $table_5[6][12]['distance_education_fte_m'] = 0;
                    $table_5[6][13]['distance_education_fte_f'] = 0;

                    $this->set_table_5($table_5);

                    $table_6 = array();

                    $table_6[4][2]['oncmpus_program_fulltime_m'] = \Orm_User_Faculty::get_count(array('program_id' => $program_obj->get_id(),'gender' => \Orm_User::GENDER_MALE,'nationality' => 'saudi'));
                    $table_6[4][3]['oncmpus_program_fulltime_f'] = \Orm_User_Faculty::get_count(array('program_id' => $program_obj->get_id(),'gender' => \Orm_User::GENDER_FEMALE,'nationality' => 'saudi'));
                    $table_6[4][4]['oncmpus_program_parttime_m'] = 0;
                    $table_6[4][5]['oncmpus_program_parttime_f'] = 0;
                    $table_6[4][6]['oncmpus_program_fte_m'] = 0;
                    $table_6[4][7]['oncmpus_program_fte_f'] = 0;
                    $table_6[4][8]['distance_education_fulltime_m'] = 0;
                    $table_6[4][9]['distance_education_fulltime_f'] = 0;
                    $table_6[4][10]['distance_education_parttime_m'] = 0;
                    $table_6[4][11]['distance_education_parttime_f'] = 0;
                    $table_6[4][12]['distance_education_fte_m'] = 0;
                    $table_6[4][13]['distance_education_fte_f'] = 0;

                    $table_6[5][2]['oncmpus_program_fulltime_m'] = \Orm_User_Faculty::get_count(array('program_id' => $program_obj->get_id(),'gender' => \Orm_User::GENDER_MALE,'nationality_not' => 'saudi'));
                    $table_6[5][3]['oncmpus_program_fulltime_f'] = \Orm_User_Faculty::get_count(array('program_id' => $program_obj->get_id(),'gender' => \Orm_User::GENDER_FEMALE,'nationality_not' => 'saudi'));
                    $table_6[5][4]['oncmpus_program_parttime_m'] = 0;
                    $table_6[5][5]['oncmpus_program_parttime_f'] = 0;
                    $table_6[5][6]['oncmpus_program_fte_m'] = 0;
                    $table_6[5][7]['oncmpus_program_fte_f'] = 0;
                    $table_6[5][8]['distance_education_fulltime_m'] = 0;
                    $table_6[5][9]['distance_education_fulltime_f'] = 0;
                    $table_6[5][10]['distance_education_parttime_m'] = 0;
                    $table_6[5][11]['distance_education_parttime_f'] = 0;
                    $table_6[5][12]['distance_education_fte_m'] = 0;
                    $table_6[5][13]['distance_education_fte_f'] = 0;

                    $table_6[6][2]['oncmpus_program_fulltime_m'] = \Orm_User_Faculty::get_count(array('program_id' => $program_obj->get_id(),'gender' => \Orm_User::GENDER_MALE));
                    $table_6[6][3]['oncmpus_program_fulltime_f'] = \Orm_User_Faculty::get_count(array('program_id' => $program_obj->get_id(),'gender' => \Orm_User::GENDER_FEMALE));
                    $table_6[6][4]['oncmpus_program_parttime_m'] = 0;
                    $table_6[6][5]['oncmpus_program_parttime_f'] = 0;
                    $table_6[6][6]['oncmpus_program_fte_m'] = 0;
                    $table_6[6][7]['oncmpus_program_fte_f'] = 0;
                    $table_6[6][8]['distance_education_fulltime_m'] = 0;
                    $table_6[6][9]['distance_education_fulltime_f'] = 0;
                    $table_6[6][10]['distance_education_parttime_m'] = 0;
                    $table_6[6][11]['distance_education_parttime_f'] = 0;
                    $table_6[6][12]['distance_education_fte_m'] = 0;
                    $table_6[6][13]['distance_education_fte_f'] = 0;

                    $this->set_table_6($table_6);

                    $table_7 = array();

                    foreach (\Orm_Program::get_all(array('department_id' => $program_obj->get_department_id())) as $program) {
                        if ($program->get_duration() == 4) {
                            $four_programs[] = $program->get_id();
                        } elseif ($program->get_duration() == 5) {
                            $five_programs[] = $program->get_id();
                        } elseif ($program->get_duration() == 6) {
                            $six_programs[] = $program->get_id();
                        }
                    }
                    $four_programs[] = 0;
                    $five_programs[] = 0;
                    $six_programs[] = 0;

                    $table_7[4][2]['undergraduate_programs_four_year_4'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $four_programs,'academic_year' => $this->get_year(),'number_of_years' => 4,'gender' => \Orm_User::GENDER_MALE));
                    $table_7[4][3]['undergraduate_programs_four_year_5'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $four_programs,'academic_year' => $this->get_year(),'number_of_years' => 5,'gender' => \Orm_User::GENDER_MALE));
                    $table_7[4][4]['undergraduate_programs_four_year_6'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $four_programs,'academic_year' => $this->get_year(),'number_of_years' => 6,'gender' => \Orm_User::GENDER_MALE));
                    $table_7[4][5]['undergraduate_programs_five_year_4'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $five_programs,'academic_year' => $this->get_year(),'number_of_years' => 5,'gender' => \Orm_User::GENDER_MALE));
                    $table_7[4][6]['undergraduate_programs_five_year_5'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $five_programs,'academic_year' => $this->get_year(),'number_of_years' => 6,'gender' => \Orm_User::GENDER_MALE));
                    $table_7[4][7]['undergraduate_programs_five_year_6'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $five_programs,'academic_year' => $this->get_year(),'number_of_years' => 7,'gender' => \Orm_User::GENDER_MALE));
                    $table_7[4][8]['undergraduate_programs_six_year_4'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $six_programs,'academic_year' => $this->get_year(),'number_of_years' => 6,'gender' => \Orm_User::GENDER_MALE));
                    $table_7[4][9]['undergraduate_programs_six_year_5'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $six_programs,'academic_year' => $this->get_year(),'number_of_years' => 7,'gender' => \Orm_User::GENDER_MALE));
                    $table_7[4][10]['undergraduate_programs_six_year_6'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $six_programs,'academic_year' => $this->get_year(),'number_of_years' => 8,'gender' => \Orm_User::GENDER_MALE));
                    $table_7[4][11]['postgraduate_programs_master_completion_rate'] = 0;
                    $table_7[4][12]['postgraduate_programs_phd_completion_rate'] = 0;

                    $table_7[5][2]['undergraduate_programs_four_year_4'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $four_programs,'academic_year' => $this->get_year(),'number_of_years' => 4,'gender' => \Orm_User::GENDER_FEMALE));
                    $table_7[5][3]['undergraduate_programs_four_year_5'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $four_programs,'academic_year' => $this->get_year(),'number_of_years' => 5,'gender' => \Orm_User::GENDER_FEMALE));
                    $table_7[5][4]['undergraduate_programs_four_year_6'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $four_programs,'academic_year' => $this->get_year(),'number_of_years' => 6,'gender' => \Orm_User::GENDER_FEMALE));
                    $table_7[5][5]['undergraduate_programs_five_year_4'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $five_programs,'academic_year' => $this->get_year(),'number_of_years' => 5,'gender' => \Orm_User::GENDER_FEMALE));
                    $table_7[5][6]['undergraduate_programs_five_year_5'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $five_programs,'academic_year' => $this->get_year(),'number_of_years' => 6,'gender' => \Orm_User::GENDER_FEMALE));
                    $table_7[5][7]['undergraduate_programs_five_year_6'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $five_programs,'academic_year' => $this->get_year(),'number_of_years' => 7,'gender' => \Orm_User::GENDER_FEMALE));
                    $table_7[5][8]['undergraduate_programs_six_year_4'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $six_programs,'academic_year' => $this->get_year(),'number_of_years' => 6,'gender' => \Orm_User::GENDER_FEMALE));
                    $table_7[5][9]['undergraduate_programs_six_year_5'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $six_programs,'academic_year' => $this->get_year(),'number_of_years' => 7,'gender' => \Orm_User::GENDER_FEMALE));
                    $table_7[5][10]['undergraduate_programs_six_year_6'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $six_programs,'academic_year' => $this->get_year(),'number_of_years' => 8,'gender' => \Orm_User::GENDER_FEMALE));
                    $table_7[5][11]['postgraduate_programs_master_completion_rate'] = 0;
                    $table_7[5][12]['postgraduate_programs_phd_completion_rate'] = 0;

                    $table_7[6][2]['undergraduate_programs_four_year_4'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $four_programs,'academic_year' => $this->get_year(),'number_of_years' => 4));
                    $table_7[6][3]['undergraduate_programs_four_year_5'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $four_programs,'academic_year' => $this->get_year(),'number_of_years' => 5));
                    $table_7[6][4]['undergraduate_programs_four_year_6'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $four_programs,'academic_year' => $this->get_year(),'number_of_years' => 6));
                    $table_7[6][5]['undergraduate_programs_five_year_4'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $five_programs,'academic_year' => $this->get_year(),'number_of_years' => 5));
                    $table_7[6][6]['undergraduate_programs_five_year_5'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $five_programs,'academic_year' => $this->get_year(),'number_of_years' => 6));
                    $table_7[6][7]['undergraduate_programs_five_year_6'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $five_programs,'academic_year' => $this->get_year(),'number_of_years' => 7));
                    $table_7[6][8]['undergraduate_programs_six_year_4'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $six_programs,'academic_year' => $this->get_year(),'number_of_years' => 6));
                    $table_7[6][9]['undergraduate_programs_six_year_5'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $six_programs,'academic_year' => $this->get_year(),'number_of_years' => 7));
                    $table_7[6][10]['undergraduate_programs_six_year_6'] = \Orm_Data_Competion_Rate::get_sum(array('program_in' => $six_programs,'academic_year' => $this->get_year(),'number_of_years' => 8));
                    $table_7[6][11]['postgraduate_programs_master_completion_rate'] = 0;
                    $table_7[6][12]['postgraduate_programs_phd_completion_rate'] = 0;

                    $this->set_table_7($table_7);

                    $table_8 = array();

                    foreach (\Orm_User_Faculty::get_all(array('program_id' => $program_obj->get_id())) as $faculty) {
                        $courses = '';
                        foreach (\Orm_Course_Section::get_all(array('teacher_id' => $faculty->get_id())) as $course) {
                            $courses = $course->get_course_obj()->get_code('english') . ' ' . $course->get_course_obj()->get_name('english') . "\n";
                        }
                        $table_8[] = array(
                            'teaching_staff_name' => $faculty->get_full_name(),
                            'gender' => $faculty->get_gender() == \Orm_User::GENDER_MALE ? 'M' : 'F',
                            'nationality' => $faculty->get_nationality(),
                            'year' => $faculty->get_service_time(),
                            'academic_rank' => $faculty->get_academic_rank(true),
                            'general_specialty' => '',
                            'specific_specialty' => '',
                            'graduated_From' => '',
                            'highest_degree' => '',
                            'study_mode' => '',
                            'course_list' => $courses,
                            'full_part_time' => 'FT'
                        );
                    }

                    $this->set_table_8($table_8);
                }

                $this->save();
            }
        }
    }

}
