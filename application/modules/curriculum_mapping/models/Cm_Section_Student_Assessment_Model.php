<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 * Class Cm_Section_Student_Assessment_Model
 */
class Cm_Section_Student_Assessment_Model extends CI_Model {
    
    /**
    * get table rows according to the assigned filters and page
    *
    * @param array $filters
    * @param int $page
    * @param int $per_page
    * @param array $orders
    * @param int $fetch_as
    *
    * @return array
    */
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS) {
        
        $page = (int) $page;
        $per_page = (int) $per_page;
        
        $this->db->select('cssa.*');
        $this->db->distinct();
        $this->db->from(Orm_Cm_Section_Student_Assessment::get_table_name() . ' AS cssa');
        
        if (isset($filters['id'])) {
            $this->db->where('cssa.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('cssa.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('cssa.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('cssa.id', $filters['not_in_id']);
        }
        if (isset($filters['section_id'])) {
            $this->db->where('cssa.section_id', $filters['section_id']);
        }
        if (isset($filters['student_id'])) {
            $this->db->where('cssa.student_id', $filters['student_id']);
        }
        if (isset($filters['section_mapping_question_id'])) {
            $this->db->where('cssa.section_mapping_question_id', $filters['section_mapping_question_id']);
        }
        if (isset($filters['score'])) {
            $this->db->where('cssa.score', $filters['score']);
        }
        
        if ($orders) {
            $this->db->order_by(implode(',', $orders));
        }
        
        if ($page) {
            $offset = ($page - 1) * $per_page;
            $this->db->limit($per_page, $offset);
        }
        
        switch($fetch_as) {
            case Orm::FETCH_OBJECT:
            return Orm_Cm_Section_Student_Assessment::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Cm_Section_Student_Assessment::to_object($row);
            }
            return $objects;
            break;
            case Orm::FETCH_ARRAY:
            return $this->db->get()->result_array();
            break;
            case Orm::FETCH_COUNT:
            return $this->db->count_all_results();
            break;
        }
    }

    /**
     * get total number of student that assessed on  specific assessment method
     * @param $section_id
     * @param $assessment_method_id
     * @return int
     */
    public function get_number_of_assessed_students($section_id, $assessment_method_id) {
        $this->db->select('count(DISTINCT student_id) as TOTAL');
        $this->db->from(Orm_Cm_Section_Student_Assessment::get_table_name(). ' AS cssa');
        $this->db->join(Orm_Cm_Section_Mapping_Question::get_table_name() . ' AS csmq', 'cssa.section_mapping_question_id = csmq.id');
        $this->db->where('csmq.course_assessment_method_id', $assessment_method_id);
        $this->db->where('csmq.section_id', $section_id);
        $result = $this->db->get()->row_array();

        return isset($result['TOTAL']) ? $result['TOTAL'] : 0;
    }

    /**
     * get total score ( average ) for assessment method
     * @param $college_id
     * @param $program_id
     * @param $course_id
     * @param $section_id
     * @param $student_id
     * @return array
     */
    public function get_scores_assessment_methods($college_id, $program_id, $course_id, $section_id, $student_id) {

        $this->db->select_avg('CASE WHEN csmq.full_mark > 0 THEN cssa.score / csmq.full_mark ELSE 0 END * 100 AS SCORE');

        if ($course_id || $section_id || $student_id) {
            $this->db->select('ccam.id as assessment_method');
        } else {
            $this->db->select('cam.id as assessment_method');
        }

        $this->db->from(Orm_Cm_Section_Student_Assessment::get_table_name() . ' AS cssa');
        $this->db->join(Orm_Cm_Section_Mapping_Question::get_table_name() . ' AS csmq', 'cssa.section_mapping_question_id = csmq.id');
        $this->db->join(Orm_Course_Section::get_table_name() . ' AS cs', 'cs.id = csmq.section_id');
        $this->db->join(Orm_Cm_Course_Assessment_Method::get_table_name() . ' AS ccam', 'ccam.id = csmq.course_assessment_method_id');
        $this->db->join(Orm_Cm_Program_Assessment_Method::get_table_name() . ' AS cpam', 'cpam.id = ccam.program_assessment_method_id');
        $this->db->join(Orm_Cm_Assessment_Method::get_table_name() . ' AS cam', 'cam.id = cpam.assessment_method_id');

        if ($program_id) {
            $this->db->join(Orm_Program_Plan::get_table_name() . ' AS pp ', 'pp.course_id = cs.id');
            $this->db->join(Orm_Program::get_table_name() . ' AS p ', 'p.id = pp.program_id');
            $this->db->join(Orm_Department::get_table_name() . ' AS d ', 'p.department_id = d.id');
            $this->db->join(Orm_College::get_table_name() . ' AS c ', 'c.id = d.college_id');

            License::valid_programs('p.id');
        } else {
            $this->db->join(Orm_Course::get_table_name() . ' AS crs ', 'crs.id = cs.course_id');
            $this->db->join(Orm_Department::get_table_name() . ' AS d ', 'crs.department_id = d.id');
            $this->db->join(Orm_College::get_table_name() . ' AS c ', 'c.id = d.college_id');
        }

        License::valid_colleges('c.id');

        $this->db->where('cs.semester_id', Orm_Semester::get_active_semester()->get_id());

        if ($college_id) {
            $this->db->where('c.id', $college_id);
        }
        if ($program_id) {
            $this->db->where('p.id', $program_id);
        }
        if ($course_id) {
            $this->db->where('cs.course_id', $course_id);
        }
        if ($section_id) {
            $this->db->where('cs.id', $section_id);
        }
        if ($student_id) {
            $this->db->where('cssa.student_id', $student_id);
        }

        if ($course_id || $section_id || $student_id) {
            $this->db->group_by('cam.id, ccam.id');
        } else {
            $this->db->group_by('cam.id');
        }

        $result = $this->db->get()->result_array();

        $scores = array();
        foreach ($result as $row) {
            $scores[$row['assessment_method']] = $row['SCORE'];
        }

        return $scores;
    }

    /**
     * get average score for learning domain
     * @param $college_id
     * @param $program_id
     * @param $course_id
     * @param $section_id
     * @param $student_id
     * @return array
     */
    public function get_learning_domain_score($college_id, $program_id, $course_id, $section_id, $student_id) {

        $semester_id = Orm_Semester::get_active_semester()->get_id();
        $this->db->select('AVG(cssa.score / csmq.full_mark * 100) AS score, cld.id AS domain_id');

        $this->db->from(Orm_Cm_Section_Student_Assessment::get_table_name() . ' AS cssa');
        $this->db->join(Orm_Cm_Section_Mapping_Question::get_table_name() . ' AS csmq', 'cssa.section_mapping_question_id = csmq.id');
        $this->db->join(Orm_Course_Section::get_table_name() . ' AS cs', 'cs.id = csmq.section_id');
        $this->db->join(Orm_Cm_Course_Learning_Outcome::get_table_name() . ' AS cclo', "csmq.course_learning_outcomes_ids LIKE CONCAT('%',cclo.id,'%')");
        $this->db->join(Orm_Cm_Learning_Domain::get_table_name() . ' AS cld', 'cclo.learning_domain_id = cld.id');


        if (!is_null($program_id)) {
            $this->db->join(Orm_Program_Plan::get_table_name() . ' AS pp ', 'pp.course_id = cs.course_id');
            $this->db->join(Orm_Program::get_table_name() . ' AS p ', 'p.id = pp.program_id');
            $this->db->join(Orm_Department::get_table_name() . ' AS d ', 'p.department_id = d.id');
            $this->db->join(Orm_College::get_table_name() . ' AS c ', 'c.id = d.college_id');

            License::valid_programs('p.id');
        } else {
            $this->db->join(Orm_Course::get_table_name() . ' AS crs ', 'crs.id = cs.course_id');
            $this->db->join(Orm_Department::get_table_name() . ' AS d ', 'crs.department_id = d.id');
            $this->db->join(Orm_College::get_table_name() . ' AS c ', 'c.id = d.college_id');
        }

        License::valid_colleges('c.id');

        $this->db->where('cs.semester_id', $semester_id);
        $this->db->where('csmq.full_mark <>', '0');

        if (!is_null($college_id)) {
            $this->db->where('c.id', intval($college_id));
        }
        if (!is_null($program_id)) {
            $this->db->where('p.id', intval($program_id));
        }
        if (!is_null($course_id)) {
            $this->db->where('cs.course_id', intval($course_id));
        }
        if (!is_null($section_id)) {
            $this->db->where('cs.id', intval($section_id));
        }
        if (!is_null($student_id)) {
            $this->db->where('cssa.student_id', intval($student_id));
        }

        $this->db->group_by('cld.id');

        return $this->db->get()->result_array();
    }

    /**
     * get avreage score for learninf domain depends on level
     * @param $domain_id
     * @param $college_id
     * @param $program_id
     * @param $course_id
     * @param $section_id
     * @return array
     */
    public function get_level_learning_domain_score($domain_id, $college_id, $program_id, $course_id, $section_id) {

        $semester_id = Orm_Semester::get_active_semester()->get_id();
        if (!is_null($college_id)) {
            $this->db->select('AVG(cssa.score / csmq.full_mark * 100) AS score, p.id AS program_id');
        } elseif (!is_null($program_id)) {
            $this->db->select('AVG(cssa.score / csmq.full_mark * 100) AS score, crs.id AS course_id');
        } elseif (!is_null($course_id)) {
            $this->db->select('AVG(cssa.score / csmq.full_mark * 100) AS score, cssa.section_id AS section_id');
        } elseif (!is_null($section_id)) {
            $this->db->select('AVG(cssa.score / csmq.full_mark * 100) AS score, cssa.student_id AS student_id');
        } else {
            $this->db->select('AVG(cssa.score / csmq.full_mark * 100) AS score, c.id AS college_id');
        }

        $this->db->from(Orm_Cm_Section_Student_Assessment::get_table_name() . ' AS cssa');
        $this->db->join(Orm_Cm_Section_Mapping_Question::get_table_name() . ' AS csmq', 'cssa.section_mapping_question_id = csmq.id');
        $this->db->join(Orm_Cm_Course_Learning_Outcome::get_table_name() . ' AS cclo', "csmq.course_learning_outcomes_ids LIKE CONCAT('%',cclo.id,'%')");
        $this->db->join(Orm_Cm_Program_Learning_Outcome::get_table_name() . ' AS cplo', 'cplo.id = cclo.program_learning_outcome_id');
        $this->db->join(Orm_Cm_Learning_Domain::get_table_name() . ' AS cld', 'cplo.learning_domain_id = cld.id');

        $this->db->join(Orm_Course_Section::get_table_name() . ' AS cs', 'cs.id = csmq.section_id');
        $this->db->join(Orm_Course::get_table_name() . ' AS crs', 'crs.id = cs.course_id');

        $this->db->join(Orm_Cm_Course_Offered_Program::get_table_name() . ' AS ccop ', 'ccop.course_id = crs.id');
        $this->db->join(Orm_Program::get_table_name() . ' AS p ', 'p.id = ccop.program_id');
        $this->db->join(Orm_Department::get_table_name() . ' AS d ', 'p.department_id = d.id');
        $this->db->join(Orm_College::get_table_name() . ' AS c ', 'c.id = d.college_id');

        License::valid_colleges('c.id');
        License::valid_programs('p.id');

        $this->db->where('cs.semester_id', $semester_id);
        $this->db->where('csmq.full_mark <>', '0');
        $this->db->where('cld.id', $domain_id);

        if (!is_null($college_id)) {
            $this->db->where('c.id', intval($college_id));
            $this->db->group_by('p.id');
        } elseif (!is_null($program_id)) {
            $this->db->where('p.id', intval($program_id));
            $this->db->group_by('crs.id');
        } elseif (!is_null($course_id)) {
            $this->db->where('crs.id', intval($course_id));
            $this->db->group_by('cs.id');
        } elseif (!is_null($section_id)) {
            $this->db->where('cs.id', intval($section_id));
            $this->db->group_by('cssa.student_id');
        } else {
            $this->db->group_by('c.id');
        }

        return $this->db->get()->result_array();
    }

    /**
     * get average scores for learning outcomes
     * @param $domain_id
     * @param $college_id
     * @param $program_id
     * @param $course_id
     * @param $section_id
     * @param $student_id
     * @return array
     */
    public function get_outcomes_score($domain_id, $college_id, $program_id, $course_id, $section_id, $student_id) {

        $semester_id = Orm_Semester::get_active_semester()->get_id();
        if (!is_null($college_id)) {
            $this->db->select('AVG(cssa.score / csmq.full_mark * 100) AS score, clo.id AS outcome_id');
        } elseif (!is_null($program_id)) {
            $this->db->select('AVG(cssa.score / csmq.full_mark * 100) AS score, cplo.id AS outcome_id');
        } elseif (!is_null($course_id)) {
            $this->db->select('AVG(cssa.score / csmq.full_mark * 100) AS score, cclo.id AS outcome_id');
        } elseif (!is_null($section_id)) {
            if (!is_null($student_id)) {
                $this->db->select('AVG(cssa.score / csmq.full_mark * 100) AS score, cclo.id AS outcome_id');
            } else {
                $this->db->select('AVG(cssa.score / csmq.full_mark * 100) AS score, cclo.id AS outcome_id');
            }
        } else {
            $this->db->select('AVG(cssa.score / csmq.full_mark * 100) AS score, clo.id AS outcome_id');
        }

        $this->db->from(Orm_Cm_Section_Student_Assessment::get_table_name() . ' AS cssa');
        $this->db->join(Orm_Cm_Section_Mapping_Question::get_table_name() . ' AS csmq', 'cssa.section_mapping_question_id = csmq.id');
        $this->db->join(Orm_Course_Section::get_table_name() . ' AS cs', 'cs.id = csmq.section_id');
        $this->db->join(Orm_Cm_Course_Learning_Outcome::get_table_name() . ' AS cclo', "csmq.course_learning_outcomes_ids LIKE CONCAT('%',cclo.id,'%')");
        $this->db->join(Orm_Cm_Program_Learning_Outcome::get_table_name() . ' AS cplo', 'cclo.program_learning_outcome_id = cplo.id');
        $this->db->join(Orm_Cm_Learning_Outcome::get_table_name() . ' AS clo', 'cplo.learning_outcome_id = clo.id');
        $this->db->join(Orm_Cm_Learning_Domain::get_table_name() . ' AS cld', 'cclo.learning_domain_id = cld.id');

        $this->db->join(Orm_Cm_Course_Offered_Program::get_table_name() . ' AS ccop ', 'ccop.course_id = cs.course_id');
        $this->db->join(Orm_Course::get_table_name() . ' AS crs ', 'crs.id = ccop.course_id');
        $this->db->join(Orm_Program::get_table_name() . ' AS p ', 'p.id = ccop.program_id');
        $this->db->join(Orm_Department::get_table_name() . ' AS d ', 'p.department_id = d.id');
        $this->db->join(Orm_College::get_table_name() . ' AS c ', 'c.id = d.college_id');

        License::valid_colleges('c.id');
        License::valid_programs('p.id');

        $this->db->where('cs.semester_id', $semester_id);
        $this->db->where('csmq.full_mark <>', '0');
        $this->db->where('cld.id', $domain_id);

        if (!is_null($college_id)) {
            $this->db->where('c.id', $college_id);
            $this->db->group_by('clo.id');
        }
        if (!is_null($program_id)) {
            $this->db->where('p.id', $program_id);
            $this->db->group_by('cplo.id');
        }
        if (!is_null($course_id)) {
            $this->db->where('cs.course_id', $course_id);
            $this->db->group_by('cclo.id');
        }
        if (!is_null($section_id)) {
            $this->db->where('cs.id', $section_id);

            if (!is_null($student_id)) {
                $this->db->where('cssa.student_id', $student_id);
            }

            $this->db->group_by('cclo.id');
        }
        if (is_null($college_id) && is_null($program_id) && is_null($course_id) && is_null($section_id) && is_null($student_id)) {
            $this->db->group_by('clo.id');
        }

        return $this->db->get()->result_array();
    }

    /**
     * get average of scores for assessment method and components
     * @param $college_id
     * @param $program_id
     * @param $course_id
     * @param $section_id
     * @param $student_id
     * @return array
     */
    public function get_assessment_method_score($college_id, $program_id, $course_id, $section_id, $student_id) {

        $semester_id = Orm_Semester::get_active_semester()->get_id();
        $this->db->select('AVG(cssa.score / csmq.full_mark * 100) AS score, cam.id AS method_id');

        $this->db->from(Orm_Cm_Section_Student_Assessment::get_table_name() . ' AS cssa');
        $this->db->join(Orm_Cm_Section_Mapping_Question::get_table_name() . ' AS csmq', 'cssa.section_mapping_question_id = csmq.id');
        $this->db->join(Orm_Cm_Course_Assessment_Method::get_table_name() . ' AS ccam', 'ccam.id = csmq.course_assessment_method_id');
        $this->db->join(Orm_Cm_Program_Assessment_Method::get_table_name() . ' AS cpam', 'cpam.id = ccam.program_assessment_method_id');
        $this->db->join(Orm_Cm_Assessment_Method::get_table_name() . ' AS cam', 'cam.id = cpam.assessment_method_id');

        $this->db->join(Orm_Course_Section::get_table_name() . ' AS cs', 'cs.id = csmq.section_id');
        $this->db->join(Orm_Course::get_table_name() . ' AS crs', 'crs.id = cs.course_id');

        $this->db->join(Orm_Cm_Course_Offered_Program::get_table_name() . ' AS ccop ', 'ccop.course_id = crs.id');
        $this->db->join(Orm_Program::get_table_name() . ' AS p ', 'p.id = ccop.program_id');
        $this->db->join(Orm_Department::get_table_name() . ' AS d ', 'p.department_id = d.id');
        $this->db->join(Orm_College::get_table_name() . ' AS c ', 'c.id = d.college_id');

        License::valid_colleges('c.id');
        License::valid_programs('p.id');

        $this->db->where('cs.semester_id', $semester_id);
        $this->db->where('csmq.full_mark <>', '0');

        if (!is_null($college_id)) {
            $this->db->where('c.id', $college_id);
        }
        if (!is_null($program_id)) {
            $this->db->where('p.id', $program_id);
        }
        if (!is_null($course_id)) {
            $this->db->where('crs.id', $course_id);
        }
        if (!is_null($section_id)) {
            $this->db->where('cs.id', $section_id);
        }
        if (!is_null($student_id)) {
            $this->db->where('cssa.student_id', $student_id);
        }

        $this->db->group_by('cam.id');

        return $this->db->get()->result_array();
    }

    /**
     * get average of scores for level assessment method and components
     * @param $method_id
     * @param $college_id
     * @param $program_id
     * @param $course_id
     * @param $section_id
     * @return array
     */
    public function get_level_assessment_method_score($method_id, $college_id, $program_id, $course_id, $section_id) {

        $semester_id = Orm_Semester::get_active_semester()->get_id();

        if (!is_null($college_id)) {
            $this->db->select('AVG(cssa.score / csmq.full_mark * 100) AS score, p.id AS program_id');
        } elseif (!is_null($program_id)) {
            $this->db->select('AVG(cssa.score / csmq.full_mark * 100) AS score, crs.id AS course_id');
        } elseif (!is_null($course_id)) {
            $this->db->select('AVG(cssa.score / csmq.full_mark * 100) AS score, cssa.section_id AS section_id');
        } elseif (!is_null($section_id)) {
            $this->db->select('AVG(cssa.score / csmq.full_mark * 100) AS score, cssa.student_id AS student_id');
        } else {
            $this->db->select('AVG(cssa.score / csmq.full_mark * 100) AS score, c.id AS college_id');
        }

        $this->db->from(Orm_Cm_Section_Student_Assessment::get_table_name() . ' AS cssa');
        $this->db->join(Orm_Cm_Section_Mapping_Question::get_table_name() . ' AS csmq', 'cssa.section_mapping_question_id = csmq.id');
        $this->db->join(Orm_Cm_Course_Assessment_Method::get_table_name() . ' AS ccam', 'ccam.id = csmq.course_assessment_method_id');
        $this->db->join(Orm_Cm_Program_Assessment_Method::get_table_name() . ' AS cpam', 'ccam.program_assessment_method_id = cpam.id');
        $this->db->join(Orm_Cm_Assessment_Method::get_table_name() . ' AS cam', 'cam.id = cpam.assessment_method_id');

        $this->db->join(Orm_Course_Section::get_table_name() . ' AS cs', 'cs.id = csmq.section_id');
        $this->db->join(Orm_Course::get_table_name() . ' AS crs', 'crs.id = cs.course_id');

        $this->db->join(Orm_Cm_Course_Offered_Program::get_table_name() . ' AS ccop ', 'ccop.course_id = crs.id');
        $this->db->join(Orm_Program::get_table_name() . ' AS p ', 'p.id = ccop.program_id');
        $this->db->join(Orm_Department::get_table_name() . ' AS d ', 'p.department_id = d.id');
        $this->db->join(Orm_College::get_table_name() . ' AS c ', 'c.id = d.college_id');

        License::valid_colleges('c.id');
        License::valid_programs('p.id');

        $this->db->where('cs.semester_id', $semester_id);
        $this->db->where('csmq.full_mark <>', '0');
        $this->db->where('cam.id', $method_id);

        if (!is_null($college_id)) {
            $this->db->where('c.id', $college_id);
            $this->db->group_by('p.id');
        } elseif (!is_null($program_id)) {
            $this->db->where('p.id', $program_id);
            $this->db->group_by('crs.id');
        } elseif (!is_null($course_id)) {
            $this->db->where('crs.id', $course_id);
            $this->db->group_by('cs.id');
        } elseif (!is_null($section_id)) {
            $this->db->where('cs.id', $section_id);
            $this->db->group_by('cssa.student_id');
        } else {
            $this->db->group_by('c.id');
        }

        return $this->db->get()->result_array();
    }

    /**
     *  get average of course scores for assessment method and components for
     * @param $course_id
     * @param $method_id
     * @param $domain_id
     * @param $outcome_id
     * @param $section_id
     * @param $student_id
     * @return float
     */
    public function get_course_assessment_method_score($course_id, $method_id, $domain_id, $outcome_id, $section_id, $student_id) {

        $semester_id = Orm_Semester::get_active_semester()->get_id();

        $this->db->select('AVG(cssa.score / csmq.full_mark * 100) AS score');

        $this->db->from(Orm_Cm_Section_Student_Assessment::get_table_name() . ' AS cssa');
        $this->db->join(Orm_Cm_Section_Mapping_Question::get_table_name() . ' AS csmq', 'cssa.section_mapping_question_id = csmq.id');
        $this->db->join(Orm_Cm_Course_Learning_Outcome::get_table_name() . ' AS cclo', "csmq.course_learning_outcomes_ids LIKE CONCAT('%',cclo.id,'%')");
        $this->db->join(Orm_Cm_Course_Assessment_Method::get_table_name() . ' AS ccam', 'ccam.id = csmq.course_assessment_method_id');
        $this->db->join(Orm_Cm_Learning_Domain::get_table_name() . ' AS cld', 'cclo.learning_domain_id = cld.id');
        $this->db->join(Orm_Course_Section::get_table_name() . ' AS cs', 'cs.id = csmq.section_id');

        $this->db->where('cs.semester_id', $semester_id);
        $this->db->where('csmq.full_mark <>', '0');
        if ($method_id) {
            $this->db->where('ccam.id', $method_id);
        }
        if ($domain_id) {
            $this->db->where('cld.id', $domain_id);
        }
        if ($outcome_id) {
            $this->db->where('cclo.id', $outcome_id);
        }
        if ($student_id) {
            $this->db->where('cssa.student_id', $student_id);
        }

        if ($section_id) {
            $this->db->where('cs.id', $section_id);
        } elseif ($course_id) {
            $this->db->where('cs.course_id', $course_id);
        }

        $result = $this->db->get()->row_array();

        return round(isset($result['score']) ? $result['score'] : 0, 2);
    }
    
    /**
    * insert new row to the table
    *
    * @param array $params
    * @return int
    */
    public function insert($params = array()) {
        $this->db->insert(Orm_Cm_Section_Student_Assessment::get_table_name(), $params);
        return $this->db->insert_id();
    }
    
    /**
    * update item
    *
    * @param int $id
    * @param array $params
    * @return boolean
    */
    public function update($id, $params = array()) {
        return $this->db->update(Orm_Cm_Section_Student_Assessment::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Cm_Section_Student_Assessment::get_table_name(), array('id' => $id));
    }
    
}

