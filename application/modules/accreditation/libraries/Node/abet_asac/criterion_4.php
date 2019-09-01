<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\abet_asac;

/**
 * Description of criterion_4
 *
 * @author ahmadgx
 */
class Criterion_4 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'CRITERION 4. CONTINUOUS IMPROVEMENT';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info('');
            $this->set_student_outcomes('');
            $this->set_student_outcomes_table(array());
            $this->set_improvement('');
            $this->set_continuous_improvement('');
            $this->set_information('');
            $this->set_additional_info('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', ''
            . 'This section of your Self-Study Report should document your processes for regularly assessing and evaluating the extent to which the student outcomes are being attained.  This section should also document the extent to which the student outcomes are being attained. It should also describe how the results of these processes are utilized to affect continuous improvement of the program. <br/> <br/>'
            . 'Assessment is defined as one or more processes that identify, collect, and prepare the data necessary for evaluation.  Evaluation is defined as one or more processes for interpreting the data acquired though the assessment processes in order to determine how well the student outcomes are being attained. <br/> <br/>'
            . 'Although the program can report its processes as it chooses, the following is presented as a guide to help you organize your Self-Study Report.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_student_outcomes()
    {
        $property = new \Orm_Property_Fixedtext('student_outcomes', '<strong>A. Student Outcomes</strong>'
            . ' <br/>It is recommended that this section include (a table may be used to present this information):');
        $property->set_group('student_outcome');
        $this->set_property($property);
    }

    public function get_student_outcomes()
    {
        return $this->get_property('student_outcomes')->get_value();
    }

    public function set_student_outcomes_table($value)
    {
        $student_outcome = new \Orm_Property_Textarea('student_outcome');
        $student_outcome->set_width(500);
        $student_outcome->set_enable_tinymce(0);

        $property = new \Orm_Property_Table('student_outcomes_table', $value);
        $property->set_group('student_outcome');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('assessment_process', '1. A listing and description of the assessment processes used to gather the data upon which the evaluation of each student outcome is based.  Examples of data collection processes may include, but are not limited to, specific exam questions, student portfolios, internally developed assessment exams, senior project presentations, nationally-normed exams, oral exams, focus groups, industrial advisory committee meetings, or other processes that are relevant and appropriate to the program.'));
        $property->add_cell(1, 2, $student_outcome);

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('frequency', '2. The frequency with which these assessment processes are carried out'));
        $property->add_cell(2, 2, $student_outcome);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('attainment', '3. The expected level of attainment for each of the student outcomes'));
        $property->add_cell(3, 2, $student_outcome);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('results', '4. Summaries of the results of the evaluation process and an analysis illustrating the extent to which each of the student outcomes is being attained '));
        $property->add_cell(4, 2, $student_outcome);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('documented', '5. How the results are documented and maintained'));
        $property->add_cell(5, 2, $student_outcome);

        $this->set_property($property);
    }

    public function get_student_outcomes_table()
    {
        return $this->get_property('student_outcomes_table')->get_value();
    }

    public function set_improvement()
    {
        $property = new \Orm_Property_Fixedtext('improvement', '<strong>B. Continuous Improvement</strong>');
        $property->set_group('group_b');
        $this->set_property($property);
    }

    public function get_improvement()
    {
        return $this->get_property('improvement')->get_value();
    }

    public function set_continuous_improvement($value)
    {
        $property = new \Orm_Property_Textarea('continuous_improvement', $value);
        $property->set_description('Describe how the results of evaluation processes for the student outcomes and any other available information have been systematically used as input in the continuous improvement of the program.  Describe the results of any changes (whether or not effective) in those cases where re-assessment of the results has been completed.  Indicate any significant future program improvement plans based upon recent evaluations.  Provide a brief rationale for each of these planned changes.');
        $property->set_group('group_b');
        $this->set_property($property);
    }

    public function get_continuous_improvement()
    {
        return $this->get_property('continuous_improvement')->get_value();
    }

    public function set_information()
    {
        $property = new \Orm_Property_Fixedtext('information', '<strong>C. Additional Information</strong>');
        $property->set_group('group_c');
        $this->set_property($property);
    }

    public function get_information()
    {
        return $this->get_property('information')->get_value();
    }

    public function set_additional_info($value)
    {
        $property = new \Orm_Property_Upload('additional_info', $value);
        $property->set_description('Copies of any of the assessment instruments or materials referenced in 4.A. and 4.B must be available for review at the time of the visit.  Other information such as minutes from meetings where the assessment results were evaluated and where recommendations for action were made could also be included.');
        $property->set_group('group_c');
        $this->set_property($property);
    }

    public function get_additional_info()
    {
        return $this->get_property('additional_info')->get_value();
    }

}
