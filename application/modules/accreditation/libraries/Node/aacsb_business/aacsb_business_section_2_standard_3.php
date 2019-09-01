<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb_business;

/**
 * Description of aacsb_business_section_2_standard_3
 *
 * @author ahmadgx
 */
class Aacsb_Business_Section_2_Standard_3 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 3';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_standard_name('');
            $this->set_definition('');
            $this->set_business_school('');
            $this->set_contingency_planning('');
            $this->set_financial_support('');
            $this->set_school_financial_support('');
            $this->set_financial_resources('');
            $this->set_school_major('');
            $this->set_strategic_initiatives(array());
            $this->set_strategic_initiatives_note('');
    }

    public function set_standard_name()
    {
        $property = new \Orm_Property_Fixedtext('standard_name', '<b>The school has financial strategies to provide resources appropriate to, and sufficient for, achieving its mission and action items. [FINANCIAL STRATEGIES AND ALLOCATION OF RESOURCES]</b>');
        $this->set_property($property);
    }

    public function get_standard_name()
    {
        return $this->get_property('standard_name')->get_value();
    }

    public function set_definition()
    {
        $property = new \Orm_Property_Fixedtext('definition', '<strong>Basis for Judgment</strong>'
            . '<ul>'
            . '<li>The school has realistic financial strategies to provide, sustain, and improve quality management education. The financial model must support high-quality degree programs for all teaching and learning delivery modes.</li>'
            . '<li>The school has adequate financial resources to provide infrastructure to fit its activities (e.g., campus-based learning, distance learning, research, and executive education). Classrooms, offices, laboratories, communications and computer equipment, and other basic facilities are adequate for high-quality operations.</li>'
            . '<li>The school has adequate financial resources to provide support services for students, including academic advising and career development, and for faculty, including instructional support and professional development.</li>'
            . '<li>The school has adequate financial resources to provide technology support for students and faculty appropriate to its programs (e.g., online learning and classroom simulations) and intellectual contribution expectations (e.g., databases and data analysis software).</li>'
            . '<li>The school has adequate financial resources to support high-quality faculty intellectual contributions and their impact in accordance with its mission, expected outcomes, and strategies.</li>'
            . '<li>The school identifies realistic sources of financial resources for current and planned activities. The school has analyzed carefully the costs and potential resources for initiatives associated with its mission and action items.</li>'
            . '</ul><br/><br/>'
            . '<strong>Guidance for Documentation</strong>');
        $this->set_property($property);
    }

    public function get_definition()
    {
        return $this->get_property('definition')->get_value();
    }

    public function set_business_school($value)
    {
        $property = new \Orm_Property_Textarea('business_school', $value);
        $property->set_description("Describe the business school's financial resources and strategies for sustaining those resources demonstrating they are capable of supporting, sustaining, and improving quality consistent with the mission of the school. Provide an analysis of trend in resources over the past five-years, especially in light of different cost structures depending on the teaching and learning models employed.");
        $this->set_property($property);
    }

    public function get_business_school()
    {
        return $this->get_property('business_school')->get_value();
    }

    public function set_contingency_planning($value)
    {
        $property = new \Orm_Property_Textarea('contingency_planning', $value);
        $property->set_description('Describe the contingency planning process that the school would use should a reduction in resources occur. The school should be prepared to discuss the specifics of this planning process and expected outcomes with the peer review team.');
        $this->set_property($property);
    }

    public function get_contingency_planning()
    {
        return $this->get_property('contingency_planning')->get_value();
    }

    public function set_financial_support($value)
    {
        $property = new \Orm_Property_Textarea('financial_support', $value);
        $property->set_description('Describe the financial support for all major strategic activities (e.g., degree programs, intellectual contributions, and other mission components).');
        $this->set_property($property);
    }

    public function get_financial_support()
    {
        return $this->get_property('financial_support')->get_value();
    }

    public function set_school_financial_support($value)
    {
        $property = new \Orm_Property_Textarea('school_financial_support', $value);
        $property->set_description('Describe the school’s financial support for student advising and placement, student and faculty technology, and faculty intellectual contributions and professional development.');
        $this->set_property($property);
    }

    public function get_school_financial_support()
    {
        return $this->get_property('school_financial_support')->get_value();
    }

    public function set_financial_resources($value)
    {
        $property = new \Orm_Property_Textarea('financial_resources', $value);
        $property->set_description('In alignment with the school’s financial resources, show the sources of funding for the three to four most significant major initiatives using a table similar to the one on the next page.');
        $this->set_property($property);
    }

    public function get_financial_resources()
    {
        return $this->get_property('financial_resources')->get_value();
    }

    public function set_school_major()
    {
        $property = new \Orm_Property_Fixedtext('school_major', 'The table outlines the school’s major initiatives, the implementation timetable, and funding sources. The initiatives identified must be clearly linked to the school’s mission, expected outcomes, and supporting strategies and reflect substantive actions that support mission success, impact, and innovation. This information allows a peer review team to understand what planning the school has done and how this planning fits with the school’s mission, financial resources, and strategies. The school should append to the table narrative explanations of how these action items will enhance mission fulfillment and whether they could necessitate revisions to the mission.');
        $property->set_group('schools');
        $this->set_property($property);
    }

    public function get_school_major()
    {
        return $this->get_property('school_major')->get_value();
    }

    public function set_strategic_initiatives($value)
    {
        $property = new \Orm_Property_Table_Dynamic('strategic_initiatives', $value);
        $property->set_description('Financial Support for Strategic Initiatives');

        $initiative = new \Orm_Property_Textarea('initiative');
        $initiative->set_description('Initiative');
        $initiative->set_width(230);
        $initiative->set_enable_tinymce(0);
        $property->add_property($initiative);

        $start_date = new \Orm_Property_Text('start_date');
        $start_date->set_description('Start Date');
        $start_date->set_width(100);
        $property->add_property($start_date);

        $cost = new \Orm_Property_Text('cost');
        $cost->set_description('First-Year Cost or Revenue');
        $cost->set_width(100);
        $property->add_property($cost);

        $annual_cost = new \Orm_Property_Text('annual_cost');
        $annual_cost->set_description('Continuing Annual Cost or Revenue');
        $annual_cost->set_width(100);
        $property->add_property($annual_cost);

        $source = new \Orm_Property_Text('source');
        $source->set_description('Source or Disposition of Funds');
        $source->set_width(100);
        $property->add_property($source);

        $property->set_group('schools');
        $this->set_property($property);
    }

    public function get_strategic_initiatives()
    {
        return $this->get_property('strategic_initiatives')->get_value();
    }

    public function set_strategic_initiatives_note()
    {
        $property = new \Orm_Property_Fixedtext('strategic_initiatives_note', 'Note: State all amounts in USD.');
        $property->set_group('schools');
        $this->set_property($property);
    }

    public function get_strategic_initiatives_note()
    {
        return $this->get_property('strategic_initiatives_note')->get_value();
    }

}
