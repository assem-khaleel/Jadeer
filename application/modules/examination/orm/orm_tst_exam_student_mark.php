<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Tst_Exam_Student_Mark extends Orm {
    
    /**
    * @var $instances Orm_Tst_Exam_Student_Mark[]
    */
    protected static $instances = array();
    protected static $table_name = 'tst_exam_student_mark';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $user_id = 0;
    protected $exam_id = 0;
    protected $question_id = 0;
    protected $mark = 0;
    
    /**
    * @return Tst_Exam_Student_Mark_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Tst_Exam_Student_Mark_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Tst_Exam_Student_Mark
    */
    public static function get_instance($id) {
        
        $id = intval($id);
        
        if(isset(self::$instances[$id])) {
            return self::$instances[$id];
        }
        
        return self::get_one(array('id' => $id));
    }
    
    /**
    * Get all rows as Objects
    *
    * @param array $filters
    * @param int $page
    * @param int $per_page
    * @param array $orders
    *
    * @return Orm_Tst_Exam_Student_Mark[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Tst_Exam_Student_Mark
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Tst_Exam_Student_Mark();
    }
    
    /**
    * get count
    *
    * @param array $filters
    * @return int
    */
    public static function get_count($filters = array()) {
        return self::get_model()->get_all($filters, 0, 0, array(), Orm::FETCH_COUNT);
    }

    public static function get_count_students($filters = array()) {
        $filters['student_mark'] = 1;
        return self::get_model()->get_all($filters, 0, 0, array(), Orm::FETCH_COUNT);
    }

    public static function get_max($exam_id) {
        return intval(self::get_model()->get_max($exam_id));
    }

    public static function get_min($exam_id) {
        return intval(self::get_model()->get_min($exam_id));
    }

    public static function get_median($exam_id) {
        return intval(self::get_model()->get_median($exam_id));
    }

    public function to_array() {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['user_id'] = $this->get_user_id();
        $db_params['exam_id'] = $this->get_exam_id();
        $db_params['question_id'] = $this->get_question_id();
        $db_params['mark'] = $this->get_mark();
        
        return $db_params;
    }
    
    public function save() {
        if ($this->get_object_status() == 'new') {
            $insert_id = self::get_model()->insert($this->to_array());
            $this->set_id($insert_id);
        } elseif($this->get_object_fields()) {
            self::get_model()->update($this->get_id(), $this->get_object_fields());
        }
        
        $this->set_object_status('saved');
        $this->reset_object_fields();
        return $this->get_id();
    }
    
    public function delete() {
        return self::get_model()->delete($this->get_id());
    }
    
    public function set_id($value) {
        $this->add_object_field('id', $value);
        $this->id = $value;
        
        $this->push_instance();
    }
    
    public function get_id() {
        return $this->id;
    }
    
    public function set_user_id($value) {
        $this->add_object_field('user_id', $value);
        $this->user_id = $value;
    }
    
    public function get_user_id() {
        return $this->user_id;
    }
    
    public function set_exam_id($value) {
        $this->add_object_field('exam_id', $value);
        $this->exam_id = $value;
    }
    
    public function get_exam_id() {
        return $this->exam_id;
    }

    public function set_question_id($value) {
        $this->add_object_field('question_id', $value);
        $this->question_id = $value;
    }

    public function get_question_id() {
        return $this->question_id;
    }
    
    public function set_mark($value) {
        $this->add_object_field('mark', $value);
        $this->mark = $value;
    }
    
    public function get_mark() {
        return $this->mark;
    }

    public static function get_students_ids_not_done($exam_id){
        $exam = Orm_Tst_Exam::get_instance($exam_id);
        $question_count = count($exam->get_questions());

        $rs = self::get_ci()->db->query("
        select ".Orm_Course_Section_Student::get_table_name().".user_id from ".Orm_Course_Section_Student::get_table_name()."
        join ".Orm_Tst_Exam_Attendance::get_table_name()." on ".Orm_Tst_Exam_Attendance::get_table_name().".student_id = ".Orm_Course_Section_Student::get_table_name().".user_id 
        left join ".Orm_Tst_Exam_Student_Mark::get_table_name()." on ".Orm_Tst_Exam_Student_Mark::get_table_name().".user_id = ".Orm_Course_Section_Student::get_table_name().".user_id
          where ".Orm_Tst_Exam_Attendance::get_table_name().".exam_id=? and (".Orm_Tst_Exam_Student_Mark::get_table_name().".exam_id = ? or ".Orm_Tst_Exam_Student_Mark::get_table_name().".exam_id is null) and ".Orm_Course_Section_Student::get_table_name().".section_id in ?
          group by ".Orm_Course_Section_Student::get_table_name().".user_id
          HAVING count(".Orm_Tst_Exam_Student_Mark::get_table_name().".id) < ?
        ",[$exam_id, $exam_id, $exam->get_sections(true), $question_count ]);

        if($rs->num_rows()){
            return array_column($rs->result_array(), 'user_id');
        }

        return [];
    }

    public static function get_normal_distribution_chart($exam_id) {

        $full_mark =  Orm_Tst_Exam::get_instance($exam_id)->get_fullmark();


        $pass_mark = intval($full_mark/2);
        $pass_mark += $full_mark%$pass_mark;


        if($full_mark == 3){
            $pass_mark = 2;
        }

        $title_arr = [];
        $title_arr[] = '1-'.($pass_mark-1);

        if($full_mark>4){
            $title_arr[] = $pass_mark.'-'.($pass_mark+intval($full_mark/2*.30)?:2);
            $title_arr[] = ($pass_mark+1+intval($full_mark/2*.30)?:2).'-'.($pass_mark+intval($full_mark/2*.7)?:3);
            $title_arr[] = ($pass_mark+1+intval($full_mark/2*.7)?:3).'-'.$full_mark;
        }
        else {
            $title_arr[] = $pass_mark.'-'.$full_mark;
        }

        $data_set = [];
        foreach($title_arr as $row) {
            $data_set[] = self::get_count_students([
                'exam_id'            => $exam_id,
                'between_mark' => explode('-', $row)
            ]);
        }

        $label = lang('Student Marks');
        $title = lang('Normal Distribution Chart');

        $title_x = json_encode($title_arr);
        $data_x = json_encode($data_set);

        return <<<HTML
<style>
    canvas {
        max-height: 400px;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
</style>
<div class="col-xs-12 col-sm-6 col-sm-offset-3">
    <canvas id="normal_distribution"></canvas>
</div>
<script>

        var color = Chart.helpers.color;
        var barChartData = {
            labels: {$title_x},
            datasets: [{
                label: "{$label}",
                backgroundColor: color('#FF0000').alpha(0.5).rgbString(),
                borderColor: '#FF0000',
                fill: false,
                borderWidth: 1,
                data: {$data_x}
            }]
        };

        $(document).ready(function() {
            var ctx = document.getElementById("normal_distribution").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: '{$title}'
                    }
                }
            });

        });

