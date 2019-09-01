<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ssr_i
 *
 * @author ahmadgx
 */
class Ssr_I extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'I. Independent Evaluations';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_independent_analysis('');
            $this->set_response_report('');
            $this->set_analysis_report('');
            $this->set_evaluation_report('');
    }

    public function set_independent_analysis($value)
    {
        $property = new \Orm_Property_Textarea('independent_analysis', $value);
        $property->set_description('1. Describe the process used to obtain independent analysis on the quality of the program and the reliability and validity of analyses carried out in the report.  Processes may include a review of documentation by an experienced and independent person familiar with similar programs at other institutions and who could comment on relative standards, consultancy advice or a report by a review panel, or even the results of an accreditation review by an independent agency.  An independent evaluation may be conducted in relation to the total self-study, or involve a number of separate comments by different people on different issues.');
        $this->set_property($property);
    }

    public function get_independent_analysis()
    {
        return $this->get_property('independent_analysis')->get_value();
    }

    public function set_response_report($value)
    {
        $property = new \Orm_Property_Textarea('response_report', $value);
        $property->set_description('2. Summary of matters raised by independent evaluator(s). Provide a response report to each of the recommendations provided by the independent evaluators ');
        $this->set_property($property, true);
    }

    public function get_response_report()
    {
        return $this->get_property('response_report')->get_value();
    }

    public function set_analysis_report($value)
    {
        $property = new \Orm_Property_Textarea('analysis_report', $value);
        $property->set_description('3. Provide an analysis report on matters raised by independent evaluator(s) (Agree, disagree, further consideration required, action proposed, etc.).');
        $this->set_property($property);
    }

    public function get_analysis_report()
    {
        return $this->get_property('analysis_report')->get_value();
    }

    public function set_evaluation_report($value)
    {
        $property = new \Orm_Property_Upload('evaluation_report', $value);
        $property->set_description('Attach or hyperlink the independent evaluation report and CVs');
        $this->set_property($property, true);
    }

    public function get_evaluation_report()
    {
        return $this->get_property('evaluation_report')->get_value();
    }

    public function header_actions(&$actions = array()) {

        if ($this->check_if_editable()) {
            $actions[] = array(
                'class' => 'btn',
                'title' => '<i class="fa fa-database"></i> ' . lang('Integration'),
                'extra' => 'onclick="integration(this, ' . $this->get_id() . ');" ' . data_loading_text(true) . ' title="Extraction of data from other modules"'
            );
        }

        return parent::header_actions($actions);
    }

    public function integration_processes() {
        parent::integration_processes();
        $recommendations = '';
        $reports = [];
        $reviewers = \Orm_Acc_Independent_Reviewer::get_all(['type' => \Orm_Acc_Independent_Reviewer::TYPE_PROGRAM, 'type_id' => $this->get_parent_program_node()->get_item_id()]);
        foreach ($reviewers as $reviewer) {
            $recommendations .= '<strong>' . htmlfilter($reviewer->get_reviewer_obj()->get_full_name()) . '</strong> ';
            if ($reviewer->get_recommendations()) {
                $recommendations .= $reviewer->get_recommendations();
            } else {
                $recommendations .= '<p> No Recommendations </p>';
            }

            if ($reviewer->get_report_attachment()) {
                $reports[] = $reviewer->get_report_attachment();
            }
            if ($reviewer->get_cv_attachment()) {
                $reports[] = $reviewer->get_cv_attachment();
            }
        }

        $this->set_evaluation_report($reports);
        $this->set_response_report($recommendations);
        $this->save();
    }

}
