<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb;

/**
 * Description of aacsb_section_1_part_1_b
 *
 * @author laith
 */
class Aacsb_Section_1_part_1_B extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard B';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_basis();
            $this->set_guide();
            $this->set_textarea1('');
            $this->set_textarea2('');
            $this->set_textarea3('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong> The accounting academic unit maintains a collegiate environment in which students, faculty, administrators, professional staff, and practitioners interact and collaborate in support of learning, scholarship, and community engagement. [COLLEGIATE ENVIRONMENT]</strong> <br/> <br/><strong>Basis for Judgment</strong>');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_basis()
    {
        $property = new \Orm_Property_Fixedtext('basis', '<ul type="circle"><li>Collegiate environments are characterized by scholarship, scholarly approaches to accounting education, and a focus on advanced learning. Accounting academic units should provide scholarly education at a level consistent with higher education in accounting.</li>'
            . '<li>In collegiate environments, students, faculty, administrators, professional staff, and practitioners interact and collaborate as a community. Regardless of the delivery mode for degree programs, accounting academic units should provide an environment supporting interaction and engagement among students, administrators, faculty, professional staff, and practitioners.</li>'
            . '<li>Collegiate environments are characterized by the involvement of faculty and professional staff in governance and university service. Accounting academic units must show that governance processes include the input of and engagement with faculty and professional staff.</li></ul>');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_basis()
    {
        return $this->get_property('basis')->get_value();
    }

    public function set_guide()
    {
        $property = new \Orm_Property_Fixedtext('guide', '<strong>Guidance for Documentation</strong>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_guide()
    {
        return $this->get_property('guide')->get_value();
    }

    public function set_textarea1($value)
    {
        $property = new \Orm_Property_Textarea('textarea1', $value);
        $property->set_description('Provide an overview of the degree programs offered and evidence that the quality of these programs is at a level consistent with higher education in accounting');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea1()
    {
        return $this->get_property('textarea1')->get_value();
    }

    public function set_textarea2($value)
    {
        $property = new \Orm_Property_Textarea('textarea2', $value);
        $property->set_description('Describe the environment in which students, faculty, professional staff, and practitioners interact; provide examples of activities that demonstrate the ways they interact; and show how the accounting academic unit supports such interactions. Discuss the governance process, indicating how faculty are engaged or how faculty otherwise inform decisions');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea2()
    {
        return $this->get_property('textarea2')->get_value();
    }

    public function set_textarea3($value)
    {
        $property = new \Orm_Property_Textarea('textarea3', $value);
        $property->set_description('Provide documents that characterize the culture and environment of the accounting academic unit, including statements of values, faculty and student handbooks, etc.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea3()
    {
        return $this->get_property('textarea3')->get_value();
    }

}
