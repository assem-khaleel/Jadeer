<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\abet_etac;

/**
 * Description of background_info
 *
 * @author ahmadgx
 */
class Background_Info extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'BACKGROUND INFORMATION';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_contact_info(array());
            $this->set_program_history('');
            $this->set_program_history_feilds('');
            $this->set_option('');
            $this->set_options_list('');
            $this->set_program_delivery('');
            $this->set_program_delivery_modes('');
            $this->set_program_location('');
            $this->set_program_locations('');
            $this->set_public_disclosure('');
            $this->set_public_disclosure_provider('');
            $this->set_deficiencies('');
            $this->set_weakness('');
    }

    public function set_contact_info($value)
    {
        $property = new \Orm_Property_Add_More('contact_info', $value);
        $property->set_description('A. Contact Information');

        $name = new \Orm_Property_Text('name');
        $name->set_description('Name');
        $property->add_property($name);

        $email_address = new \Orm_Property_Text('email_address');
        $email_address->set_description('Mailing Address');
        $property->add_property($email_address);

        $telephone = new \Orm_Property_Text('telephone');
        $telephone->set_description('Telephone Number');
        $property->add_property($telephone);

        $fax_number = new \Orm_Property_Text('fax_number');
        $fax_number->set_description('Fax Number');
        $property->add_property($fax_number);

        $email = new \Orm_Property_Text('email');
        $email->set_description('e-mail address for the primary pre-visit contact person for the program');
        $property->add_property($email);

        $this->set_property($property);
    }

    public function get_contact_info()
    {
        return $this->get_property('contact_info')->get_value();
    }

    public function set_program_history()
    {
        $property = new \Orm_Property_Fixedtext('program_history', '<strong>B. Program History</strong>');
        $property->set_group('group_b');
        $this->set_property($property);
    }

    public function get_program_history()
    {
        return $this->get_property('program_history')->get_value();
    }

    public function set_program_history_feilds($value)
    {
        $property = new \Orm_Property_Textarea('program_history_feilds', $value);
        $property->set_description('Include the year implemented and the date of the last general review.  Summarize major program changes with an emphasis on changes occurring since the last general review.');
        $property->set_group('group_b');
        $this->set_property($property);
    }

    public function get_program_history_feilds()
    {
        return $this->get_property('program_history_feilds')->get_value();
    }

    public function set_option()
    {
        $property = new \Orm_Property_Fixedtext('option', '<strong>C. Options</strong>');
        $property->set_group('group_c');
        $this->set_property($property);
    }

    public function get_option()
    {
        return $this->get_property('option')->get_value();
    }

    public function set_options_list($value)
    {
        $property = new \Orm_Property_Textarea('options_list', $value);
        $property->set_description('List and describe any options, tracks, concentrations, etc. included in the program.');
        $property->set_group('group_c');
        $this->set_property($property);
    }

    public function get_options_list()
    {
        return $this->get_property('options_list')->get_value();
    }

    public function set_program_delivery()
    {
        $property = new \Orm_Property_Fixedtext('program_delivery', '<strong>D. Program Delivery Modes</strong>');
        $property->set_group('group_d');
        $this->set_property($property);
    }

    public function set_program_delivery_modes($value)
    {
        $property = new \Orm_Property_Textarea('program_delivery_modes', $value);
        $property->set_description('Describe the delivery modes used by this program, e.g., days, evenings, weekends, cooperative education, traditional lecture/laboratory, off-campus, distance education, web-based, etc.');
        $property->set_group('group_d');
        $this->set_property($property);
    }

    public function get_program_delivery_modes()
    {
        return $this->get_property('program_delivery_modes')->get_value();
    }

    public function set_program_location()
    {
        $property = new \Orm_Property_Fixedtext('program_location', '<strong>E. Program Locations</strong>');
        $property->set_group('group_e');
        $this->set_property($property);
    }

    public function get_program_location()
    {
        return $this->get_property('program_location')->get_value();
    }

    public function set_program_locations($value)
    {
        $property = new \Orm_Property_Textarea('program_locations', $value);
        $property->set_description('Include all locations where the program or a portion of the program is regularly offered (this would also include dual degrees, international partnerships, etc.).');
        $property->set_group('group_e');
        $this->set_property($property);
    }

    public function get_program_locations()
    {
        return $this->get_property('program_locations')->get_value();
    }

    public function set_public_disclosure()
    {
        $property = new \Orm_Property_Fixedtext('public_disclosure', '<strong>F. Public Disclosure</strong>');
        $property->set_group('group_f');
        $this->set_property($property);
    }

    public function get_public_disclosure()
    {
        return $this->get_property('public_disclosure')->get_value();
    }

    public function set_public_disclosure_provider($value)
    {
        $property = new \Orm_Property_Textarea('public_disclosure_provider', $value);
        $property->set_description('Provide information concerning all the places where the Program Education Objectives (PEOs), Student Outcomes (SOs), annual student enrollment and graduation data is posted or made accessible to the public.  If this information is posted to the Web, please provide the URLs.');
        $property->set_group('group_f');
        $this->set_property($property);
    }

    public function get_public_disclosure_provider()
    {
        return $this->get_property('public_disclosure_provider')->get_value();
    }

    public function set_deficiencies()
    {
        $property = new \Orm_Property_Fixedtext('deficiencies', '<strong>G. Deficiencies, Weaknesses or Concerns from Previous Evaluation(s) and the Actions Taken to Address Them</strong>');
        $property->set_group('group_g');
        $this->set_property($property);
    }

    public function get_deficiencies()
    {
        return $this->get_property('deficiencies')->get_value();
    }

    public function set_weakness($value)
    {
        $property = new \Orm_Property_Textarea('weakness', $value);
        $property->set_description('Summarize the Deficiencies, Weaknesses, or Concerns remaining from the most recent ABET Final Statement.  Describe the actions taken to address them, including effective dates of actions, if applicable.  If this is an initial accreditation, it should be so indicated');
        $property->set_group('group_g');
        $this->set_property($property);
    }

    public function get_weakness()
    {
        return $this->get_property('weakness')->get_value();
    }

}
