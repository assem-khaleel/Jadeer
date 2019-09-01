<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of provisional_accreditation
 *
 * @author ahmadgx
 */
class Provisional_Accreditation extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Application for Provisional Accreditation of a Higher Education Institution';
    protected $link_pdf = true;
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_send_to_review = true;

    public function init()
    {
        parent::init();

            $this->set_application_summary('');
            $this->set_institution('');
            $this->set_location('');
            $this->set_approval_date('');
            $this->set_commencement_date('');
            $this->set_student_enrollments(array());
            $this->set_foundation(array());
            $this->set_highet_education_program(array());
            $this->set_note('');
            $this->set_statement_mission('');
            $this->set_patner_name('');
            $this->set_language('');
            $this->set_existing_institution('');
            $this->set_document('');
            $this->set_letter('');
            $this->set_proposal('');
            $this->set_proposal_accreditation('');
            $this->set_agreement_copy('');
    }

    public function set_application_summary()
    {
        $property = new \Orm_Property_Fixedtext('application_summary', '<strong>Application Summary</strong>');
        $this->set_property($property);
    }

    public function get_application_summary()
    {
        return $this->get_property('application_summary')->get_value();
    }

    public function set_institution($value)
    {
        $property = new \Orm_Property_Text('institution', $value);
        $property->set_description('1. Name of institution');
        $this->set_property($property);
    }

    public function get_institution()
    {
        return $this->get_property('institution')->get_value();
    }

    public function set_location($value)
    {
        $property = new \Orm_Property_Text('location', $value);
        $property->set_description('2. Location(s)');
        $this->set_property($property);
    }

    public function get_location()
    {
        return $this->get_property('location')->get_value();
    }

    public function set_approval_date($value)
    {
        $property = new \Orm_Property_Text('approval_date', $value);
        $property->set_description('3. Date of approval of initial license to establish institution');
        $this->set_property($property);
    }

    public function get_approval_date()
    {
        return $this->get_property('approval_date')->get_value();
    }

    public function set_commencement_date($value)
    {
        $property = new \Orm_Property_Text('commencement_date', $value);
        $property->set_description('4. Date of commencement');
        $this->set_property($property);
    }

    public function get_commencement_date()
    {
        return $this->get_property('commencement_date')->get_value();
    }

    public function set_student_enrollments($value)
    {
        $property = new \Orm_Property_Table('student_enrollments', $value);
        $property->set_description('5. Actual and/or planned student enrolments within six years of commencement ');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('', ''), 2, 0);
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('number_of_Student', 'Number of Students'), 0, 3);
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('number_of_course', 'No of Courses Offered'), 2, 0);

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('male', 'Male'));
        $property->add_cell(2, 2, new \Orm_Property_Fixedtext('female', 'Female'));
        $property->add_cell(2, 3, new \Orm_Property_Fixedtext('total', 'Total'));

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('year_1', 'Year 1'));
        $property->add_cell(3, 2, new \Orm_Property_Text('male_1'));
        $property->add_cell(3, 3, new \Orm_Property_Text('female_1'));
        $property->add_cell(3, 4, new \Orm_Property_Text('total_1'));
        $property->add_cell(3, 5, new \Orm_Property_Text('course_1'));

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('year_2', 'Year 2'));
        $property->add_cell(4, 2, new \Orm_Property_Text('male_2'));
        $property->add_cell(4, 3, new \Orm_Property_Text('female_2'));
        $property->add_cell(4, 4, new \Orm_Property_Text('total_2'));
        $property->add_cell(4, 5, new \Orm_Property_Text('course_2'));

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('year_3', 'Year 3'));
        $property->add_cell(5, 2, new \Orm_Property_Text('male_3'));
        $property->add_cell(5, 3, new \Orm_Property_Text('female_3'));
        $property->add_cell(5, 4, new \Orm_Property_Text('total_3'));
        $property->add_cell(5, 5, new \Orm_Property_Text('course_3'));

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('year_4', 'Year 4'));
        $property->add_cell(6, 2, new \Orm_Property_Text('male_4'));
        $property->add_cell(6, 3, new \Orm_Property_Text('female_4'));
        $property->add_cell(6, 4, new \Orm_Property_Text('total_4'));
        $property->add_cell(6, 5, new \Orm_Property_Text('course_4'));

        $property->add_cell(7, 1, new \Orm_Property_Fixedtext('year_5', 'Year 5'));
        $property->add_cell(7, 2, new \Orm_Property_Text('male_5'));
        $property->add_cell(7, 3, new \Orm_Property_Text('female_5'));
        $property->add_cell(7, 4, new \Orm_Property_Text('total_5'));
        $property->add_cell(7, 5, new \Orm_Property_Text('course_5'));

        $property->add_cell(8, 1, new \Orm_Property_Fixedtext('year_6', 'Year 6'));
        $property->add_cell(8, 2, new \Orm_Property_Text('male_6'));
        $property->add_cell(8, 3, new \Orm_Property_Text('female_6'));
        $property->add_cell(8, 4, new \Orm_Property_Text('total_6'));
        $property->add_cell(8, 5, new \Orm_Property_Text('course_6'));

        $this->set_property($property);
    }

    public function get_student_enrollments()
    {
        return $this->get_property('student_enrollments')->get_value();
    }

    public function set_foundation($value)
    {
        $property = new \Orm_Property_Table_Dynamic('foundation', $value);
        $property->set_description('6.  Proposed Programs and levels of awards (include foundation or preparatory year if these are planned)');
        $foundation = new \Orm_Property_Text('foundation');
        $foundation->set_description('Foundation or Preparatory Year (if applicable)');
        $foundation->set_width(200);
        $property->add_property($foundation);

        $study_area = new \Orm_Property_Text('study_area');
        $study_area->set_description('Areas of Study');
        $study_area->set_width(200);
        $property->add_property($study_area);

        $introduction_year = new \Orm_Property_Text('introduction_year');
        $introduction_year->set_description('Year of Introduction');
        $introduction_year->set_width(200);
        $property->add_property($introduction_year);

        $this->set_property($property);
    }

    public function get_foundation()
    {
        return $this->get_property('foundation')->get_value();
    }

    public function set_highet_education_program($value)
    {
        $property = new \Orm_Property_Table_Dynamic('highet_education_program', $value);

        $program = new \Orm_Property_Text('program');
        $program->set_description('Higher Education Program Title(s)');
        $program->set_width(170);
        $property->add_property($program);

        $study_field = new \Orm_Property_Text('study_field');
        $study_field->set_description('Field of Study');
        $study_field->set_width(170);
        $property->add_property($study_field);

        $major_track = new \Orm_Property_Text('major_track');
        $major_track->set_description('Major Study or Track(s)');
        $major_track->set_width(170);
        $property->add_property($major_track);

        $introduction_year = new \Orm_Property_Text('introduction_year');
        $introduction_year->set_description('Year of Introduction');
        $introduction_year->set_width(170);
        $property->add_property($introduction_year);

        $this->set_property($property);
    }

    public function get_highet_education_program()
    {
        return $this->get_property('highet_education_program')->get_value();
    }

    public function set_note()
    {
        $property = new \Orm_Property_Fixedtext('note', '(Notes:  Levels of Awards must be consistent with Qualifications Framework) Extend table as necessary to include programs planned for the first five years. Detailed program proposals will be required for those to be offered within the first three years.)');
        $this->set_property($property);
    }

    public function get_note()
    {
        return $this->get_property('note')->get_value();
    }

    public function set_statement_mission($value)
    {
        $property = new \Orm_Property_Textarea('statement_mission', $value);
        $property->set_description('7. Statement of  Mission');
        $this->set_property($property);
    }

    public function get_statement_mission()
    {
        return $this->get_property('statement_mission')->get_value();
    }

    public function set_patner_name($value)
    {
        $property = new \Orm_Property_Text('patner_name', $value);
        $property->set_description('8. Name of partner or sponsoring institution (if any)');
        $this->set_property($property);
    }

    public function get_patner_name()
    {
        return $this->get_property('patner_name')->get_value();
    }

    public function set_language($value)
    {
        $property = new \Orm_Property_Text('language', $value);
        $property->set_description('9. Language(s) of Instruction');
        $this->set_property($property);
    }

    public function get_language()
    {
        return $this->get_property('language')->get_value();
    }

    public function set_existing_institution($value)
    {
        $property = new \Orm_Property_Text('existing_institution', $value);
        $property->set_description('10. Existing institution(s) to be included in a merged institution (if any)');
        $this->set_property($property);
    }

    public function get_existing_institution()
    {
        return $this->get_property('existing_institution')->get_value();
    }

    public function set_document()
    {
        $property = new \Orm_Property_Fixedtext('document', '<strong>Documents to be submitted with Application</strong>');
        $this->set_property($property);
    }

    public function get_document()
    {
        return $this->get_property('document')->get_value();
    }

    public function set_letter($value)
    {
        $property = new \Orm_Property_Upload('letter', $value);
        $property->set_description('1. Letter granting the initial license to establish the institution');
        $this->set_property($property);
    }

    public function get_letter()
    {
        return $this->get_property('letter')->get_value();
    }

    public function set_proposal($value)
    {
        $property = new \Orm_Property_Upload('proposal', $value);
        $property->set_description('2. Detailed proposal for provisional accreditation of the institution with attachments as required.');
        $this->set_property($property);
    }

    public function get_proposal()
    {
        return $this->get_property('proposal')->get_value();
    }

    public function set_proposal_accreditation($value)
    {
        $property = new \Orm_Property_Upload('proposal_accreditation', $value);
        $property->set_description('3. Proposals for provisional accreditation of programs to be offered within the first three years.');
        $this->set_property($property);
    }

    public function get_proposal_accreditation()
    {
        return $this->get_property('proposal_accreditation')->get_value();
    }

    public function set_agreement_copy($value)
    {
        $property = new \Orm_Property_Upload('agreement_copy', $value);
        $property->set_description('4. Copy of agreement with partner institution (if any)');
        $this->set_property($property);
    }

    public function get_agreement_copy()
    {
        return $this->get_property('agreement_copy')->get_value();
    }

    public function after_node_load()
    {
        parent::after_node_load();
        $this->set_institution(\Orm_Institution::get_university_name('english'));
    }

}
