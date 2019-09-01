<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_Settings_Model extends CI_Model
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
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS) {

        $this->db->select('ns.*');
        $this->db->distinct();
        $this->db->from(Orm_Notification_Settings::get_table_name().' AS ns');

        $this->get_filters($filters);

        if ($orders) {
            $this->db->order_by(implode(',', $orders));
        }

        if ($page) {
            $offset = ($page - 1) * $per_page;
            $this->db->limit($per_page, $offset);
        }

        switch($fetch_as) {
            case Orm::FETCH_OBJECT:
                return Orm_Notification_Settings::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Notification_Settings::to_object($row);
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

    public function get_filters($filters = []){
        if (isset($filters['id'])) {
            $this->db->where('ns.id', $filters['id']);
        }
        if (isset($filters['user_id'])) {
            $this->db->where('ns.user_id', $filters['user_id']);
        }
        if (!empty($filters['notification_name'])) {
            $this->db->where('ns.notification_name', $filters['notification_name']);
        }
        if (!empty($filters['allow_email'])) {
            $this->db->where('ns.allow_email', $filters['allow_email']);
        }
        if (!empty($filters['allow_sms'])) {
            $this->db->where('ns.allow_sms', $filters['allow_sms']);
        }
    }

    /**
     * insert new row to the table
     * @param array $params
     * @return int
     */
    public function insert($params = array())
    {
        $this->db->insert(Orm_Notification_Settings::get_table_name(), $params);
        return $this->db->insert_id();
    }

    /**
     * update item
     * @param int $id
     * @param array $params
     * @return boolean
     */
    public function update($id, $params = array())
    {
        return $this->db->update(Orm_Notification_Settings::get_table_name(), $params, array('id' => (int)$id));
    }

    /**
     * delete item
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->db->delete(Orm_Notification_Settings::get_table_name(), array('id' => (int)$id));
    }

    public function get_by_notification_name($notification_name) {

        $this->db->select('ns.*');
        $this->db->distinct();
        $this->db->from(Orm_Notification_Settings::get_table_name().' AS ns');
        $this->db->where('ns.notification_name', $notification_name);

        $objects = array();
        foreach($this->db->get()->result_array() as $row) { /** @var $row Orm_Notification_Settings */
            $objects[$row->get_user_id()] = Orm_Notification_Settings::to_object($row);
        }

        return $objects;
    }
}

