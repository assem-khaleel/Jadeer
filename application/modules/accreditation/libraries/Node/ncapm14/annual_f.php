<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncapm14;

/**
 * Description of Annual_F
 *
 * @author user
 */
class Annual_F extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'F. Summary Program Evaluation';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info1();
            $this->set_date_of_survey_graduating('');
            $this->set_attach_survey('');
            $this->set_list_improvement_strengths('');
            $this->set_analysis('');
            $this->set_changes_propsed('');
            $this->set_info2();
            $this->set_describe_evaluation_process('');
            $this->set_attach_review_report('');
            $this->set_list_suggestions_for_improvement('');
            $this->set_analysis_of_recommendations_for_improvement('');
            $this->set_changes_proposed_in_the_program('');
            $this->set_ratings_on_sub_standerds();
            $this->set_rating_substandard_of_standard_4(array());
            $this->set_analysis_of_sub_standards('');
    }

    public function set_info1()
    {
        $property = new \Orm_Property_Fixedtext('info1', '<strong>1. Graduating Student Evaluations (surveys)</strong>');
        $this->set_property($property);
    }

    public function get_info1()
    {
        return $this->get_property('info1')->get_value();
    }

    public function set_date_of_survey_graduating($value)
    {
        $property = new \Orm_Property_Text('date_of_survey_graduating', $value);
        $property->set_description('Date of Survey');
        $this->set_property($property);
    }

    public function get_date_of_survey_graduating()
    {
        return $this->get_property('date_of_survey_graduating')->get_value();
    }

    public function set_attach_survey($value)
    {
        $property = new \Orm_Property_Textarea('attach_survey', $value);
        $property->set_description('Attach survey report');
        $this->set_property($property);
    }

    public function get_attach_survey()
    {
        return $this->get_property('attach_survey')->get_value();
    }

    public function set_list_improvement_strengths($value)
    {
        $property = new \Orm_Property_Textarea('list_improvement_strengths', $value);
        $property->set_description('a. List most important recommendations for improvement, strengths and suggestions');
        $this->set_property($property);
    }

    public function get_list_improvement_strengths()
    {
        return $this->get_property('list_improvement_strengths')->get_value();
    }

    public function set_analysis($value)
    {
        $property = new \Orm_Property_Textarea('analysis', $value);
        $property->set_description('Analysis (e.g. Assessment, action already taken, other considerations, strengths and recommendation for improvement.)');
        $this->set_property($property);
    }

    public function get_analysis()
    {
        return $this->get_property('analysis')->get_value();
    }

    public function set_changes_propsed($value)
    {
        $property = new \Orm_Property_Textarea('changes_propsed', $value);
        $property->set_description('b. Changes proposed in the program (if any) in response to this analysis and feedback.');
        $this->set_property($property);
    }

    public function get_changes_propsed()
    {
        return $this->get_property('changes_propsed')->get_value();
    }

    public function set_info2()
    {
        $property = new \Orm_Property_Fixedtext('info2', '<strong>2. Other  Evaluation (e.g. Evaluations by employers or other stakeholders, external review)</strong>');
        $this->set_property($property);
    }

    public function get_info2()
    {
        return $this->get_property('info2')->get_value();
    }

    public function set_describe_evaluation_process($value)
    {
        $property = new \Orm_Property_Textarea('describe_evaluation_process', $value);
        $property->set_description('Describe evaluation process');
        $this->set_property($property);
    }

    public function get_describe_evaluation_process()
    {
        return $this->get_property('describe_evaluation_process')->get_value();
    }

    public function set_attach_review_report($value)
    {
        $property = new \Orm_Property_Textarea('attach_review_report', $value);
        $property->set_description('Attach review/survey report.');
        $this->set_property($property);
    }

    public function get_attach_review_report()
    {
        return $this->get_property('attach_review_report')->get_value();
    }

    public function set_list_suggestions_for_improvement($value)
    {
        $property = new \Orm_Property_Textarea('list_suggestions_for_improvement', $value);
        $property->set_description('a. List most important recommendations for improvement, strengths and suggestions for improvement.');
        $this->set_property($property);
    }

    public function get_list_suggestions_for_improvement()
    {
        return $this->get_property('list_suggestions_for_improvement')->get_value();
    }

    public function set_analysis_of_recommendations_for_improvement($value)
    {
        $property = new \Orm_Property_Textarea('analysis_of_recommendations_for_improvement', $value);
        $property->set_description('Analysis (e.g. Analysis of recommendations for improvement: Are recommendations valid and what action will be taken, action already taken, or other considerations?)');
        $this->set_property($property);
    }

    public function get_analysis_of_recommendations_for_improvement()
    {
        return $this->get_property('analysis_of_recommendations_for_improvement')->get_value();
    }

    public function set_changes_proposed_in_the_program($value)
    {
        $property = new \Orm_Property_Textarea('changes_proposed_in_the_program', $value);
        $property->set_description('b. Changes proposed in the program (if any) in response to this feedback.');
        $this->set_property($property);
    }

    public function get_changes_proposed_in_the_program()
    {
        return $this->get_property('changes_proposed_in_the_program')->get_value();
    }

    public function set_ratings_on_sub_standerds()
    {
        $property = new \Orm_Property_Fixedtext('ratings_on_sub_standerds', '<strong>2.  Ratings on Sub-Standards of Standard 4 by program faculty and teaching staff; 4.1 to 4.10.</strong>');
        $this->set_property($property);
    }

    public function get_ratings_on_sub_standerds()
    {
        return $this->get_property('ratings_on_sub_standerds')->get_value();
    }

    public function set_rating_substandard_of_standard_4($value)
    {
        $yes_or_no = new \Orm_Property_Radio('best_practice');
        $yes_or_no->set_options(array('yes', 'no'));
        $yes_or_no->set_width(100);

        $improvement_list = new \Orm_Property_Textarea('improvement_list');
        $improvement_list->set_width(200);
        $improvement_list->set_enable_tinymce(0);

        $active_ssr = self::get_active_ssr_node();

        $filters = array();
        $filters['system_number'] = $active_ssr->get_system_number();
        $filters['parent_lft'] = $active_ssr->get_parent_lft();
        $filters['parent_rgt'] = $active_ssr->get_parent_rgt();
        $filters['item_id'] = $this->get_parent_program_node()->get_item_id();
        $filters['class_type'] = 'Node\ncassr14\Program';

        $ssr_program = self::get_one($filters);

        $smart_4_1 = new \Orm_Property_Smart_Field('smart_4_1');
        $smart_4_1->set_class('Node\ncassr14\Ses_Standard_4_1');
        $smart_4_1->set_function('get_overall_assessment');
        $smart_4_1->add_filter('system_number', $ssr_program->get_system_number());
        $smart_4_1->add_filter('parent_lft', $ssr_program->get_parent_lft());
        $smart_4_1->add_filter('parent_rgt', $ssr_program->get_parent_rgt());
        $smart_4_1->set_width(100);

        $smart_4_2 = new \Orm_Property_Smart_Field('smart_4_2');
        $smart_4_2->set_class('Node\ncassr14\Ses_Standard_4_2');
        $smart_4_2->set_function('get_overall_assessment');
        $smart_4_2->add_filter('system_number', $ssr_program->get_system_number());
        $smart_4_2->add_filter('parent_lft', $ssr_program->get_parent_lft());
        $smart_4_2->add_filter('parent_rgt', $ssr_program->get_parent_rgt());
        $smart_4_2->set_width(100);

        $smart_4_3 = new \Orm_Property_Smart_Field('smart_4_3');
        $smart_4_3->set_class('Node\ncassr14\Ses_Standard_4_3');
        $smart_4_3->set_function('get_overall_assessment');
        $smart_4_3->add_filter('system_number', $ssr_program->get_system_number());
        $smart_4_3->add_filter('parent_lft', $ssr_program->get_parent_lft());
        $smart_4_3->add_filter('parent_rgt', $ssr_program->get_parent_rgt());
        $smart_4_3->set_width(100);

        $smart_4_4 = new \Orm_Property_Smart_Field('smart_4_4');
        $smart_4_4->set_class('Node\ncassr14\Ses_Standard_4_4');
        $smart_4_4->set_function('get_overall_assessment');
        $smart_4_4->add_filter('system_number', $ssr_program->get_system_number());
        $smart_4_4->add_filter('parent_lft', $ssr_program->get_parent_lft());
        $smart_4_4->add_filter('parent_rgt', $ssr_program->get_parent_rgt());
        $smart_4_4->set_width(100);

        $smart_4_5 = new \Orm_Property_Smart_Field('smart_4_5');
        $smart_4_5->set_class('Node\ncassr14\Ses_Standard_4_5');
        $smart_4_5->set_function('get_overall_assessment');
        $smart_4_5->add_filter('system_number', $ssr_program->get_system_number());
        $smart_4_5->add_filter('parent_lft', $ssr_program->get_parent_lft());
        $smart_4_5->add_filter('parent_rgt', $ssr_program->get_parent_rgt());
        $smart_4_5->set_width(100);

        $smart_4_6 = new \Orm_Property_Smart_Field('smart_4_6');
        $smart_4_6->set_class('Node\ncassr14\Ses_Standard_4_6');
        $smart_4_6->set_function('get_overall_assessment');
        $smart_4_6->add_filter('system_number', $ssr_program->get_system_number());
        $smart_4_6->add_filter('parent_lft', $ssr_program->get_parent_lft());
        $smart_4_6->add_filter('parent_rgt', $ssr_program->get_parent_rgt());
        $smart_4_6->set_width(100);

        $smart_4_7 = new \Orm_Property_Smart_Field('smart_4_7');
        $smart_4_7->set_class('Node\ncassr14\Ses_Standard_4_7');
        $smart_4_7->set_function('get_overall_assessment');
        $smart_4_7->add_filter('system_number', $ssr_program->get_system_number());
        $smart_4_7->add_filter('parent_lft', $ssr_program->get_parent_lft());
        $smart_4_7->add_filter('parent_rgt', $ssr_program->get_parent_rgt());
        $smart_4_7->set_width(100);

        $smart_4_8 = new \Orm_Property_Smart_Field('smart_4_8');
        $smart_4_8->set_class('Node\ncassr14\Ses_Standard_4_8');
        $smart_4_8->set_function('get_overall_assessment');
        $smart_4_8->add_filter('system_number', $ssr_program->get_system_number());
        $smart_4_8->add_filter('parent_lft', $ssr_program->get_parent_lft());
        $smart_4_8->add_filter('parent_rgt', $ssr_program->get_parent_rgt());
        $smart_4_8->set_width(100);

        $smart_4_9 = new \Orm_Property_Smart_Field('smart_4_9');
        $smart_4_9->set_class('Node\ncassr14\Ses_Standard_4_9');
        $smart_4_9->set_function('get_overall_assessment');
        $smart_4_9->add_filter('system_number', $ssr_program->get_system_number());
        $smart_4_9->add_filter('parent_lft', $ssr_program->get_parent_lft());
        $smart_4_9->add_filter('parent_rgt', $ssr_program->get_parent_rgt());
        $smart_4_9->set_width(100);

        $smart_4_10 = new \Orm_Property_Smart_Field('smart_4_10');
        $smart_4_10->set_class('Node\ncassr14\Ses_Standard_4_10');
        $smart_4_10->set_function('get_overall_assessment');
        $smart_4_10->add_filter('system_number', $ssr_program->get_system_number());
        $smart_4_10->add_filter('parent_lft', $ssr_program->get_parent_lft());
        $smart_4_10->add_filter('parent_rgt', $ssr_program->get_parent_rgt());
        $smart_4_10->set_width(100);

        $property = new \Orm_Property_Table('rating_substandard_of_standard_4', $value);
        $property->set_description('(a) List sub-standards. Are the “Best Practices” followed; Yes or No? Provide a revised rating for each sub-standard. Indicate action proposed to improve performance (if any).');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('sub_standard', 'Standard 4 Sub-Standards'));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('best_practice', 'Best Practices Followed (Y/N)'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('rating', '5 Star Rating'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('improvement_list', 'List priorities for improvement.'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('4_1', '4.1'));
        $property->add_cell(2, 2, $yes_or_no);
        $property->add_cell(2, 3, $smart_4_1);
        $property->add_cell(2, 4, $improvement_list);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('4_2', '4.2'));
        $property->add_cell(3, 2, $yes_or_no);
        $property->add_cell(3, 3, $smart_4_2);
        $property->add_cell(3, 4, $improvement_list);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('4_3', '4.3'));
        $property->add_cell(4, 2, $yes_or_no);
        $property->add_cell(4, 3, $smart_4_3);
        $property->add_cell(4, 4, $improvement_list);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('4_4', '4.4'));
        $property->add_cell(5, 2, $yes_or_no);
        $property->add_cell(5, 3, $smart_4_4);
        $property->add_cell(5, 4, $improvement_list);

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('4_5', '4.5'));
        $property->add_cell(6, 2, $yes_or_no);
        $property->add_cell(6, 3, $smart_4_5);
        $property->add_cell(6, 4, $improvement_list);

        $property->add_cell(7, 1, new \Orm_Property_Fixedtext('4_6', '4.6'));
        $property->add_cell(7, 2, $yes_or_no);
        $property->add_cell(7, 3, $smart_4_6);
        $property->add_cell(7, 4, $improvement_list);

        $property->add_cell(8, 1, new \Orm_Property_Fixedtext('4_7', '4.7'));
        $property->add_cell(8, 2, $yes_or_no);
        $property->add_cell(8, 3, $smart_4_7);
        $property->add_cell(8, 4, $improvement_list);

        $property->add_cell(9, 1, new \Orm_Property_Fixedtext('4_8', '4.8'));
        $property->add_cell(9, 2, $yes_or_no);
        $property->add_cell(9, 3, $smart_4_8);
        $property->add_cell(9, 4, $improvement_list);

        $property->add_cell(10, 1, new \Orm_Property_Fixedtext('4_9', '4.9'));
        $property->add_cell(10, 2, $yes_or_no);
        $property->add_cell(10, 3, $smart_4_9);
        $property->add_cell(10, 4, $improvement_list);

        $property->add_cell(11, 1, new \Orm_Property_Fixedtext('4.10', '4.10'));
        $property->add_cell(11, 2, $yes_or_no);
        $property->add_cell(11, 3, $smart_4_10);
        $property->add_cell(11, 4, $improvement_list);

        $this->set_property($property);
    }

    public function get_rating_substandard_of_standard_4()
    {
        return $this->get_property('rating_substandard_of_standard_4')->get_value();
    }

    //Table for sub standerds.

    public function set_analysis_of_sub_standards($value)
    {
        $property = new \Orm_Property_Textarea('analysis_of_sub_standards', $value);
        $property->set_description('Analysis of Sub-standards. List the strengths and recommendations for improvement of the program’s self-evaluation of following best practices.');
        $this->set_property($property);
    }

    public function get_analysis_of_sub_standards()
    {
        return $this->get_property('analysis_of_sub_standards')->get_value();
    }

}
