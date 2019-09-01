<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cm_Program_Assessment_Method_Model extends CI_Model {
    
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

            $logs = Orm_Cm_Program_Assessment_Method_Log::get_model()->get_all($filters, $page, $per_page, $orders, $log_fetch_as);

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
                    return Orm_Cm_Program_Assessment_Method::to_object(isset($result[0]) ? $result[0] : array());
                    break;
                case Orm::FETCH_OBJECTS:
                    $objects = array();
                    foreach($result as $row) {
                        $objects[] = Orm_Cm_Program_Assessment_Method::to_object($row);
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
        
        $this->db->select('cpam.*');
        $this->db->distinct();
        $this->db->from(Orm_Cm_Program_Assessment_Method::get_table_name() . ' AS cpam');
        
        if (isset($filters['id'])) {
            $this->db->where('cpam.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('cpam.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('cpam.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('cpam.id', $filters['not_in_id']);
        }
        if (isset($filters['program_id'])) {
            $this->db->where('cpam.program_id', $filters['program_id']);
        }
        if (isset($filters['assessment_method_id'])) {
            $this->db->where('cpam.assessment_method_id', $filters['assessment_method_id']);
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
            return Orm_Cm_Program_Assessment_Method::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Cm_Program_Assessment_Method::to_object($row);
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
        $this->db->insert(Orm_Cm_Program_Assessment_Method::get_table_name(), $params);
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
        return $this->db->update(Orm_Cm_Program_Assessment_Method::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Cm_Program_Assessment_Method::get_table_name(), array('id' => $id));
    }

    /**
     * get the data depends on old semester or archive "log" data
     * @param $semester_id
     */
    public function archive($semester_id) {

        $this->db->select('*');
        $this->db->from(Orm_Cm_Program_Assessment_Method::get_table_name());
        $current_data = $this->db->get()->result_array();

        foreach ($current_data as $current) {

            $archive = array_combine(
                array_map(function($k){ return 'log_' . $k; }, array_keys($current)),
                $current
            );

            $archive['semester_id'] = $semester_id;

            $this->db->insert(Orm_Cm_Program_Assessment_Method_Log::get_table_name(), $archive);
        }
    }
    
}

