<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of Ssri_B_Institutional_Pro
 *
 * @author ahmadgx
 */
class Ssri_B_Institutional_Pro extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'B. Institutional Profile';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_info('');
            $this->set_history_of_institution('');
            $this->set_management_and_organizational('');
            $this->set_institution_accreditation('');
            $this->set_institution_quality('');
            $this->set_institution_strategic_plan('');
            $this->set_institution_achievements('');
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $childrens = array();

        $childrens[] = new Ssri_Template_A1();
        $childrens[] = new Ssri_Template_A2();

        return $childrens;
    }

    /*
     * info
     */

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'The Institutional Profile is a summary of information and statistical data that provides a clear picture of the institution.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    /*
     * 1.history_of_institution
     */

    public function set_history_of_institution($value)
    {
        $property = new \Orm_Property_Textarea('history_of_institution', $value);
        $property->set_description("1. A brief summary of the institution’s history, brief description of branch campuses/"
            . " locations, total number of colleges, programs, institutes, research units /research chair /research centers,"
            . " medical hospitals and centers, plus descriptions of scale and range of activities");
        $this->set_property($property);
    }

    public function get_history_of_institution()
    {
        return $this->get_property('history_of_institution')->get_value();
    }

    /*
     * 2.management_and_organizational
     */

    public function set_management_and_organizational($value)
    {
        $property = new \Orm_Property_Textarea('management_and_organizational', $value);
        $property->set_description("2. A description of the management and organizational structure using an organizational chart");
        $this->set_property($property);
    }

    public function get_management_and_organizational()
    {
        return $this->get_property('management_and_organizational')->get_value();
    }

    /*
     * 3.institution_accreditation
     */

    public function set_institution_accreditation($value)
    {
        $property = new \Orm_Property_Textarea('institution_accreditation', $value);
        $property->set_description("3. Summary information about the institution’s accreditation status including the outcomes of any previous institutional reviews, "
            . "and any conditions that were established");
        $this->set_property($property);
    }

    public function get_institution_accreditation()
    {
        return $this->get_property('institution_accreditation')->get_value();
    }

    /*
     * 4.institution’s quality
     */

    public function set_institution_quality($value)
    {
        $property = new \Orm_Property_Textarea('institution_quality', $value);
        $property->set_description("4. A description of the institution’s quality assurance arrangements,"
            . " priorities for development, and any special issues affecting its operations");
        $this->set_property($property);
    }

    public function get_institution_quality()
    {
        return $this->get_property('institution_quality')->get_value();
    }

    /*
     * 5.institution's strategic plan
     */

    public function set_institution_strategic_plan($value)
    {
        $property = new \Orm_Property_Textarea('institution_strategic_plan', $value);
        $property->set_description("5. A summary of the institution's strategic plan."
            . " (A copy of the actual strategic plan should be available).");
        $this->set_property($property);
    }

    public function get_institution_strategic_plan()
    {
        return $this->get_property('institution_strategic_plan')->get_value();
    }

    /*
     * 6.
     */

    public function set_institution_achievements($value)
    {
        $property = new \Orm_Property_Textarea('institution_achievements', $value);
        $property->set_description("6. A list of the institution's achievements, awards, and significant accomplishments");
        $this->set_property($property);
    }

    public function get_institution_achievements()
    {
        return $this->get_property('institution_achievements')->get_value();
    }

}
