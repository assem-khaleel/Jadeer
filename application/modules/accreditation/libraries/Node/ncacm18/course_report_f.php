<?php
/**
 * Created by PhpStorm.
 * User: dura
 * Date: 10/9/18
 * Time: 1:03 PM
 */

namespace Node\ncacm18;


class Course_Report_F extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $name = 'F. Course Evaluation';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;


    public function init()
    {
        parent::init();
        $this->set_date('');
        $this->set_number('');
        $this->set_students_comments();
        $this->set_strengths('');
        $this->set_suggestions('');
        $this->set_number_of_participants();
        $this->set_response('');
        $this->set_attachment_survey('');
        $this->set_other_evaluation(array());
        $this->set_attachment_evaluation('');
        $this->set_recommendations('');

    }

    public function set_date($value){
        $property = new \Orm_Property_Date('date',$value);
        $property->set_description('Date of Survey');

        $property->set_group('types');
        $this->set_property($property);
    }
    public function get_date(){
        return $this->get_property('date')->get_value();

    }

    public function set_number($value){
        $property = new \Orm_Property_text('number',$value);
        $property->set_description('Number of Participants');

        $property->set_group('types');
        $this->set_property($property);
    }
    public function get_number(){
        return $this->get_property('number')->get_value();

    }

    public function set_students_comments(){
        $property = new \Orm_Property_Fixedtext('students_comments','students comments');
        $property->set_group('types');
        $this->set_property($property);
    }
    public function get_students_comments(){
        return $this->get_property('students_comments')->get_value();

    }

    public function set_strengths($value){
        $property = new \Orm_Property_Textarea('strengths',$value);
        $property->set_description('Strengths');
        $property->set_group('types');

        $this->set_property($property);
    }

    public function get_strengths(){

        return $this->get_property('strengths')->get_value();
    }

    public function set_suggestions($value){
        $property = new \Orm_Property_Textarea('suggestions',$value);
        $property->set_description('Suggestions for  improvement');
        $property->set_group('types');


        $this->set_property($property);
    }

    public function get_suggestions(){

        return $this->get_property('suggestions')->get_value();
    }

    public function set_number_of_participants(){
        $property = new \Orm_Property_Fixedtext('number_of_participants','Number of Participants');

        $property->set_group('types');
        $this->set_property($property);
    }
    public function get_number_of_participants(){
        return $this->get_property('number_of_participants')->get_value();

    }

    public function set_response($value){
        $property = new \Orm_Property_Textarea('response',$value);
        $property->set_description('Response');

        $property->set_group('types');
        $this->set_property($property);
    }
    public function get_response(){
        return $this->get_property('response')->get_value();

    }

    public function set_attachment_survey($value)
    {
        $attachment_survey = new \Orm_Property_Upload('attachment_survey');
        $attachment_survey->set_width(100);

        $property = new \Orm_Property_Table('attachment_survey', $value);
        $property->set_description('Attachment');
        $property->set_group('types');

        $property->add_cell(1, 1, $attachment_survey);

        $this->set_property($property);
    }

    public function get_attachment_survey ()
    {
        return $this->get_property('attachment_survey')->get_value();
    }

    public function set_other_evaluation($value)
    {
        $property = new \Orm_Property_Add_More('other_evaluation', $value);
        $property->set_description('2. Other Evaluations');

        $evaluations = new \Orm_Property_Fixedtext('evaluations','(e.g. Evaluations by faculty ,Program leaders, peer review, Independent reviewers, program consultations committee)');
        $property->add_property($evaluations);

        $evaluation_method = new \Orm_Property_Text('evaluation_method');
        $evaluation_method->set_description('Evaluation method');
        $property->add_property($evaluation_method);


        $date_evaluation = new \Orm_Property_Text('date_evaluation');
        $date_evaluation->set_description('Date evaluation');
        $property->add_property($date_evaluation);

        $evaluators_comments= new \Orm_Property_Fixedtext('evaluators_comments','Evaluators comments');
        $property->add_property($evaluators_comments);

        $strengths= new \Orm_Property_Textarea('strengths');
        $strengths->set_description('Strengths');
        $property->add_property($strengths);

        $suggestions= new \Orm_Property_Textarea('suggestions');
        $suggestions->set_description('Suggestions for  improvement');
        $property->add_property($suggestions);

        $numbers = new \Orm_Property_Text('number_of_participants');
        $numbers->set_description('Number of Participants');
        $property->add_property($numbers);


        $response= new \Orm_Property_Textarea('response');
        $response->set_description('Response');
        $property->add_property($response);


        $this->set_property($property);
    }

    public function get_other_evaluation()
    {
        return $this->get_property('other_evaluation')->get_value();
    }


    public function set_attachment_evaluation($value)
    {
        $attachment_evaluation = new \Orm_Property_Upload('attachment_evaluation');
        $attachment_evaluation->set_width(100);

        $property = new \Orm_Property_Table('attachment_evaluation', $value);
        $property->set_description('Attachment');
        $property->add_cell(1, 1, $attachment_evaluation);

        $this->set_property($property);
    }

    public function get_attachment_evaluation ()
    {
        return $this->get_property('attachment_evaluation')->get_value();
    }

    public function set_recommendations($value){
        $property = new \Orm_Property_Textarea('recommendations',$value);
        $property->set_description('3.Recommendations');
        $this->set_property($property);
    }

    public function get_recommendations(){

        return $this->get_property('recommendations')->get_value();
    }

}