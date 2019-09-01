<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ses_standard_2_4
 *
 * @author ahmadgx
 */
class Ses_Standard_2_4 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '2.4 Integrity';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_2_4_1('');
            $this->set_2_4_2('');
            $this->set_2_4_3('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Teaching and other staff involved with the program must meet high ethical standards of honesty and integrity including avoidance of conflicts of interest and avoidance of plagiarism in their teaching, research, administrative and service functions.  These standards must be maintained in all dealings with students, teaching and other staff, and in relationships with other internal and external agencies including both government and non government organizations.</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_2_4_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_4_1', $value);
        $property->set_description('2.4.1 Codes of practice for ethical and responsible behaviour have been developed and are followed dealing with matters such as the conduct and reporting on research, performance evaluation, student assessment, committee decision making, and the conduct of administrative and service activities.');
        $this->set_property($property);
    }

    public function get_2_4_1()
    {
        return $this->get_property('2_4_1')->get_value();
    }

    public function set_2_4_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_4_2', $value);
        $property->set_description('2.4.2 Regulations dealing with declarations of pecuniary interest or conflict of interest for faculty and staff are consistently followed.');
        $this->set_property($property);
    }

    public function get_2_4_2()
    {
        return $this->get_property('2_4_2')->get_value();
    }

    public function set_2_4_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_4_3', $value);
        $property->set_description('2.4.3 Advertising and promotional material are always truthful, avoid any actual or implied misrepresentations or exaggerated claims, or negative comments about other programs or institutions.');
        $this->set_property($property);
    }

    public function get_2_4_3()
    {
        return $this->get_property('2_4_3')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('2_4_1');
        $property->add_property_name('2_4_2');
        $property->add_property_name('2_4_3');
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
