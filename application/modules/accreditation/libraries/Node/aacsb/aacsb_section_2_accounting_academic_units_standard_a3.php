<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb;

/**
 * Description of aacsb_section_2_accounting_academic_units_standard_a3
 *
 * @author laith
 */
class Aacsb_Section_2_Accounting_Academic_Units_Standard_A3 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard A3';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_guide();
            $this->set_textarea1('');
            $this->set_textarea2('');
            $this->set_textarea3('');
            $this->set_textarea4('');
            $this->set_textarea5('');
            $this->set_info2();
            $this->set_table(array());
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>The accounting academic unit has financial strategies to provide resources appropriate to, and sufficient for, achieving its mission and action items. [FINANCIAL STRATEGIES AND ALLOCATION OF RESOURCES—RELATED BUSINESS STANDARD 3]</strong> <br/> <br/>'
            . '<strong>Basis for Judgment</strong> <br/>'
            . '<ul type="circle">'
            . '<li>The accounting academic unit has realistic financial strategies to provide, sustain, and improve quality accounting education. The financial model must support high-quality degree programs for all teaching and learning delivery modes.</li>'
            . '<li>The unit has adequate financial resources to provide infrastructure to fit its activities (e.g., campus-based learning, distance learning, research, and executive education). Classrooms, offices, laboratories, communications, computer equipment, and other basic facilities are adequate for high-quality operations.</li>'
            . '<li>The unit has adequate financial resources to provide support services for students, including academic advising and career development, and for faculty, including instructional support and professional development.</li>'
            . '<li>The unit has adequate financial resources to provide technology support for students and faculty appropriate to its programs (e.g., online learning, classroom simulations) and intellectual contribution expectations (e.g., databases and data analysis software).</li>'
            . '<li>The unit has adequate financial resources to support high-quality faculty intellectual contributions and their impact in accordance with its mission, expected outcomes, and strategies.</li>'
            . '<li>The unit identifies realistic sources of financial resources for any current and planned activities. The unit has analyzed carefully the costs and potential resources for initiatives associated with its mission and action items.</li>'
            . '</ul>');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
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
        $property->set_description('Describe the accounting academic unit’s financial resources and strategies for sustaining those resources demonstrating they are capable of supporting, sustaining, and improving quality consistent with the mission of the school (unit). Provide an analysis of trend in resources over the past five-years, especially in light of different cost structures depending on the teaching and learning models employed.');
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
        $property->set_description('Describe the contingency planning process that the unit would use should a reduction in resources occur. The accounting academic unit should be prepared to discuss the specifics of this planning process and expected outcomes with the peer review team.');
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
        $property->set_description('Describe the financial support for all major strategic activities (e.g., degree programs, intellectual contributions, and other mission components).');
        $property->set_group('section_2');
        $this->set_property($property);
    }

    public function get_textarea3()
    {
        return $this->get_property('textarea3')->get_value();
    }

    public function set_textarea4($value)
    {
        $property = new \Orm_Property_Textarea('textarea4', $value);
        $property->set_description('Describe the unit’s financial support for student advising and placement, student and faculty technology, and faculty intellectual contributions and professional development. Such services may be shared with other academic units or may be an institutional resource.');
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
        $property->set_description('In alignment with the unit’s financial resources, show the sources of funding for the three to four most significant major initiatives using a table similar to the one on the next page.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea5()
    {
        return $this->get_property('textarea5')->get_value();
    }

    public function set_info2()
    {
        $property = new \Orm_Property_Fixedtext('info2', 'The table outlines the unit’s major initiatives, the implementation timetable, and funding. The initiatives identified must be clearly linked to the unit’s mission, expected outcomes, and supporting strategies and reflect substantive actions that support mission success, impact, and innovation. This information allows a peer review team to understand what planning the unit has done and how this planning fits with the unit’s mission, financial resources, and strategies. The accounting academic unit should append to the table narrative explanations of how these action items will enhance mission fulfillment and whether these actions could necessitate revisions to the mission.');
        $property->set_group('table');
        $this->set_property($property);
    }

    public function get_info2()
    {
        return $this->get_property('info2')->get_value();
    }

    public function set_table($value)
    {
        $property = new \Orm_Property_Table_Dynamic('table', $value);

        $initiative = new \Orm_Property_Text('initiative');
        $initiative->set_description('Initiative');
        $initiative->set_width(150);
        $property->add_property($initiative);

        $start_date = new \Orm_Property_Text('start_date');
        $start_date->set_description('Start Date');
        $start_date->set_width(150);
        $property->add_property($start_date);

        $revenue = new \Orm_Property_Text('revenue');
        $revenue->set_description('First Year Cost or Revenue');
        $revenue->set_width(150);
        $property->add_property($revenue);

        $annual_cost = new \Orm_Property_Text('annual_cost');
        $annual_cost->set_description('Continuing Annual Cost or Revenue');
        $annual_cost->set_width(150);
        $property->add_property($annual_cost);

        $source = new \Orm_Property_Text('source');
        $source->set_description('Source or Disposition of Funds');
        $source->set_width(150);
        $property->add_property($source);
        $property->set_group('table');
        $this->set_property($property);
    }

    public function get_table()
    {
        return $this->get_property('table')->get_value();
    }

}
