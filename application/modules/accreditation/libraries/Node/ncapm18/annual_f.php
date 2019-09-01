<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 09/10/18
 * Time: 04:09 م
 */

namespace Node\ncapm18;


class Annual_F extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $name = 'F. Program Evaluation ';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();
        $this->set_course_evaluation_note();
        $this->set_course_evaluation(array());

        $this->set_evaluation();
        $this->set_survey_date('');
        $this->set_participants('');
        $this->set_evaluators_comments();
        $this->set_strength('');
        $this->set_improvement('');
        $this->set_response('');
        $this->set_survey_attach('');

        $this->set_other_evaluation();
        $this->set_method('');
        $this->set_date('');
        $this->set_other_participants('');
        $this->set_other_evaluators_comments();
        $this->set_other_strength('');
        $this->set_other_improvement('');
        $this->set_other_response('');
        $this->set_other_survey_attach('');

        $this->set_kpi(array());
        $this->set_kpi_comment('');
        $this->set_analysis(array());


    }

    public function set_course_evaluation_note()
    {
        $property = new \Orm_Property_Fixedtext('course_evaluation_note', '<strong>1. Courses Evaluation </strong><br>
List all courses of the program taught during the year. Indicate for each course whether student evaluations were 
undertaken, and/or other evaluations made of quality of teaching. For each course indicate Recommendations for improvement.
');
        $this->set_property($property);

    }

    public function get_course_evaluation_note()
    {
        return $this->get_property('course_evaluation_note')->get_value();
    }

    public function set_course_evaluation($value)
    {
        $property = new \Orm_Property_Table_Dynamic('course_evaluation', $value);

        $course = new \Orm_Property_Text('course');
        $course->set_description('Course Title/Course Code');
        $property->add_property($course);

        $evaluations = new \Orm_Property_Radio('evaluations');
        $evaluations->set_description('Student Evaluations');
        $evaluations->set_options(array('Yes', 'No'));
        $property->add_property($evaluations);

        $other = new \Orm_Property_Text('other');
        $other->set_description('Other Evaluation ( specify) ');
        $property->add_property($other);

        $recommendation = new \Orm_Property_Textarea('recommendation');
        $recommendation->set_description('Recommendations for improvement');
        $recommendation->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $property->add_property($recommendation);

        $this->set_property($property);

    }

    public function get_course_evaluation()
    {
        return $this->get_property('course_evaluation')->get_value();
    }

    /*
     * Start Graduate Evaluations
     */

    public function set_evaluation()
    {
        $property = new \Orm_Property_Fixedtext('evaluation', '<strong>2. Graduate Evaluation for quality of the program.</strong>');
        $property->set_group('evaluators');
        $this->set_property($property);
    }

    public function get_evaluation()
    {
        return $this->get_property('evaluation')->get_value();
    }

    public function set_survey_date($value)
    {
        $property = new \Orm_Property_Text('survey_date', $value);
        $property->set_description('Date of Survey');
        $property->set_group('evaluators');
        $this->set_property($property);
    }

    public function get_survey_date()
    {
        return $this->get_property('survey_date')->get_value();
    }

    public function set_participants($value)
    {
        $property = new \Orm_Property_Text('participants', $value);
        $property->set_description('Number of Participants');
        $property->set_group('evaluators');
        $this->set_property($property);
    }

    public function get_participants()
    {
        return $this->get_property('participants')->get_value();
    }

    public function set_evaluators_comments()
    {
        $property = new \Orm_Property_Fixedtext('evaluators_comments', '<strong>Evaluators comment</strong>');
        $property->set_group('evaluators');
        $this->set_property($property);
    }

    public function get_evaluators_comments()
    {
        return $this->get_property('evaluators_comments')->get_value();
    }

    public function set_strength($value)
    {
        $property = new \Orm_Property_Textarea('strength', $value);
        $property->set_description('Strengths');
        $property->set_group('evaluators');
        $this->set_property($property);
    }

    public function get_strength()
    {
        return $this->get_property('strength')->get_value();
    }

    public function set_improvement($value)
    {
        $property = new \Orm_Property_Textarea('improvement', $value);
        $property->set_description('Suggestions for  improvement');
        $property->set_group('evaluators');
        $this->set_property($property);
    }

    public function get_improvement()
    {
        return $this->get_property('improvement')->get_value();
    }

    public function set_response($value)
    {
        $property = new \Orm_Property_Textarea('response', $value);
        $property->set_description('Program response');
        $property->set_group('evaluators');
        $this->set_property($property);
    }

    public function get_response()
    {
        return $this->get_property('response')->get_value();
    }

    public function set_survey_attach($value)
    {
        $property = new \Orm_Property_Upload('survey_attach', $value);
        $property->set_description('Attach survey report');
        $property->set_group('evaluators');
        $this->set_property($property);
    }

    public function get_survey_attach()
    {
        return $this->get_property('survey_attach')->get_value();
    }

    /*
     * End Graduate Evaluations
     */

    /*
    * Start Other Evaluations
    */

    public function set_other_evaluation()
    {
        $property = new \Orm_Property_Fixedtext('other_evaluation', '<strong>3. Other Evaluations</strong><br>
(e.g. Evaluations by employers or other stakeholders, Independent reviews and program consultations committee )');
        $property->set_group('other_evaluation');
        $this->set_property($property);
    }

    public function get_other_evaluation()
    {
        return $this->get_property('other_evaluation')->get_value();
    }

    public function set_method($value)
    {
        $property = new \Orm_Property_Text('method', $value);
        $property->set_description('Evaluation method');
        $property->set_group('other_evaluation');
        $this->set_property($property);
    }

    public function get_method()
    {
        return $this->get_property('method')->get_value();
    }


    public function set_date($value)
    {
        $property = new \Orm_Property_Text('date', $value);
        $property->set_description('Date');
        $property->set_group('other_evaluation');
        $this->set_property($property);
    }

    public function get_date()
    {
        return $this->get_property('date')->get_value();
    }

    public function set_other_participants($value)
    {
        $property = new \Orm_Property_Text('other_participants', $value);
        $property->set_description('Number of Participants');
        $property->set_group('other_evaluation');
        $this->set_property($property);
    }

    public function get_other_participants()
    {
        return $this->get_property('other_participants')->get_value();
    }

    public function set_other_evaluators_comments()
    {
        $property = new \Orm_Property_Fixedtext('other_evaluators_comments', '<strong>Evaluators comment</strong>');
        $property->set_group('other_evaluation');
        $this->set_property($property);
    }

    public function get_other_evaluators_comments()
    {
        return $this->get_property('other_evaluators_comments')->get_value();
    }

    public function set_other_strength($value)
    {
        $property = new \Orm_Property_Textarea('other_strength', $value);
        $property->set_description('Strengths');
        $property->set_group('other_evaluation');
        $this->set_property($property);
    }

    public function get_other_strength()
    {
        return $this->get_property('other_strength')->get_value();
    }

    public function set_other_improvement($value)
    {
        $property = new \Orm_Property_Textarea('other_improvement', $value);
        $property->set_description('Suggestions for  improvement');
        $property->set_group('other_evaluation');
        $this->set_property($property);
    }

    public function get_other_improvement()
    {
        return $this->get_property('other_improvement')->get_value();
    }

    public function set_other_response($value)
    {
        $property = new \Orm_Property_Textarea('other_response', $value);
        $property->set_description('Program response');
        $property->set_group('other_evaluation');
        $this->set_property($property);
    }

    public function get_other_response()
    {
        return $this->get_property('other_response')->get_value();
    }

    public function set_other_survey_attach($value)
    {
        $property = new \Orm_Property_Upload('other_survey_attach', $value);
        $property->set_description('Attach review/survey report');
        $property->set_group('other_evaluation');
        $this->set_property($property);
    }

    public function get_other_survey_attach()
    {
        return $this->get_property('other_survey_attach')->get_value();
    }

    /*
     * End Other Evaluations
     */
    public function set_kpi($value)
    {
        $property = new \Orm_Property_Table_Dynamic('kpi', $value);
        $property->set_description('4. Key Performance Indicators KPI’s.');
        $property->set_is_responsive(true);

        $kpi_num = new \Orm_Property_Text('kpi_num');
        $kpi_num->set_description('KPI #');
        $kpi_num->set_width(100);
        $property->add_property($kpi_num);

        $kpi = new \Orm_Property_Text('kpi');
        $kpi->set_description('KPI');
        $kpi->set_width(200);
        $property->add_property($kpi);

        $target_benchmark = new \Orm_Property_Text('target_benchmark');
        $target_benchmark->set_description('Target Benchmark');
        $target_benchmark->set_width(100);
        $property->add_property($target_benchmark);

        $actual_benchmark = new \Orm_Property_Text('actual_benchmark');
        $actual_benchmark->set_description('Actual Value');
        $actual_benchmark->set_width(100);
        $property->add_property($actual_benchmark);

        $internal_benchmark = new \Orm_Property_Text('internal_benchmark');
        $internal_benchmark->set_description('Internal Benchmark');
        $internal_benchmark->set_width(100);
        $property->add_property($internal_benchmark);

        $kpi_analysis = new \Orm_Property_Textarea('kpi_analysis');
        $kpi_analysis->set_description('Analysis');
        $kpi_analysis->set_width(200);
        $kpi_analysis->set_enable_tinymce(0);
        $property->add_property($kpi_analysis);

        $new_target_benchmark = new \Orm_Property_Text('new_target_benchmark');
        $new_target_benchmark->set_description('New Target Benchmark');
        $new_target_benchmark->set_width(100);
        $property->add_property($new_target_benchmark);

        $this->set_property($property);

    }

    public function get_kpi()
    {
        return $this->get_property('kpi')->get_value();
    }

    public function set_kpi_comment($value)
    {
        $property = new \Orm_Property_Textarea('kpi_comment', $value);
        $property->set_description('Comments on the Program KPIs and Benchmarks results');
        $this->set_property($property);
    }

    public function get_kpi_comment()
    {
        return $this->get_property('kpi_comment')->get_value();
    }

    public function set_analysis($value)
    {
        $property = new \Orm_Property_Add_More('analysis', $value);
        $property->set_description('5. Analysis ( list of strength, points for improvements and recommendations  for Program Evaluation)');

        $strength = new \Orm_Property_Textarea('strength');
        $strength->set_description('Strengths');
        $property->add_property($strength);

        $points = new \Orm_Property_Textarea('points');
        $points->set_description('Points for improvements');
        $property->add_property($points);


        $recommendation = new \Orm_Property_Textarea('recommendation');
        $recommendation->set_description('Recommendations');
        $property->add_property($recommendation);

        $this->set_property($property);


    }

    public function get_analysis()
    {

        return $this->get_property('analysis')->get_value();
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

        if (\Orm::get_ci()->config->item('integration_enabled')) {

            $program_node = $this->get_parent_program_node();
            if (!is_null($program_node) && $program_node->get_id()) {
                $program_obj = $program_node->get_item_obj(); /* @var $program_obj \Orm_Program */
                $department_obj = $program_obj->get_department_obj();
                $college_obj = $department_obj->get_college_obj();

                $courses = array();
                foreach ($program_obj->get_courses() as $course) {
                    $courses[] = array(
                        'course' => $course->get_course_obj()->get_code('english').' / '.$course->get_course_obj()->get_name('english'),
                        'evaluations' => 'Yes',
                        'other' => '',
                        'recommendation' => ''
                    );
                }
                $this->set_course_evaluation($courses);

            }

            if (\License::get_instance()->check_module('survey') && \Modules::load('survey')) {
                /** @var \Orm_User_Alumni[] $alumni */
                $alumni = \Orm_User_Alumni::get_all(array('program_id' => $program_obj->get_id()));

                $surveyed = count($alumni);
                $date = '';
                $this->set_participants($surveyed);

                if ($date)
                {
                    $this->set_survey_date($date);
                }
            }

            if(\License::get_instance()->check_module('kpi') && \Modules::load('kpi')) {
                $KPIs = \Orm_Kpi::get_all(array('category_id' => \Orm_Kpi::KPI_ACCREDITATION,'college_id' => $college_obj->get_id()));
                $data_kpis = array();
                foreach ($KPIs as $kpi) {

                    $info = $kpi->get_info(\Orm_Kpi_Detail::TYPE_PROGRAM, array('program_id' => $program_obj->get_id()));

                    $data_kpis[$kpi->get_id()]['kpi_num'] = $info['code'];
                    $data_kpis[$kpi->get_id()]['kpi'] = $kpi->get_title();
                    $data_kpis[$kpi->get_id()]['target_benchmark'] = $info['target_benchmarks'];
                    $data_kpis[$kpi->get_id()]['actual_benchmark'] = $info['actual_benchmarks'];
                    $data_kpis[$kpi->get_id()]['internal_benchmark'] = $info['internal_benchmarks'];
                    $data_kpis[$kpi->get_id()]['external_benchmark'] = $info['external_benchmarks'];
                    $data_kpis[$kpi->get_id()]['new_target_benchmark'] = $info['new_benchmarks'];
                }

                $this->set_kpi(array_values($data_kpis));
            }

            $this->save();
        }

    }


}