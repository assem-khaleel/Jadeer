<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ses_standard_11_2
 *
 * @author ahmadgx
 */
class Ses_Standard_11_2 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '11.2 Interactions With the Community';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_11_2_1('');
            $this->set_11_2_2('');
            $this->set_11_2_3('');
            $this->set_11_2_4('');
            $this->set_11_2_5('');
            $this->set_11_2_6('');
            $this->set_11_2_7('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Relationships must be established with the community to provide needed services and draw on community expertise to support the program.</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_11_2_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('11_2_1', $value);
        $property->set_description('11.2.1 Staff are encouraged to participate in forums in which significant community issues are discussed.');
        $this->set_property($property);
    }

    public function get_11_2_1()
    {
        return $this->get_property('11_2_1')->get_value();
    }

    public function set_11_2_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('11_2_2', $value);
        $property->set_description('11.2.2 In a professional program relationships are established with local industries and employers to participate on advisory committees and assist program delivery.  (These may include, for example, placement of students for work-study programs, part time employment opportunities, and identification of issues for analysis in student project activities.)');
        $this->set_property($property);
    }

    public function get_11_2_2()
    {
        return $this->get_property('11_2_2')->get_value();
    }

    public function set_11_2_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('11_2_3', $value);
        $property->set_description('11.2.3 Local employers and members of professions are invited to join appropriate advisory committees.');
        $this->set_property($property);
    }

    public function get_11_2_3()
    {
        return $this->get_property('11_2_3')->get_value();
    }

    public function set_11_2_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('11_2_4', $value);
        $property->set_description('11.2.4 Contacts are established with schools in the region offering assistance and support in areas of specialization, providing information about the program and subsequent career opportunities for graduates, and arranging enrichment activities for students at the schools. (If a section within the institution has responsibility for coordinating these relationships these contacts are arranged in consultation with that section.)');
        $this->set_property($property);
    }

    public function get_11_2_4()
    {
        return $this->get_property('11_2_4')->get_value();
    }

    public function set_11_2_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('11_2_5', $value);
        $property->set_description('11.2.5 Regular contact is maintained with alumni, keeping them informed about institutional developments, inviting their participation in activities, and encouraging their financial and other support for new initiatives.');
        $this->set_property($property);
    }

    public function get_11_2_5()
    {
        return $this->get_property('11_2_5')->get_value();
    }

    public function set_11_2_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('11_2_6', $value);
        $property->set_description('11.2.6 Opportunities are taken in cooperation with institutional administrators to seek funding support from individuals and organizations in the community for research and other developments associated with the program.');
        $this->set_property($property);
    }

    public function get_11_2_6()
    {
        return $this->get_property('11_2_6')->get_value();
    }

    public function set_11_2_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('11_2_7', $value);
        $property->set_description('11.2.7 Records are maintained of community services undertaken by individuals and centers or other organizations within the department and provided regularly for recording in a central data base within the institution.');
        $this->set_property($property);
    }

    public function get_11_2_7()
    {
        return $this->get_property('11_2_7')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('11_2_1');
        $property->add_property_name('11_2_2');
        $property->add_property_name('11_2_3');
        $property->add_property_name('11_2_4');
        $property->add_property_name('11_2_5');
        $property->add_property_name('11_2_6');
        $property->add_property_name('11_2_7');
        $this->set_property($property);
    }

    public function get_overall_assessment()
    {
        return $this->get_property('overall_assessment')->get_value();
    }

    public function set_comment($value)
    {
        $property = new \Orm_Property_Textarea('comment', $value);
        $property->set_description('Comment');
        $this->set_property($property);
    }

    public function get_comment()
    {
        return $this->get_property('comment')->get_value();
    }

    public function set_priorities_for_improvement($value)
    {
        $property = new \Orm_Property_Textarea('priorities_for_improvement', $value);
        $property->set_description('Priorities For Improvement');
        $this->set_property($property);
    }

    public function get_priorities_for_improvement()
    {
        return $this->get_property('priorities_for_improvement')->get_value();
    }

    public function set_independent_opinion($value)
    {
        $property = new \Orm_Property_Rank('independent_opinion', $value);
        $property->set_description('Independent Opinion');
        $this->set_property($property, true);
    }

    public function get_independent_opinion()
    {
        return $this->get_property('independent_opinion')->get_value();
    }

    public function set_independent_opinion_comment($value)
    {
        $property = new \Orm_Property_Textarea('independent_opinion_comment', $value);
        $property->set_description('Comment');
        $this->set_property($property, true);
    }

    public function get_independent_opinion_comment()
    {
        return $this->get_property('independent_opinion_comment')->get_value();
    }

}
