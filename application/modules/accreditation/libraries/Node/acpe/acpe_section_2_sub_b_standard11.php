<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_2_sub_b_standard11
 *
 * @author ahmadgx
 */
class Acpe_Section_2_Sub_B_Standard11 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 11: Interprofessional Education (IPE)';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_education('');
            $this->set_key('');
            $this->set_team_dynamic('');
            $this->set_interprofessional('');
            $this->set_team_practice('');
    }

    public function set_education()
    {
        $property = new \Orm_Property_Fixedtext('education', 'The curriculum prepares all students to provide entry-level, patient-centered care in a variety of practice settings as a contributing member of an interprofessional team. In the aggregate, team exposure includes prescribers as well as other healthcare professionals.');
        $this->set_property($property);
    }

    public function get_education()
    {
        return $this->get_property('education')->get_value();
    }

    public function set_key()
    {
        $property = new \Orm_Property_Fixedtext('key', '<b>Key Element:</b>');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_key()
    {
        return $this->get_property('key')->get_value();
    }

    public function set_team_dynamic($value)
    {
        $property = new \Orm_Property_Textarea('team_dynamic', $value);
        $property->set_description('11.1. Interprofessional team dynamics – All students demonstrate competence in interprofessional team dynamics, including articulating the values and ethics that underpin interprofessional practice, engaging in effective interprofessional communication, including conflict resolution and documentation skills, and honoring interprofessional roles and responsibilities. Interprofessional team dynamics are introduced, reinforced, and practiced in the didactic and Introductory Pharmacy Practice Experience (IPPE) components of the curriculum, and competency is demonstrated in Advanced Pharmacy Practice Experience (APPE) practice settings.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_team_dynamic()
    {
        return $this->get_property('team_dynamic')->get_value();
    }

    public function set_interprofessional($value)
    {
        $property = new \Orm_Property_Textarea('interprofessional', $value);
        $property->set_description('11.2. Interprofessional team education – To advance collaboration and quality of patient care, the didactic and experiential curricula include opportunities for students to learn about, from, and with other members of the interprofessional healthcare team. Through interprofessional education activities, students gain an understanding of the abilities, competencies, and scope of practice of team members. Some, but not all, of these educational activities may be simulations.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_interprofessional()
    {
        return $this->get_property('interprofessional')->get_value();
    }

    public function set_team_practice($value)
    {
        $property = new \Orm_Property_Textarea('team_practice', $value);
        $property->set_description('11.3. Interprofessional team practice – All students competently participate as a healthcare team member in providing direct patient care and engaging in shared therapeutic decision-making. They participate in experiential educational activities with prescribers/student prescribers and other student/professional healthcare team members, including face-to-face interactions that are designed to advance interprofessional team effectiveness');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_team_practice()
    {
        return $this->get_property('team_practice')->get_value();
    }

}
