<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\abet_eac;

/**
 * Description of criterion_2
 *
 * @author ahmadgx
 */
class Criterion_2 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'CRITERION 2. PROGRAM EDUCATIONAL OBJECTIVES';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_mission('');
            $this->set_mission_statement('');
            $this->set_program_educational('');
            $this->set_program_educational_objective('');
            $this->set_program_consistence('');
            $this->set_program_consistance_mission('');
            $this->set_program_constituencies('');
            $this->set_program_constituencies_list('');
            $this->set_process('');
            $this->set_review_process('');
    }

    public function set_mission()
    {
        $property = new \Orm_Property_Fixedtext('mission', '<b>A. Mission Statement</b>');
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_mission()
    {
        return $this->get_property('mission')->get_value();
    }

    public function set_mission_statement($value)
    {
        $property = new \Orm_Property_Textarea('mission_statement', $value);
        $property->set_description('Provide the institutional mission statement.');
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_mission_statement()
    {
        return $this->get_property('mission_statement')->get_value();
    }

    public function set_program_educational()
    {
        $property = new \Orm_Property_Fixedtext('program_educational', '<b>B. Program Educational Objectives</b>');
        $property->set_group('group_b');
        $this->set_property($property);
    }

    public function get_program_educational()
    {
        return $this->get_property('program_educational')->get_value();
    }

    public function set_program_educational_objective($value)
    {
        $property = new \Orm_Property_Textarea('program_educational_objective', $value);
        $property->set_description('List the program educational objectives and state where these can be found by the general public.');
        $property->set_group('group_b');
        $this->set_property($property);
    }

    public function get_program_educational_objective()
    {
        return $this->get_property('program_educational_objective')->get_value();
    }

    public function set_program_consistence()
    {
        $property = new \Orm_Property_Fixedtext('program_consistence', '<b>C. Consistency of the Program Educational Objectives with the Mission of the Institution</b>');
        $property->set_group('group_c');
        $this->set_property($property);
    }

    public function get_program_consistence()
    {
        return $this->get_property('program_consistence')->get_value();
    }

    public function set_program_consistance_mission($value)
    {
        $property = new \Orm_Property_Textarea('program_consistance_mission', $value);
        $property->set_description('Describe how the program educational objectives are consistent with the mission of the institution.');
        $property->set_group('group_c');
        $this->set_property($property);
    }

    public function get_program_consistance_mission()
    {
        return $this->get_property('program_consistance_mission')->get_value();
    }

    public function set_program_constituencies()
    {
        $property = new \Orm_Property_Fixedtext('program_constituencies', '<b>D. Program Constituencies</b>');
        $property->set_group('group_d');
        $this->set_property($property);
    }

    public function get_program_constituencies()
    {
        return $this->get_property('program_constituencies')->get_value();
    }

    public function set_program_constituencies_list($value)
    {
        $property = new \Orm_Property_Textarea('program_constituencies_list', $value);
        $property->set_description('List the program constituencies. Describe how the program educational objectives meet the needs of these constituencies.');
        $property->set_group('group_d');
        $this->set_property($property);
    }

    public function get_program_constituencies_list()
    {
        return $this->get_property('program_constituencies_list')->get_value();
    }

    public function set_process()
    {
        $property = new \Orm_Property_Fixedtext('process', '<b>E. Process for Review of the Program Educational Objectives</b>');
        $property->set_group('group_e');
        $this->set_property($property);
    }

    public function get_process()
    {
        return $this->get_property('process')->get_value();
    }

    public function set_review_process($value)
    {
        $property = new \Orm_Property_Textarea('review_process', $value);
        $property->set_description('Describe the process that periodically reviews the program educational objectives including how the program’s various constituencies are involved in this process.  Describe how this process is systematically utilized to ensure that the program’s educational objectives remain consistent with the institutional mission, the program constituents’ needs and these criteria.');
        $property->set_group('group_e');
        $this->set_property($property);
    }

    public function get_review_process()
    {
        return $this->get_property('review_process')->get_value();
    }

}
