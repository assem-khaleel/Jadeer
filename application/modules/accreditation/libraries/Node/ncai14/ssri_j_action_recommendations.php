<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of ssri_j_action_recommendations
 *
 * @author ahmadgx
 */
class Ssri_J_Action_Recommendations extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'J. Action Recommendations';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();
        $this->set_action_recommendations_text();
        $this->set_recommendation(array());
    }

    /*
    public function set_action_recommendation($value)
    {
        $property = new \Orm_Property_Table_Dynamic('action_recommendation', $value);
        $property->set_description('Action recommendations are based on the recommendations for improvement and other matters identified earlier in the SSRI. Choose major action recommendations and indicate specific actions that are proposed to deal with the most important priorities for action that have been identified. Priorities of greatest urgency should be identified.  For each proposed action recommendations there should be a person responsible for the action, a specified timelines, and any necessary resources required');

        $action = new \Orm_Property_Textarea('action');
        $action->set_description('Action Recommendation');
        $action->set_enable_tinymce(0);
        $action->set_width(180);
        $property->add_property($action);

        $person_responsible = new \Orm_Property_Text('person_responsible');
        $person_responsible->set_description('Person (s) responsible');
        $person_responsible->set_width(180);
        $property->add_property($person_responsible);

        $timeline = new \Orm_Property_Textarea('timeline');
        $timeline->set_description('Timelines (For total initiative and for major stages of development)');
        $timeline->set_enable_tinymce(0);
        $timeline->set_width(180);
        $property->add_property($timeline);

        $resources_required = new \Orm_Property_Textarea('resources_required');
        $resources_required->set_description('Resources Required');
        $resources_required->set_enable_tinymce(0);
        $resources_required->set_width(180);
        $property->add_property($resources_required);

        $this->set_property($property);
    }

    public function get_action_recommendation()
    {
        return $this->get_properties('action_recommendation')->get_value();
    }

    */
    public function set_action_recommendations_text()
    {
        $property = new \Orm_Property_Fixedtext('action_recommendations_text','Action recommendations are based on the recommendations for improvement and other matters identified earlier in the SSRI. Choose major action recommendations and indicate specific actions that are proposed to deal with the most important priorities for action that have been identified. Priorities of greatest urgency should be identified.  For each proposed action recommendations there should be a person responsible for the action, a specified timelines, and any necessary resources required');
        $this->set_property($property);
    }

    public function get_action_recommendations_text()
    {
        return $this->get_property('action_recommendations_text')->get_value();
    }

    public function set_recommendation($value)
    {
        $recommendation_property = new \Orm_Property_Table_Dynamic('recommendations', $value);

        $action = new \Orm_Property_Textarea('action');
        $action->set_description('Action Recommendation');
        $action->set_enable_tinymce(1);
        $action->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $action->set_width(180);
        $recommendation_property->add_property($action);

        $person_responsible = new \Orm_Property_Textarea('person_responsible');
        $person_responsible->set_description('Person (s) responsible');
        $person_responsible->set_enable_tinymce(0);
        $person_responsible->set_width(150);
        $recommendation_property->add_property($person_responsible);

        $timeline = new \Orm_Property_Textarea('timeline');
        $timeline->set_description('Timelines (For total initiative and for major stages of development)');
        $timeline->set_enable_tinymce(1);
        $timeline->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $timeline->set_width(180);
        $recommendation_property->add_property($timeline);

        $resources_required = new \Orm_Property_Textarea('resources_required');
        $resources_required->set_description('Resources Required');
        $resources_required->set_enable_tinymce(1);
        $resources_required->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $resources_required->set_width(180);
        $recommendation_property->add_property($resources_required);

        $property = new \Orm_Property_Table('recommendation', $value);
        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('text', '', '1. Mission and Objectives'));
        $property->add_cell(2, 1, $recommendation_property);
        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('text', '', '2. Governance and Administration'));
        $property->add_cell(4, 1, $recommendation_property);
        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('text', '', '3. Management of Quality Assurance and Improvement'));
        $property->add_cell(6, 1, $recommendation_property);
        $property->add_cell(7, 1, new \Orm_Property_Fixedtext('text', '', '4. Learning and Teaching'));
        $property->add_cell(8, 1, $recommendation_property);
        $property->add_cell(9, 1, new \Orm_Property_Fixedtext('text', '', '5. Student Administration and Support Services'));
        $property->add_cell(10, 1, $recommendation_property);
        $property->add_cell(11, 1, new \Orm_Property_Fixedtext('text', '', '6. Learning Resources'));
        $property->add_cell(12, 1, $recommendation_property);
        $property->add_cell(13, 1, new \Orm_Property_Fixedtext('text', '', '7. Facilities and Equipment'));
        $property->add_cell(14, 1, $recommendation_property);
        $property->add_cell(15, 1, new \Orm_Property_Fixedtext('text', '', '8. Financial Planning and Management'));
        $property->add_cell(16, 1, $recommendation_property);
        $property->add_cell(17, 1, new \Orm_Property_Fixedtext('text', '', '9. Employment Processes'));
        $property->add_cell(18, 1, $recommendation_property);
        $property->add_cell(19, 1, new \Orm_Property_Fixedtext('text', '', '10. Research'));
        $property->add_cell(20, 1, $recommendation_property);
        $property->add_cell(21, 1, new \Orm_Property_Fixedtext('text', '', '11. Institutional Relationships with the Community'));
        $property->add_cell(22, 1, $recommendation_property);

        $this->set_property($property);
    }

    public function get_recommendation()
    {
        return $this->get_property('recommendation')->get_value();
    }

}
