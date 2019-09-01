<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron_Job_Model extends CI_Model {
    
    /**
    * get table rows according to the assigned filters and page
    *
    * @param array $filters
    * @param int $page
    * @param int $per_page
    * @param array $orders
    * @param int $fetch_as
    *
    * @return array | Orm_Cron_Job | Orm_Cron_Job[] | int
    */
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS) {

        if(empty($orders)) {
            $orders = ['schedule DESC', 'id DESC'];
        }
        
        $page = (int) $page;
        $per_page = (int) $per_page;
        
        $this->db->select('cj.*');
        $this->db->distinct();
        $this->db->from(Orm_Cron_Job::get_table_name().' AS cj');
        
        if (isset($filters['id'])) {
            $this->db->where('cj.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('cj.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('cj.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('cj.id', $filters['not_in_id']);
        }
        if (!empty($filters['job'])) {
            $this->db->where('cj.job', $filters['job']);
        }
        if (!empty($filters['user_added'])) {
            $this->db->where('cj.user_added', $filters['user_added']);
        }
        if (!empty($filters['date_added'])) {
            $this->db->where('cj.date_added', $filters['date_added']);
        }
        if (isset($filters['is_released'])) {
            $this->db->where('cj.is_released', $filters['is_released']);
        }
        if (isset($filters['schedule'])) {
            $this->db->where('cj.schedule', $filters['schedule']);
        }
        if (!empty($filters['date_released'])) {
            $this->db->where('cj.date_released', $filters['date_released']);
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
            return Orm_Cron_Job::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Cron_Job::to_object($row);
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
        $this->db->insert(Orm_Cron_Job::get_table_name(), $params);
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
        return $this->db->update(Orm_Cron_Job::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Cron_Job::get_table_name(), array('id' => (int) $id));
    }

    /**
     * @param $job
     * @return string
     */
    public function get_max_released_date($job)
    {
        $this->db->select_max('date_released');
        $this->db->where('job', $job);
        $this->db->where('is_released', 1);
        $result = $this->db->get(Orm_Cron_Job::get_table_name())->row_array();

        return (!empty($result['date_released']) ? $result['date_released'] : '');
    }
}

