<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 * Class Cm_Program_Learning_Outcome_Target_Model
 */
class Cm_Program_Learning_Outcome_Target_Model extends CI_Model {
    
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

            $logs = Orm_Cm_Program_Learning_Outcome_Target_Log::get_model()->get_all($filters, $page, $per_page, $orders, $log_fetch_as);

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
                    return Orm_Cm_Program_Learning_Outcome_Target::to_object(isset($result[0]) ? $result[0] : array());
                    break;
                case Orm::FETCH_OBJECTS:
                    $objects = array();
                    foreach($result as $row) {
                        $objects[] = Orm_Cm_Program_Learning_Outcome_Target::to_object($row);
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
        
        $this->db->select('cplot.*');
        $this->db->distinct();
        $this->db->from(Orm_Cm_Program_Learning_Outcome_Target::get_table_name() . ' AS cplot');
        
        if (isset($filters['id'])) {
            $this->db->where('cplot.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('cplot.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('cplot.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('cplot.id', $filters['not_in_id']);
        }
        if (isset($filters['program_learning_outcome_id'])) {
            $this->db->where('cplot.program_learning_outcome_id', $filters['program_learning_outcome_id']);
        }
        if (isset($filters['target'])) {
            $this->db->where('cplot.target', $filters['target']);
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
            return Orm_Cm_Program_Learning_Outcome_Target::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Cm_Program_Learning_Outcome_Target::to_object($row);
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
        $this->db->insert(Orm_Cm_Program_Learning_Outcome_Target::get_table_name(), $params);
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
        return $this->db->update(Orm_Cm_Program_Learning_Outcome_Target::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Cm_Program_Learning_Outcome_Target::get_table_name(), array('id' => $id));
    }

    /**
     * get the data depends on old semester or archive "log" data
     * @param $semester_id
     */
    public function archive($semester_id) {

        $this->db->select('*');
        $this->db->from(Orm_Cm_Program_Learning_Outcome_Target::get_table_name());
        $current_data = $this->db->get()->result_array();

        foreach ($current_data as $current) {

            $archive = array_combine(
                array_map(function($k){ return 'log_' . $k; }, array_keys($current)),
                $current
            );

            $archive['semester_id'] = $semester_id;

            $this->db->insert(Orm_Cm_Program_Learning_Outcome_Target_Log::get_table_name(), $archive);
        }
    }

    /**
     * get target of domain depends on the average of course learning outcome target
     * @param int $college_id
     * @param int $program_id
     * @param int $course_id
     * @return array
     */
    public function get_domain_target($college_id = 0, $program_id = 0, $course_id = 0) {

        if ($course_id) {
            $this->db->select('AVG(cclot.target) as target, cclo.learning_domain_id as domain_id');
            $this->db->from(Orm_Cm_Course_Learning_Outcome_Target::get_table_name() . ' AS cclot');
            $this->db->join(Orm_Cm_Course_Learning_Outcome::get_table_name() . ' AS cclo', 'cclot.course_learning_outcome_id = cclo.id');

            $this->db->where('cclo.course_id', $course_id);

            $this->db->group_by('cclo.learning_domain_id');

        } else {
            $this->db->select('AVG(cplot.target) as target, cplo.learning_domain_id as domain_id');
            $this->db->from(Orm_Cm_Program_Learning_Outcome_Target::get_table_name() . ' AS cplot');
            $this->db->join(Orm_Cm_Program_Learning_Outcome::get_table_name() . ' AS cplo', 'cplot.program_learning_outcome_id = cplo.id');

            if ($program_id) {
                $this->db->where('cplo.program_id', $program_id);
            } elseif ($college_id) {
                $this->db->join(Orm_Program::get_table_name() . ' AS p','p.id = cplo.program_id');
                $this->db->join(Orm_Department::get_table_name() . ' AS d', 'd.id = p.department_id');
                $this->db->where('d.college_id', $college_id);
            }

            $this->db->group_by('cplo.learning_domain_id');
        }

        $rows = $this->db->get()->result_array();
        $result = array();

        foreach ($rows as $row) {
            $result[$row['domain_id']] = $row['target'];
        }

        return $result;
    }

    /**
     * get the average target of program depends on course learning outcomes if its offerd or the oringin program learning outcomes if program id not sent
     * @param $domain_id
     * @param int $college_id
     * @param int $program_id
     * @return array
     */
    public function get_domain_level_target($domain_id, $college_id = 0, $program_id = 0) {

        if ($program_id) {

            $this->db->select('AVG(cclot.target) AS target, cclo.course_id AS id');

//            $this->db->select('AVG(cclot.target) as target, cclo.id as outcome_id');
            $this->db->from(Orm_Cm_Course_Learning_Outcome_Target::get_table_name() . ' AS cclot');
            $this->db->join(Orm_Cm_Course_Learning_Outcome::get_table_name() . ' AS cclo', 'cclot.course_learning_outcome_id = cclo.id');
            $this->db->join(Orm_Cm_Course_Offered_Program::get_table_name() . ' AS ccop', 'ccop.course_id = cclo.course_id');

            $this->db->where('ccop.program_id', $program_id);
            $this->db->where('cclo.learning_domain_id', $domain_id);

            $this->db->group_by('cclo.course_id');

        } else {
            $this->db->from(Orm_Cm_Program_Learning_Outcome_Target::get_table_name() . ' AS cplot');
            $this->db->join(Orm_Cm_Program_Learning_Outcome::get_table_name() . ' AS cplo', 'cplot.program_learning_outcome_id = cplo.id');

            if ($college_id) {
                $this->db->select('AVG(cplot.target) as target, p.id as id');

                $this->db->join(Orm_Program::get_table_name() . ' AS p','p.id = cplo.program_id');
                $this->db->join(Orm_Department::get_table_name() . ' AS d', 'd.id = p.department_id');
                $this->db->where('d.college_id', $college_id);

                $this->db->group_by('p.id');
            } else {
                $this->db->select('AVG(cplot.target) as target, d.college_id as id');

                $this->db->join(Orm_Program::get_table_name() . ' AS p','p.id = cplo.program_id');
                $this->db->join(Orm_Department::get_table_name() . ' AS d', 'd.id = p.department_id');

                $this->db->group_by('d.college_id');
            }
        }

        $rows = $this->db->get()->result_array();

        $result = array();

        foreach ($rows as $row) {
            $result[$row['id']] = $row['target'];
        }

        return $result;
    }

    /**
     * get the learning outcomes average scores
     * @param $domain_id
     * @param int $college_id
     * @param int $program_id
     * @param int $course_id
     * @return array
     */
    public function get_outcomes_score($domain_id, $college_id = 0, $program_id = 0, $course_id = 0) {
        if ($course_id) {
            $this->db->select('AVG(cclot.target) as target, cclo.id as outcome_id');

            $this->db->from(Orm_Cm_Course_Learning_Outcome_Target::get_table_name() . ' AS cclot');
            $this->db->join(Orm_Cm_Course_Learning_Outcome::get_table_name() . ' AS cclo', 'cclot.course_learning_outcome_id = cclo.id');

            $this->db->where('cclo.course_id', $course_id);
            $this->db->where('cclo.learning_domain_id', $domain_id);

            $this->db->group_by('cclo.id');
        } else {

            $this->db->from(Orm_Cm_Program_Learning_Outcome_Target::get_table_name() . ' AS cplot');
            $this->db->join(Orm_Cm_Program_Learning_Outcome::get_table_name() . ' AS cplo', 'cplot.program_learning_outcome_id = cplo.id');

            if ($program_id) {
                $this->db->select('AVG(cplot.target) as target, cplo.id as outcome_id');
                $this->db->where('cplo.program_id', $program_id);
            } elseif ($college_id) {
                $this->db->select('AVG(cplot.target) as target, cplo.learning_outcome_id as outcome_id');

                $this->db->join(Orm_Program::get_table_name() . ' AS p','p.id = cplo.program_id');
                $this->db->join(Orm_Department::get_table_name() . ' AS d', 'd.id = p.department_id');

                $this->db->where('d.college_id', $college_id);
            } else {
                $this->db->select('AVG(cplot.target) as target, cplo.learning_outcome_id as outcome_id');
            }

            $this->db->where('cplo.learning_domain_id', $domain_id);

            $this->db->group_by('cplo.id');
        }

        $rows = $this->db->get()->result_array();

        $result = array();

        foreach ($rows as $row) {
            $result[$row['outcome_id']] = $row['target'];
        }

        return $result;
    }
}

