<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of ses_standard_4_6
 *
 * @author user
 */
class Ses_Standard_4_6 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '4.6 Educational Assistance for Students';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_4_6_1('');
            $this->set_4_6_2('');
            $this->set_4_6_3('');
            $this->set_4_6_4('');
            $this->set_4_6_5('');
            $this->set_4_6_6('');
            $this->set_4_6_7('');
            $this->set_4_6_8('');
            $this->set_4_6_9('');
            $this->set_4_6_10('');
            $this->set_4_6_11('');
            $this->set_4_6_12('');
            $this->set_4_6_13('');
            $this->set_4_6_14('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Effective systems must be in place for assisting student learning through academic advice, study facilities, monitoring student progress, encouraging high performing students and provision of assistance when needed by individuals.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_4_6_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_6_1', $value);
        $property->set_description('4.6.1 Teaching staff are available at sufficient scheduled times for consultation and advice to students. (this is confirmed, not simply scheduled, and if there are part time as well as full time students the scheduled times provide for access by both groups)');
        $this->set_property($property);
    }

    public function get_4_6_1()
    {
        return $this->get_property('4_6_1')->get_value();
    }

    public function set_4_6_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_6_2', $value);
        $property->set_description('4.6.2 Teaching resources (including staffing, learning resources and equipment, and clinical or other field placements) should be sufficient to ensure achievement of the intended learning outcomes.');
        $this->set_property($property);
    }

    public function get_4_6_2()
    {
        return $this->get_property('4_6_2')->get_value();
    }

    public function set_4_6_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_6_3', $value);
        $property->set_description('4.6.3 If arrangements for student academic counselling and advice include electronic communications through email or other means the effectiveness of those processes is evaluated through means such as analysis of response times and student evaluations.');
        $this->set_property($property);
    }

    public function get_4_6_3()
    {
        return $this->get_property('4_6_3')->get_value();
    }

    public function set_4_6_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_6_4', $value);
        $property->set_description('4.6.4 Adequate tutorial assistance is provided to ensure understanding and ability to apply learning.');
        $this->set_property($property);
    }

    public function get_4_6_4()
    {
        return $this->get_property('4_6_4')->get_value();
    }

    public function set_4_6_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_6_5', $value);
        $property->set_description('4.6.5 Appropriate preparatory and orientation mechanisms are used to prepare students for study in a higher education environment. Particular attention is given to preparation for the language of instruction, self directed learning, and transition programs if necessary for students transferring to the institution with credit for previous studies.');
        $this->set_property($property);
    }

    public function get_4_6_5()
    {
        return $this->get_property('4_6_5')->get_value();
    }

    public function set_4_6_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_6_6', $value);
        $property->set_description('4.6.6 Preparatory studies are not counted within the credit hours for the programs that follow.');
        $this->set_property($property);
    }

    public function get_4_6_6()
    {
        return $this->get_property('4_6_6')->get_value();
    }

    public function set_4_6_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_6_7', $value);
        $property->set_description('4.6.7   For any programs in which the language of instruction is not Arabic, action is taken to ensure that language skills are adequate for instruction in that language before students begin their higher education studies.  (This may be done through language training prior to admission to the program.  Language skills expected on entry should be benchmarked against other highly regarded institutions with the objective of skills at least comparable to minimum requirements for admission of international students in universities in countries where that language is the native language. (Verification of standards should involve testing of at least a representative sample of students on a major recognized language test.)');
        $this->set_property($property);
    }

    public function get_4_6_7()
    {
        return $this->get_property('4_6_7')->get_value();
    }

    public function set_4_6_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_6_8', $value);
        $property->set_description('4.6.8 If preparatory programs are required but outsourced to other providers the institution accepts  responsibility for ensuring the quality of these programs and ensures that required standards for entry are met.');
        $this->set_property($property);
    }

    public function get_4_6_8()
    {
        return $this->get_property('4_6_8')->get_value();
    }

    public function set_4_6_9($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_6_9', $value);
        $property->set_description('4.6.9 Systems are in place within each program throughout the institution for monitoring and coordinating student workload across courses.');
        $this->set_property($property);
    }

    public function get_4_6_9()
    {
        return $this->get_property('4_6_9')->get_value();
    }

    public function set_4_6_10($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_6_10', $value);
        $property->set_description('4.6.10 Systems are in place for monitoring the progress of individual students and assistance and/or counselling is provided to those facing difficulties.');
        $this->set_property($property);
    }

    public function get_4_6_10()
    {
        return $this->get_property('4_6_10')->get_value();
    }

    public function set_4_6_11($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_6_11', $value);
        $property->set_description('4.6.11 Year to year progression rates and program completion rates are monitored, and action taken to help any categories or types of students needing help.');
        $this->set_property($property);
    }

    public function get_4_6_11()
    {
        return $this->get_property('4_6_11')->get_value();
    }

    public function set_4_6_12($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_6_12', $value);
        $property->set_description('4.6.12 Adequate facilities are available for private study with access to computer terminals and other necessary equipment.');
        $this->set_property($property);
    }

    public function get_4_6_12()
    {
        return $this->get_property('4_6_12')->get_value();
    }

    public function set_4_6_13($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_6_13', $value);
        $property->set_description('4.6.13 Teaching staff are familiar with the range of support services available in the institution for students, and refer them to appropriate sources of assistance when required.');
        $this->set_property($property);
    }

    public function get_4_6_13()
    {
        return $this->get_property('4_6_13')->get_value();
    }

    public function set_4_6_14($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_6_14', $value);
        $property->set_description('4.6.14 The adequacy of arrangements for assistance to students should be periodically assessed through processes that include, but are not restricted to, feedback from students.');
        $this->set_property($property);
    }

    public function get_4_6_14()
    {
        return $this->get_property('4_6_14')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('4_6_1');
        $property->add_property_name('4_6_2');
        $property->add_property_name('4_6_3');
        $property->add_property_name('4_6_4');
        $property->add_property_name('4_6_5');
        $property->add_property_name('4_6_6');
        $property->add_property_name('4_6_7');
        $property->add_property_name('4_6_8');
        $property->add_property_name('4_6_9');
        $property->add_property_name('4_6_10');
        $property->add_property_name('4_6_11');
        $property->add_property_name('4_6_12');
        $property->add_property_name('4_6_13');
        $property->add_property_name('4_6_14');
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
