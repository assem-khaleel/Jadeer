<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Cm_Course_Assessment_Method extends Orm
{

    protected static $table_name = 'cm_course_assessment_method';

    /**
     * @var $instances Orm_Cm_Course_Assessment_Method[]
     */
    protected static $instances = array();

    /**
     * class attributes
     */
    protected $id = 0;
    protected $course_id = 0;
    protected $program_assessment_method_id = 0;
    protected $text_en = '';
    protected $text_ar = '';

    /**
     * @return Cm_Course_Assessment_Method_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Cm_Course_Assessment_Method_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Cm_Course_Assessment_Method
     */
    public static function get_instance($id)
    {

        $id = intval($id);

        if (isset(self::$instances[$id])) {
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
     * @return Orm_Cm_Course_Assessment_Method[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array())
    {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one row as Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Cm_Course_Assessment_Method
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Cm_Course_Assessment_Method();
    }

    /**
     * get count
     *
     * @param array $filters
     * @return int
     */
    public static function get_count($filters = array())
    {
        return self::get_model()->get_all($filters, 0, 0, array(), Orm::FETCH_COUNT);
    }

    public function to_array()
    {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['course_id'] = $this->get_course_id();
        $db_params['program_assessment_method_id'] = $this->get_program_assessment_method_id();
        $db_params['text_en'] = $this->get_text_en();
        $db_params['text_ar'] = $this->get_text_ar();

        return $db_params;
    }

    public function save()
    {
        if ($this->get_object_status() == 'new') {
            $insert_id = self::get_model()->insert($this->to_array());
            $this->set_id($insert_id);
        } elseif ($this->get_object_fields()) {
            self::get_model()->update($this->get_id(), $this->get_object_fields());
        }

        $this->set_object_status('saved');
        $this->reset_object_fields();
        return $this->get_id();
    }

    public function delete()
    {
        return self::get_model()->delete($this->get_id());
    }

    public function set_id($value)
    {
        $this->add_object_field('id', $value);
        $this->id = $value;

        $this->push_instance();
    }

    public function get_id()
    {
        return $this->id;
    }

    public function set_course_id($value)
    {
        $this->add_object_field('course_id', $value);
        $this->course_id = $value;
    }

    public function get_course_id()
    {
        return $this->course_id;
    }

    public function set_program_assessment_method_id($value)
    {
        $this->add_object_field('program_assessment_method_id', $value);
        $this->program_assessment_method_id = $value;
    }

    public function get_program_assessment_method_id()
    {
        return $this->program_assessment_method_id;
    }

    /**
     * get all data of assessment methods using assessment method id
     * @return Orm_Cm_Program_Assessment_Method
     */
    public function get_program_assessment_method_obj()
    {
        return Orm_Cm_Program_Assessment_Method::get_instance($this->get_program_assessment_method_id());
    }

    public function set_text_en($value)
    {
        $this->add_object_field('text_en', $value);
        $this->text_en = $value;
    }

    public function get_text_en()
    {
        return $this->text_en;
    }

    public function set_text_ar($value)
    {
        $this->add_object_field('text_ar', $value);
        $this->text_ar = $value;
    }

    public function get_text_ar()
    {
        return $this->text_ar;
    }

    /**
     * get name of assessment method depends on active language
     * @param mixed|null|string $lang
     * @return string
     */
    public function get_text($lang = UI_LANG)
    {
        return $lang === 'arabic' ? $this->get_text_ar() : $this->get_text_en();
    }

    /**
     * get  score for assessment method
     * @param $course_id
     * @param int $method_id
     * @param int $domain_id
     * @param int $outcome_id
     * @param int $section_id
     * @param int $student_id
     * @return string
     */
    public static function get_score($course_id, $method_id = 0, $domain_id = 0, $outcome_id = 0, $section_id = 0, $student_id = 0)
    {
        return self::get_model()->get_score($method_id, $course_id, $domain_id, $outcome_id, $section_id, $student_id);
    }

    /**
     * get the archive data using semester
     * @param $semester_id
     */
    public static function archive($semester_id)
    {
        self::get_model()->archive($semester_id);
    }

    /**
     * convert the data to csv file
     * @param $section_id
     * @param $method_id
     */
    public function generate_csv($section_id, $method_id)
    {

        $files_dir = '/files/Documents/' . $this->get_attachments_directory();

        $files_full_dir = rtrim(FCPATH, '/') . $files_dir;
        if (!is_dir($files_full_dir)) {
            mkdir($files_full_dir, 0777, true);
        }
        $method = $this->get_assessment_method($method_id);
        $name = str_replace(DIRECTORY_SEPARATOR, '-', $method->get_text()) . '.csv';
        $name = str_replace(' ', '_', $name);
        $file_name = rtrim($files_full_dir, '/') . '/' . $name;


        $csv = fopen($file_name, 'w');
//        fwrite($csv, "sep=;\n");
        $section = $this->get_section($section_id);
        fputcsv($csv, ['Method name', $method->get_text()], ';');
        fputcsv($csv, ['Section name', $section->get_name() . '-' . $section->get_course_obj()->get_name()], ';');
        fputcsv($csv, ['', '', '']);
        $final_score = 0;

        $numItems = count($this->get_questions($section->get_id(), $method->get_id()));
        $i = 0;
        $overAll = 0;
        $first_line[] = 'Student name';
        foreach ($this->get_questions($section->get_id(), $method->get_id()) as $key => $question) {
            $first_line[] = $question->get_question() . '(' . $question->get_full_mark() . ')';
            $overAll += $question->get_full_mark();
            if (++$i === $numItems) {
            }
        }
        $first_line[] = 'Overall Mark' . '(' . $overAll . ')';
        fputcsv($csv, $first_line, ';');
        $second_line = [];
        foreach ($this->get_students($section->get_id()) as $OneStudent) {
            $second_line[] = $OneStudent->get_user_obj()->get_full_name();
//            fputcsv($csv , ['Student name' , $OneStudent->get_user_obj()->get_full_name()],';');
//
            foreach ($this->get_questions($section->get_id(), $method->get_id()) as $question) {

                $score = Orm_Cm_Section_Student_Assessment::get_one(array('section_id' => $section->get_id(), 'student_id' => $OneStudent->get_user_id(), 'section_mapping_question_id' => $question->get_id()));
                $second_line[] = $score->get_score() ? htmlfilter(round($score->get_score(), 2)) : 0;
                $final_score += $score->get_score();
//                fputcsv($csv , [$question->get_question().'-'.'Score' , $score->get_score() ? htmlfilter(round($score->get_score(),2)) : 0 ],';');

            }
            $second_line[] = $final_score;

//            fputcsv($csv , ['Final Score' , $final_score], ';');
            $final_score = 0;
            fputcsv($csv, $second_line, ';');
            $second_line = [];
        }

        fclose($csv);
        $this->get_ci()->output->set_header("Content-type: text/csv; charset=utf-8; encoding=UTF-8");
        $this->get_ci()->output->set_header("Content-Disposition: attachment; filename=" . basename($file_name));
        $this->get_ci()->output->set_header("Pragma: no-cache");
        $this->get_ci()->output->set_header("Expires: 0");
        $this->get_ci()->output->set_header('Content-Length: ' . filesize($file_name));

        readfile($file_name);
        return;
    }

    /**
     * get the path (url) for the file that will exist in
     * @return int|string
     */
    public function get_attachments_directory()
    {
        $path = Orm_Semester::get_active_semester()->get_year();
        $path .= '/Curriculum';
        return $path;
    }

    /**
     * get xourse assessment method using assessment method id
     * @param $method_id
     * @return Orm_Cm_Course_Assessment_Method
     */
    public function get_assessment_method($method_id)
    {
        return Orm_Cm_Course_Assessment_Method::get_instance($method_id);
    }

    /**
     * get course section data using section id
     * @param $section_id
     * @return Orm_Course_Section
     */
    public function get_section($section_id)
    {
        return Orm_Course_Section::get_instance($section_id);
    }

    /**
     * get question of assessment method using section and assessment method id
     * @param $section
     * @param $method
     * @return int|Orm_Cm_Section_Mapping_Question[]
     */
    public function get_questions($section, $method)
    {
        return Orm_Cm_Section_Mapping_Question::get_all(['section_id' => $section, 'course_assessment_method_id' => $method]);
    }

    /**
     * get student of section useing section id
     * @param $section
     * @return int|Orm_Course_Section_Student[]
     */
    public function get_students($section)
    {
        return Orm_Course_Section_Student::get_all(['section_id' => $section]);
    }

    /**
     * export report of examination as csv file
     * @param $section_id
     * @param $row_id
     */
    public function generate_examination_csv($section_id, $row_id)
    {

        $files_dir = '/files/Documents/' . $this->get_attachments_directory();

        $files_full_dir = rtrim(FCPATH, '/') . $files_dir;
        if (!is_dir($files_full_dir)) {
            mkdir($files_full_dir, 0777, true);
        }
        $exam = $this->get_exams($row_id);
        $name = str_replace(DIRECTORY_SEPARATOR, '-', $exam->get_name()) . '.csv';
        $name = str_replace(' ', '_', $name);
        $file_name = rtrim($files_full_dir, '/') . '/' . $name;


        $csv = fopen($file_name, 'w');
        fwrite($csv, "sep=;\n");
        $section = $this->get_section($section_id);
        fputcsv($csv, ['Exam name', $exam->get_name()], ';');
        fputcsv($csv, ['Section name', $section->get_name() . '-' . $section->get_course_obj()->get_name()], ';');
        fputcsv($csv, ['', '', '']);
        $final_score = 0;
        $numItems = count($exam->get_questions());
        $i = 0;
        $overAll = 0;
        $first_line[] = 'Student name';
        foreach ($exam->get_questions() as $key => $question) {
            $first_line[] = $question->get_question_id(true)->get_text() . '(' . $question->get_mark() . ')';
            $overAll += $question->get_mark();
            if (++$i === $numItems) {
            }
        }
        $first_line[] = 'Overall Mark' . '(' . $overAll . ')';
        fputcsv($csv, $first_line, ';');
        $second_line = [];
        foreach ($this->get_students($section->get_id()) as $OneStudent) {
            $second_line[] = $OneStudent->get_user_obj()->get_full_name();
//            fputcsv($csv , ['Student name' , $OneStudent->get_user_obj()->get_full_name()],';');

            $marks = Orm_Tst_Exam_Student_Mark::get_model()->get_all(['exam_id' => $exam->get_id(), 'user_id' => $OneStudent->get_user_id()], 0, 0, [], Orm::FETCH_ARRAY);

            if (count($marks)) {
                $marks = array_column($marks, 'mark', 'question_id');
            }
            foreach ($exam->get_questions() as $question) {

                $mark = isset($marks[$question->get_question_id()]) ? $marks[$question->get_question_id()] : 0;
                $final_score += $mark;
//                $score = Orm_Cm_Section_Student_Assessment::get_one(array('section_id' => $section->get_id(),'student_id'=>$OneStudent->get_user_id(),'section_mapping_question_id' => $question->get_id()));
                $second_line[] = $mark;
//                fputcsv($csv , [$question->get_question().'-'.'Score' , $score->get_score() ? htmlfilter(round($score->get_score(),2)) : 0 ],';');

            }
            $second_line[] = $final_score;

//            fputcsv($csv , ['Final Score' , $final_score], ';');
            $final_score = 0;
            fputcsv($csv, $second_line, ';');
            $second_line = [];
        }

        fclose($csv);
        $this->get_ci()->output->set_header("Content-type: text/csv; charset=utf-8; encoding=UTF-8");
        $this->get_ci()->output->set_header("Content-Disposition: attachment; filename=" . basename($file_name));
        $this->get_ci()->output->set_header("Pragma: no-cache");
        $this->get_ci()->output->set_header("Expires: 0");
        $this->get_ci()->output->set_header('Content-Length: ' . filesize($file_name));

        readfile($file_name);
        return;
    }

    /**
     * get exam information using exam id
     * @param $row_id
     * @return Orm_Tst_Exam
     */
    public function get_exams($row_id)
    {
        return Orm_Tst_Exam::get_instance($row_id);
    }
}

