<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Cm_Course_Assessment_Method_Model
 */
class Cm_Course_Assessment_Method_Model extends CI_Model {
    
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


        $semester = Orm_Semester::get_active_semester();

        if(!$semester->get_is_current()) {

            $orders = array_map(function($v){ return 'log_'.$v; }, $orders);

            $filters = array_combine(
                array_map(function($k){ return 'log_'.$k; }, array_keys($filters)),
                $filters
            );

            $filters['semester_id'] = $semester->get_id();

            $log_fetch_as = in_array($fetch_as, array(Orm::FETCH_OBJECT, Orm::FETCH_OBJECTS)) ? Orm::FETCH_ARRAY : $fetch_as;

            $logs = Orm_Cm_Course_Assessment_Method_Log::get_model()->get_all($filters, $page, $per_page, $orders, $log_fetch_as);

            $result = array();

            if(is_array($logs)) {

                foreach ($logs as $log) {

                    $temp_log = array_filter_key($log, function ($k) {
                        return strpos($k, 'log_') === 0;
                    });

                    $result[] = array_combine(
                        array_map(function($k) { return str_replace("log_", "", $k); }, array_keys($temp_log)),
                        $temp_log
                    );
                }
            }

            switch($fetch_as) {
                case Orm::FETCH_OBJECT:
                    return Orm_Cm_Course_Assessment_Method::to_object(isset($result[0]) ? $result[0] : array());
                    break;
                case Orm::FETCH_OBJECTS:
                    $objects = array();
                    foreach($result as $row) {
                        $objects[] = Orm_Cm_Course_Assessment_Method::to_object($row);
                    }
                    return $objects;
                    break;
                case Orm::FETCH_ARRAY:
                    return $result;
                    break;
                case Orm::FETCH_COUNT:
                    return $logs;
                    break;
            }
        }

        $page = (int) $page;
        $per_page = (int) $per_page;
        
        $this->db->select('ccam.*');
        $this->db->distinct();
        $this->db->from(Orm_Cm_Course_Assessment_Method::get_table_name() . ' AS ccam');
        
        if (isset($filters['id'])) {
            $this->db->where('ccam.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('ccam.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('ccam.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('ccam.id', $filters['not_in_id']);
        }
        if (isset($filters['course_id'])) {
            $this->db->where('ccam.course_id', $filters['course_id']);
        }
        if (isset($filters['program_assessment_method_id'])) {
            $this->db->where('ccam.program_assessment_method_id', $filters['program_assessment_method_id']);
        }
        if (isset($filters['program_assessment_method_in'])) {
            $this->db->where_in('ccam.program_assessment_method_id', $filters['program_assessment_method_in']);
        }
        if (!empty($filters['text_en'])) {
            $this->db->where('ccam.text_en', $filters['text_en']);
        }
        if (!empty($filters['text_ar'])) {
            $this->db->where('ccam.text_ar', $filters['text_ar']);
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
            return Orm_Cm_Course_Assessment_Method::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Cm_Course_Assessment_Method::to_object($row);
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
    * insert new row to the table
    *
    * @param array $params
    * @return int
    */
    public function insert($params = array()) {
        $this->db->insert(Orm_Cm_Course_Assessment_Method::get_table_name(), $params);
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
        return $this->db->update(Orm_Cm_Course_Assessment_Method::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Cm_Course_Assessment_Method::get_table_name(), array('id' => $id));
    }

    /**
     * get the average of values depends on scores
     * @param $method_id
     * @param $course_id
     * @param $domain_id
     * @param int $outcome_id
     * @param int $section_id
     * @param int $student_id
     * @return string
     */
    public function get_score($method_id, $course_id, $domain_id, $outcome_id = 0, $section_id = 0, $student_id = 0) {

        $this->db->select_avg('sa.value','score');
        $this->db->from(Orm_Cm_Course_Mapping_Matrix::get_table_name() .' AS cmm');
        $this->db->join(Orm_Cm_Student_Assessment::get_table_name() .' AS sa','cmm.id = sa.course_mapping_matrix_id','left');
        $this->db->join(Orm_Cm_Course_Learning_Outcome::get_table_name() .' AS clo','cmm.course_learning_outcome_id = clo.id', 'left');

        $this->db->where('sa.value is not null');
        $this->db->where('cmm.course_id',$course_id);
        if ($domain_id) {
            $this->db->where('clo.learning_domain_id',$domain_id);
        }
        if ($outcome_id) {
            $this->db->where('clo.id',$outcome_id);
        }
        if ($section_id) {
            $this->db->where('sa.section_id',$section_id);
        }
        if ($method_id) {
            $this->db->where('cmm.course_assessment_method_id',$method_id);
        }
        if ($student_id) {
            $this->db->where('sa.student_id',$student_id);
        }
        $result = $this->db->get()->row_array();

        return isset($result['score']) ? number_format($result['score'],2) : 'N/A';
    }

    /**
     * get the data depends on old semester or archive "log" data
     * @param $semester_id
     */
    public function archive($semester_id) {

        $this->db->select('*');
        $this->db->from(Orm_Cm_Course_Assessment_Method::get_table_name());
        $current_data = $this->db->get()->result_array();

        foreach ($current_data as $current) {

            $archive = array_combine(
                array_map(function($k){ return 'log_' . $k; }, array_keys($current)),
                $current
            );

            $archive['semester_id'] = $semester_id;

            $this->db->insert(Orm_Cm_Course_Assessment_Method_Log::get_table_name(), $archive);
        }
    }
}

