<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of provisional_accreditation
 *
 * @author ahmadgx
 */
class Provisional_Accreditation extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Information Required by the NCAAA in a Proposal for Provisional Accreditation of an Institution';
    protected $link_pdf = true;
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_send_to_review = true;

    public function init()
    {
        parent::init();

            $this->set_introduction('');
            $this->set_institution_name('');
            $this->set_additional_information('');
            $this->set_proposed_location('');
            $this->set_circumstances('');
            $this->set_field_and_level_Study('');
            $this->set_title_and_levels('');
            $this->set_timline('');
            $this->set_facilities_and_equipment('');
            $this->set_note('');
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $childrens = array();
        $childrens[] = new Provisional_Accreditation_Quality_Standards();

        return $childrens;
    }

    public function set_introduction()
    {
        $property = new \Orm_Property_Fixedtext('introduction', 'A detailed proposal is required.  The proposal should set out plans for the institution that contain sufficient information to demonstrate that requirements for quality assurance and accreditation will be met. This information should be presented in an unbound, page numbered report; single sided, with a table of contents. Where supporting information required is in separate documents these should be referred to in the text of the proposal and attached as numbered appendices.  A copy of the documents should be provided in English or Arabic as determined by the Commission in hard copy and in electronic form on CD. <br/> <br/><strong>Descriptive and General Information</strong>');
        $this->set_property($property);
    }

    public function get_introduction()
    {
        return $this->get_property('introduction')->get_value();
    }

    public function set_institution_name($value)
    {
        $property = new \Orm_Property_Text('institution_name', $value);
        $property->set_description('The title of the institution');
        $this->set_property($property);
    }

    public function get_institution_name()
    {
        return $this->get_property('institution_name')->get_value();
    }

    public function set_additional_information($value)
    {
        $property = new \Orm_Property_Text('additional_information', $value);
        $property->set_description('Name and contact details of a person from whom additional information can be obtained');
        $this->set_property($property);
    }

    public function get_additional_information()
    {
        return $this->get_property('additional_information')->get_value();
    }

    public function set_proposed_location($value)
    {
        $property = new \Orm_Property_Text('proposed_location', $value);
        $property->set_description('The existing and/or proposed location of the institutions campus or campuses');
        $this->set_property($property);
    }

    public function get_proposed_location()
    {
        return $this->get_property('proposed_location')->get_value();
    }

    public function set_circumstances($value)
    {
        $property = new \Orm_Property_Textarea('circumstances', $value);
        $property->set_description('A brief statement of any special issues or circumstances affecting the development of the institution');
        $this->set_property($property);
    }

    public function get_circumstances()
    {
        return $this->get_property('circumstances')->get_value();
    }

    public function set_field_and_level_Study($value)
    {
        $property = new \Orm_Property_Textarea('field_and_level_Study', $value);
        $property->set_description('Fields of study and levels to which programs are to be offered within the first five years.');
        $this->set_property($property);
    }

    public function get_field_and_level_Study()
    {
        return $this->get_property('field_and_level_Study')->get_value();
    }

    public function set_title_and_levels($value)
    {
        $property = new \Orm_Property_Textarea('title_and_levels', $value);
        $property->set_description('Titles and levels of academic awards for programs to be offered within the first five years with details for each campus where more than one campus is proposed.');
        $this->set_property($property);
    }

    public function get_title_and_levels()
    {
        return $this->get_property('title_and_levels')->get_value();
    }

    public function set_timline($value)
    {
        $property = new \Orm_Property_Textarea('timline', $value);
        $property->set_description('Time line for establishment of the institution including development of facilities and provision of major equipment, staffing, and commencement of programs, with the numbers of students expected to be enrolled on a year by year basis for the first five years.');
        $this->set_property($property);
    }

    public function get_timline()
    {
        return $this->get_property('timline')->get_value();
    }

    public function set_facilities_and_equipment($value)
    {
        $property = new \Orm_Property_Textarea('facilities_and_equipment', $value);
        $property->set_description('Facilities and equipment must be sufficient for the courses to be offered in the first year, adequate for the number of students to be enrolled, and there must be firm commitments for further developments to meet requirements duringsubsequent years to meet the requirements for the planned numbers of students and programs.');
        $this->set_property($property);
    }

    public function get_facilities_and_equipment()
    {
        return $this->get_property('facilities_and_equipment')->get_value();
    }

    public function set_note()
    {
        $property = new \Orm_Property_Fixedtext('note', 'Staffing must include the staff required to lead the development of each program to be offered and carry out teaching responsibilities (i.e. a fully qualified and appropriately experienced head of department or program coordinator in the field concerned should be appointed, and staff employed to teach the courses to be offered in the first and each subsequent year.)  Evidence of the availability of teaching staff could include completed contracts of employment with appropriate commencement dates prior to the start of the classes concerned.');
        $this->set_property($property);
    }

    public function get_note()
    {
        return $this->get_property('note')->get_value();
    }

    public function after_node_load()
    {
        parent::after_node_load();
        $this->set_institution_name(\Orm_Institution::get_university_name('english'));
    }

}
