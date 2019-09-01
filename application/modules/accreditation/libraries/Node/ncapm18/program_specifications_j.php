<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 11/10/18
 * Time: 12:33 م
 */

namespace Node\ncapm18;


class Program_Specifications_J extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $name = 'J. Program Quality assurance';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();
        $this->set_monitoring();
        $this->set_monitoring_procedure('');
        $this->set_arrangements('');
        $this->set_branch('');
        $this->set_partnership_arrangements('');
        $this->set_evaluation_matrix(array());
        $this->set_note();
        $this->set_kpi(array());
        $this->set_improvement('');

    }

    public function set_monitoring()
    {
        $property = new \Orm_Property_Fixedtext('monitoring', '<strong>1. Program monitoring</strong>');
        $property->set_group('program');
        $this->set_property($property);
    }

    public function get_monitoring()
    {
        return $this->get_property('monitoring')->get_value();
    }

    public function set_monitoring_procedure($value)
    {
        $property = new \Orm_Property_Textarea('monitoring_procedure', $value);
        $property->set_description('1.1 Describe the Program quality monitoring procedures');
        $property->set_group('program');
        $this->set_property($property);
    }

    public function get_monitoring_procedure()
    {
        return $this->get_property('monitoring_procedure')->get_value();
    }

    public function set_arrangements($value)
    {
        $property = new \Orm_Property_Textarea('arrangements', $value);
        $property->set_description('1.2 Describe the arrangements taken to monitor the courses taught by other departments.');
        $property->set_group('program');
        $this->set_property($property);
    }

    public function get_arrangements()
    {
        return $this->get_property('arrangements')->get_value();
    }

    public function set_branch($value)
    {
        $property = new \Orm_Property_Textarea('branch', $value);
        $property->set_description('1.3 Describe the arrangements taken to insure the integrations between main campus and branches ( males & females )');
        $property->set_group('program');
        $this->set_property($property);
    }

    public function get_branch()
    {
        return $this->get_property('branch')->get_value();
    }

    public function set_partnership_arrangements($value)
    {
        $property = new \Orm_Property_Textarea('partnership_arrangements', $value);
        $property->set_description('1.4 Describe the arrangements taken to monitor the partnership arrangements with other institutions.');
        $property->set_group('program');
        $this->set_property($property);
    }

    public function get_partnership_arrangements()
    {
        return $this->get_property('partnership_arrangements')->get_value();
    }


    public function set_evaluation_matrix($value)
    {
        $property = new \Orm_Property_Table_Dynamic('evaluation_matrix', $value);
        $property->set_description('2. Program evaluation Matrix');

        $area = new \Orm_Property_Textarea('area');
        $area->set_description('Evaluation areas/issues');
        $area->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $area->set_width(200);
        $property->add_property($area);

        $evaluators = new \Orm_Property_Textarea('evaluators');
        $evaluators->set_description('Stakeholders / Evaluators');
        $evaluators->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $evaluators->set_width(200);
        $property->add_property($evaluators);

        $methods = new \Orm_Property_Textarea('methods');
        $methods->set_description('Evaluation methods');
        $methods->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $methods->set_width(200);
        $property->add_property($methods);

        $time = new \Orm_Property_Textarea('time');
        $time->set_description('Evaluation time (When)');
        $time->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $time->set_width(200);
        $property->add_property($time);

        $this->set_property($property);
    }

    public function get_evaluation_matrix()
    {
        return $this->get_property('evaluation_matrix')->get_value();
    }

    public function set_note(){
        $property = new \Orm_Property_Fixedtext('note', '<strong>Evaluation areas</strong> (e.g., leadership, Effectiveness of Teaching & assessment & Program learning outcomes, Learning resources, partnerships, etc.)<br>'.
    '<strong>Stakeholders</strong> (Students, Graduates, Alumnae, Faculty, Program leaders, Administration staff, Employers, Independent reviewers, Others (specify)<br>'.
    '<dtrong>Evaluation time</dtrong> (e.g., begging of semesters, end of academic year, etc.)');
        $this->set_property($property);

    }
    public function get_note(){
        return $this->get_property('note')->get_value();
    }

    public function set_kpi($value){
        $property = new \Orm_Property_Table_Dynamic('kpi', $value);
        $property->set_description("3. Program KPI's");

        $code = new \Orm_Property_Text('code');
        $code->set_description('Code');
        $code->set_width(100);
        $property->add_property($code);

        $kpi = new \Orm_Property_Text('kpi');
        $kpi->set_description('KPI');
        $kpi->set_width(200);
        $property->add_property($kpi);

        $target_benchmark = new \Orm_Property_Text('target_benchmark');
        $target_benchmark->set_description('Target');
        $target_benchmark->set_width(100);
        $property->add_property($target_benchmark);

        $methods = new \Orm_Property_Textarea('methods');
        $methods->set_description('Measurement Methods');
        $methods->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $methods->set_width(200);
        $property->add_property($methods);

        $time = new \Orm_Property_Textarea('time');
        $time->set_description('Measurement Time');
        $time->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $time->set_width(200);
        $property->add_property($time);

        $responsibility = new \Orm_Property_Textarea('responsibility');
        $responsibility->set_description('Measurement Responsibility');
        $responsibility->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $responsibility->set_width(200);
        $property->add_property($responsibility);

        $this->set_property($property);
    }
    public function get_kpi(){
        return $this->get_property('kpi')->get_value();
    }

    public function set_improvement($value){
        $property = new \Orm_Property_Textarea('improvement', $value);
        $property->set_description('4. Program improvement  ( The procedures used to improve the program. )');
        $this->set_property($property);
    }
    public function get_improvement(){
        return $this->get_property('improvement')->get_value();
    }

    public function header_actions(&$actions = array()) {

        if (\Orm::get_ci()->config->item('integration_enabled')) {
            if ($this->check_if_editable()) {
                if(\License::get_instance()->check_module('kpi')) {
                    $actions[] = array(
                        'class' => 'btn',
                        'title' => '<i class="fa fa-database"></i> ' . lang('Integration'),
                        'extra' => 'onclick="integration(this, ' . $this->get_id() . ');" ' . data_loading_text(true) . ' title="Extraction of data from other modules"'
                    );
                }
            }
        }

        return parent::header_actions($actions);
    }

    public function integration_processes() {
        parent::integration_processes();

        $program_node = $this->get_parent_program_node();
        if (!is_null($program_node) && $program_node->get_id()) {
            $program_obj = $program_node->get_item_obj(); /* @var $program_obj \Orm_Program */
            $department_obj = $program_obj->get_department_obj();
            $college_obj = $department_obj->get_college_obj();

            if(\License::get_instance()->check_module('kpi') && \Modules::load('kpi')) {
                $KPIs = \Orm_Kpi::get_all(array('category_id' => \Orm_Kpi::KPI_ACCREDITATION,'college_id' => $college_obj->get_id()));
                $data_kpis = array();
                foreach ($KPIs as $kpi) {

                    $info = $kpi->get_info(\Orm_Kpi_Detail::TYPE_PROGRAM, array('program_id' => $program_obj->get_id()));

                    $data_kpis[$kpi->get_id()]['code'] = $info['code'];
                    $data_kpis[$kpi->get_id()]['kpi'] = $kpi->get_title();
                    $data_kpis[$kpi->get_id()]['target_benchmark'] = $info['target_benchmarks'];
                }

                $this->set_kpi(array_values($data_kpis));
            }
        }
        $this->save();
    }

}