<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Node_Log_Model
 */
class Node_Log_Model extends CI_Model
{

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
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS)
    {

        $page = (int)$page;
        $per_page = (int)$per_page;

        $this->db->select('nl.*');
        $this->db->distinct();
        $this->db->from(Orm_Node_Log::get_table_name().' AS nl');

        if (isset($filters['id'])) {
            $this->db->where('nl.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('nl.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('nl.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('nl.id', $filters['not_in_id']);
        }
        if (isset($filters['logged_user_id'])) {
            $this->db->where('nl.logged_user_id', $filters['logged_user_id']);
        }
        if (!empty($filters['date_added'])) {
            $this->db->where('nl.date_added', $filters['date_added']);
        }
        if (isset($filters['node_id'])) {
            $this->db->where('nl.node_id', $filters['node_id']);
        }
        if (isset($filters['node_parent_id'])) {
            $this->db->where('nl.node_parent_id', $filters['node_parent_id']);
        }
        if (isset($filters['node_item_id'])) {
            $this->db->where('nl.node_item_id', $filters['node_item_id']);
        }
        if (!empty($filters['node_system_number'])) {
            $this->db->where('nl.node_system_number', $filters['node_system_number']);
        }
        if (!empty($filters['node_year'])) {
            $this->db->where('nl.node_year', $filters['node_year']);
        }
        if (!empty($filters['node_name'])) {
            $this->db->where('nl.node_name', $filters['node_name']);
        }
        if (!empty($filters['node_class_type'])) {
            $this->db->where('nl.node_class_type', $filters['node_class_type']);
        }
        if (!empty($filters['node_date_added'])) {
            $this->db->where('nl.node_date_added', $filters['node_date_added']);
        }
        if (!empty($filters['node_is_deleted'])) {
            $this->db->where('nl.node_is_deleted', $filters['node_is_deleted']);
        }
        if (!empty($filters['node_is_finished'])) {
            $this->db->where('nl.node_is_finished', $filters['node_is_finished']);
        }
        if (!empty($filters['node_due_date'])) {
            $this->db->where('nl.node_due_date', $filters['node_due_date']);
        }
        if (!empty($filters['node_review_status'])) {
            $this->db->where('nl.node_review_status', $filters['node_review_status']);
        }
        if (!empty($filters['node_properties'])) {
            $this->db->where('nl.node_properties', $filters['node_properties']);
        }

        if ($orders) {
            $this->db->order_by(implode(',', $orders));
        }

        if ($page) {
            $offset = ($page - 1) * $per_page;
            $this->db->limit($per_page, $offset);
        }

        switch ($fetch_as) {
            case Orm::FETCH_OBJECT:
                return Orm_Node_Log::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach ($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Node_Log::to_object($row);
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
    public function insert($params = array())
    {
        $this->db->insert(Orm_Node_Log::get_table_name(), $params);
        return $this->db->insert_id();
    }

    /**
     * update item
     *
     * @param int $id
     * @param array $params
     * @return boolean
     */
    public function update($id, $params = array())
    {
        return $this->db->update(Orm_Node_Log::get_table_name(), $params, array('id' => (int)$id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->db->delete(Orm_Node_Log::get_table_name(), array('id' => (int)$id));
    }

    /**
     * delete item
     * @param int $node_id
     * @return boolean
     */
    public function delete_log($node_id)
    {

        $logs = $this->get_all(array('node_id' => $node_id), 1, 30, array('id DESC'), Orm::FETCH_ARRAY);

        if ($logs) {
            $log_ids = array();
            foreach ($logs as $log) {
                $log_ids[] = (int)$log['id'];
            }

            return $this->db->where_not_in('id', $log_ids)->delete('node_log');
        }

        return false;
    }

    public function get_progress($user_id) {

        $semester = Orm_Semester::get_active_semester();

        $this->db->select('count(*) as number, year(date_added) as log_year, month(date_added) as log_month');
        $this->db->from(Orm_Node_Log::get_table_name() . ' AS nl');
        $this->db->where('nl.node_year', $semester->get_year());
        if ($user_id) {
            $this->db->where('nl.logged_user_id', $user_id);
        }
        $this->db->group_by('year(nl.date_added),month(nl.date_added)');
        $this->db->order_by('2,3');
        $this->db->limit(12);

        $result = $this->db->get()->result_array();

        $months = array();

        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = array('number' => 0, 'log_year' => $semester->get_year(), 'log_month' => $i);
        }

        foreach ($result as $row) {
            $months[$row['log_month']] = $row;
        }

        return $months;
    }
}

