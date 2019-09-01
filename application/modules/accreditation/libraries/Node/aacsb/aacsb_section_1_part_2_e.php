<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb;

/**
 * Description of aacsb_section_1_part_2_E
 *
 * @author laith
 */
class Aacsb_Section_1_part_2_E extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard E';
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
            $this->set_textarea4('');
            $this->set_textarea5('');
            $this->set_textarea6('');
            $this->set_textarea7('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong> The accounting academic unit must be structured to ensure proper oversight, accountability, and responsibility for accounting academic operations; it must be supported by continuing resources (human, financial, infrastructure, and physical); and it must have policies and processes for continuous improvement. [OVERSIGHT, SUSTAINABILITY, AND CONTINUOUS IMPROVEMENT]</strong>');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_basis()
    {
        $property = new \Orm_Property_Fixedtext('basis', '<strong>Basis for Judgment</strong> <br/>'
            . '<ul type="circle">'
            . '<li>AACSB does not require any particular administrative structure or set of practices; however, the structure must be judged appropriate to sustain excellence and continuous improvement in accounting education within the context of a collegiate institution as described in Eligibility Criteria C.</li>'
            . '<li>The organizational structure must provide proper oversight and accountability related to accounting education</li>'
            . '<li>The accounting academic unit must have policies and processes in place to support continuous improvement and accountability.</li>'
            . '<li>The accounting academic unit must demonstrate sufficient and sustained resources (financial, human, physical, infrastructural, etc.) to fulfill its mission, expected outcomes, and strategies and must demonstrate continued viability in regards to degree programs, scholarship, and other mission components. If the accounting academic unit has started new accounting programs since its last initial accreditation or maintenance of accreditation review, it may need to produce additional information about those programs, much as it would during an initial accreditation review.</li>'
            . '</ul>');
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
        $property->set_description('Describe the organizational structure of the accounting academic unit, providing an organizational chart that identifies the unit in the context of the larger institution (if applicable).');
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
        $property->set_description('Provide an overview of the structure of the unit, its policies, and processes to ensure continuous improvement and accountability related to teaching and learning for the accounting degree program. This overview also should include the policies and processes that encourage and support intellectual contributions that influence the theory, practice, and/or teaching of accounting.');
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
        $property->set_description('Summarize the budget, source of funds, and financial performance for the most recent academic year. Describe the financial resources of the accounting academic unit in relationship to the financial resources of the business academic unit (e.g., compare accounting degree enrollments as a fraction of the business academic unit’s total enrollment).');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea3()
    {
        return $this->get_property('textarea3')->get_value();
    }

    public function set_textarea4($value)
    {
        $property = new \Orm_Property_Textarea('textarea4', $value);
        $property->set_description('Describe trends in resources available to the accounting academic unit, including those related to finances, facilities, information technology infrastructure, human, and library resources. Discuss the impact of resources on the accounting academic unit’s operations, outcomes (graduates, research, etc.), and potential for mission achievement.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea4()
    {
        return $this->get_property('textarea4')->get_value();
    }

    public function set_textarea5($value)
    {
        $property = new \Orm_Property_Textarea('textarea5', $value);
        $property->set_description('Describe the total faculty resources for the accounting academic unit, including the number of faculty members on staff, the highest degree level (doctoral, master’s, and bachelor’s) of each faculty member, and the disciplinary area of each faculty member. For each accounting degree program, describe the delivery model (e.g., traditional classroom models, online or distance models, models that blend traditional classroom with distance delivery, other technology-supported approaches). Extend this analysis to each location where programs are delivered. A fully online degree program is considered a location. If accounting degree programs are delivered through different delivery models, provide an overview of how faculty and professional staff are deployed to support the delivery of accounting degree programs by degree, location, and/or delivery mode.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea5()
    {
        return $this->get_property('textarea5')->get_value();
    }

    public function set_textarea6($value)
    {
        $property = new \Orm_Property_Textarea('textarea6', $value);
        $property->set_description('Describe the accounting academic unit resources that are committed to other mission-related activities beyond accounting degree programs and intellectual contributions.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea6()
    {
        return $this->get_property('textarea6')->get_value();
    }

    public function set_textarea7($value)
    {
        $property = new \Orm_Property_Textarea('textarea7', $value);
        $property->set_description('For continuation of accounting accreditation reviews, document incremental changes rather than the details required for initial reviews.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea7()
    {
        return $this->get_property('textarea7')->get_value();
    }

}