</script>
HTML;

    }

    public static function get_passed_students_chart($exam_id) {

        $full_mark =  Orm_Tst_Exam::get_instance($exam_id)->get_fullmark();

//        $count_total = self::get_count_students(['exam_id' => $exam_id]);
        $count_total = Orm_Tst_Exam::get_instance($exam_id)->get_students_count();

        if($count_total==0){
            return '';
        }

        $count_passed = self::get_count_students([
            'exam_id'            => $exam_id,
            'greater_equal_mark' => (intval($full_mark/2) + ($full_mark % 2))
        ]);

        $percentage = 0;

        if($count_total!=0) {
            $percentage = round($count_passed / $count_total, 5);
        }

        $percentage = $percentage *100;

        $label = lang('No. of Student Passed');

        return <<<HTML
<div class="col-xs-12 col-sm-4">
    <div class="panel box">
        <div class="box-row">
            <div class="box-cell p-x-2 p-y-1 bg-black text-xs-center font-size-11 font-weight-semibold">
                {$label}
            </div>
        </div>
        <div class="box-row">
            <div class="box-cell p-y-2">
                <div class="text-center p-b-2">&nbsp;</div>
                <div class="easy-pie-chart" data-suffix="" data-percent="{$percentage}" data-max-value="{$count_total}"><span class="font-size-14 font-weight-light"></span></div>
            </div>
        </div>
    </div>
</div>
HTML;

    }

    public static function get_low_scour_students_chart($exam_id) {

        $full_mark =  Orm_Tst_Exam::get_instance($exam_id)->get_fullmark();

//        $count_total = self::get_count(['exam_id' => $exam_id]);
        $count_total = Orm_Tst_Exam::get_instance($exam_id)->get_students_count();

        if($count_total==0){
            return '';
        }

        $count_passed = self::get_count_students([
            'exam_id'            => $exam_id,
            'between_mark' => [(intval($full_mark/2) + ($full_mark % 2)), intval($full_mark*0.75)]
        ]);

        $percentage = 0;

        if($count_total!=0) {
            $percentage = round($count_passed / $count_total, 5);
        }

        $percentage = $percentage *100;

        $label = lang('No. of Student with Low Scores');
        $mark_range = lang('Mark').': '.(intval($full_mark/2) + ($full_mark % 2)).' - '. intval($full_mark*0.75);
        return <<<HTML
<div class="col-xs-12 col-sm-4">
    <div class="panel box">
        <div class="box-row">
            <div class="box-cell p-x-2 p-y-1 bg-black text-xs-center font-size-11 font-weight-semibold">
                {$label}
            </div>
        </div>
        <div class="box-row">
            <div class="box-cell p-y-2">
                <div class="text-center p-b-2">{$mark_range}</div>
                <div class="easy-pie-chart" data-suffix="" data-percent="{$percentage}" data-max-value="{$count_total}"><span class="font-size-14 font-weight-light"></span></div>
            </div>
        </div>
    </div>
</div>
HTML;

    }

    public static function get_high_scour_students_chart($exam_id) {

        $full_mark =  Orm_Tst_Exam::get_instance($exam_id)->get_fullmark();

//        $count_total = self::get_count(['exam_id' => $exam_id]);
        $count_total = Orm_Tst_Exam::get_instance($exam_id)->get_students_count();

        if($count_total==0){
            return '';
        }

        $count_passed = self::get_count_students([
            'exam_id'            => $exam_id,
            'between_mark' => [intval($full_mark*0.75+1), $full_mark]
        ]);

        $percentage = 0;

        if($count_total!=0) {
            $percentage = round($count_passed / $count_total, 5);
        }

        $percentage = $percentage *100;

        $label = lang('No. of Student with High Scores');
        $mark_range = lang('Mark').': '.intval($full_mark*0.75+1).' - '. $full_mark;

        return <<<HTML
<div class="col-xs-12 col-sm-4">
    <div class="panel box">
        <div class="box-row">
            <div class="box-cell p-x-2 p-y-1 bg-black text-xs-center font-size-11 font-weight-semibold">
                {$label}
            </div>
        </div>
        <div class="box-row">
            <div class="box-cell p-y-2">
                <div class="text-center p-b-2">{$mark_range}</div>
                <div class="easy-pie-chart" data-suffix="" data-percent="{$percentage}" data-max-value="{$count_total}"><span class="font-size-14 font-weight-light"></span></div>
            </div>
        </div>
    </div>
</div>
HTML;

    }

    public static function get_full_mark_students_chart($exam_id) {

        $full_mark =  Orm_Tst_Exam::get_instance($exam_id)->get_fullmark();

//        $count_total = self::get_count(['exam_id' => $exam_id]);
        $count_total = Orm_Tst_Exam::get_instance($exam_id)->get_students_count();

        if($count_total==0){
            return '';
        }

        $count_passed = self::get_count_students([
            'exam_id' => $exam_id,
            'mark'    => $full_mark
        ]);

        $percentage = 0;

        if($count_total!=0) {
            $percentage = round($count_passed / $count_total, 5);
        }

        $percentage = $percentage *100;

        $label = lang('No. of Student with Full Mark');

        return <<<HTML
<div class="col-xs-12 col-sm-4">
    <div class="panel box">
        <div class="box-row">
            <div class="box-cell p-x-2 p-y-1 bg-black text-xs-center font-size-11 font-weight-semibold">
                {$label}
            </div>
        </div>
        <div class="box-row">
            <div class="box-cell p-y-2">
                <div class="easy-pie-chart" data-suffix="" data-percent="{$percentage}" data-max-value="{$count_total}"><span class="font-size-14 font-weight-light"></span></div>
            </div>
        </div>
    </div>
</div>
HTML;

    }

    public static function get_attendees_chart($exam_id) {

        $total_student = Orm_Tst_Exam::get_instance($exam_id)->get_students_count();

        if($total_student==0){
            return '';
        }

        if(Orm_Tst_Exam::get_instance($exam_id)->get_type() == Orm_Tst_Exam::TYPE_EXAM){
            $count_total = Orm_Tst_Exam_Attendance::get_count(['exam_id'=>$exam_id]);
        }
        else {
            $count_total = Orm_Tst_Exam::get_students_attended($exam_id);
        }

        $percentage_attendees = 0;
        $percentage_absent    = 0;

        if($total_student!=0) {
            $percentage_attendees = round($count_total / $total_student, 5);
        }

        if($total_student!=0) {
            $percentage_absent = 1 - $percentage_attendees;
        }

        $percentage_attendees = $percentage_attendees *100;
        $percentage_absent = $percentage_absent *100;


        $label_attendees = lang('No. of Student Attendees');
        $label_absent = lang('No. of Student Absent');

        return <<<HTML
<div class="col-xs-12 col-sm-4">
    <div class="panel box">
        <div class="box-row">
            <div class="box-cell p-x-2 p-y-1 bg-black text-xs-center font-size-11 font-weight-semibold">
                {$label_attendees}
            </div>
        </div>
        <div class="box-row">
            <div class="box-cell p-y-2">
                <div class="easy-pie-chart" data-suffix="" data-percent="{$percentage_attendees}" data-max-value="{$total_student}"><span class="font-size-14 font-weight-light"></span></div>
            </div>
        </div>
    </div>
</div>

<div class="col-xs-12 col-sm-4">
    <div class="panel box">
        <div class="box-row">
            <div class="box-cell p-x-2 p-y-1 bg-black text-xs-center font-size-11 font-weight-semibold">
                {$label_absent}
            </div>
        </div>
        <div class="box-row">
            <div class="box-cell p-y-2">
                <div class="easy-pie-chart" data-suffix="" data-percent="{$percentage_absent}" data-max-value="{$total_student}"><span class="font-size-14 font-weight-light"></span></div>
            </div>
        </div>
    </div>
</div>
HTML;

    }

    public static function get_mark_average($filters = [])
    {
        return self::get_model()->get_mark_average($filters);
    }

}

