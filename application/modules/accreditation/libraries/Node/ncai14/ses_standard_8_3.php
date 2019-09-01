<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of Ses_Standard_8_3
 *
 * @author user
 */
class Ses_Standard_8_3 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '8.3 Auditing and Risk assessment';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_8_3_1('');
            $this->set_8_3_2('');
            $this->set_8_3_3('');
            $this->set_8_3_4('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Risk assessment and auditing processes must provide for effective risk analysis and thorough independent verification of financial processes and reports in keeping with applicable accounting standards.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_8_3_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('8_3_1', $value);
        $property->set_description('8.3.1 Planning processes include independently verified risk assessment.');
        $this->set_property($property);
    }

    public function get_8_3_1()
    {
        return $this->get_property('8_3_1')->get_value();
    }

    public function set_8_3_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('8_3_2', $value);
        $property->set_description('8.3.2 Risk minimization strategies are in place and adequate reserves maintained to meet realistically assessed financial risks.');
        $this->set_property($property);
    }

    public function get_8_3_2()
    {
        return $this->get_property('8_3_2')->get_value();
    }

    public function set_8_3_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('8_3_3', $value);
        $property->set_description('8.3.3 Internal audit processes operate independently of accounting and business managers, reporting directly to the Rector or Dean or chair of the relevant governing board committee.');
        $this->set_property($property);
    }

    public function get_8_3_3()
    {
        return $this->get_property('8_3_3')->get_value();
    }

    public function set_8_3_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('8_3_4', $value);
        $property->set_description('8.3.4 External audits are conducted annually by an independent government agency or a reputable external audit firm that is independent of the institution, financial, or other senior staff in the institution, and members of the governing body.');
        $this->set_property($property);
    }

    public function get_8_3_4()
    {
        return $this->get_property('8_3_4')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('8_3_1');
        $property->add_property_name('8_3_2');
        $property->add_property_name('8_3_3');
        $property->add_property_name('8_3_4');
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
