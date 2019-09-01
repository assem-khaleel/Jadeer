<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_Model extends CI_Model
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

        $this->db->select('n.*');
        $this->db->distinct();
        $this->db->from(Orm_Notification::get_table_name().' AS n');

        if (isset($filters['id'])) {
            $this->db->where('n.id', $filters['id']);
        }
        if (isset($filters['sender_id'])) {
            $this->db->where('n.sender_id', $filters['sender_id']);
        }
        if (isset($filters['receiver_id'])) {
            $this->db->where('n.receiver_id', $filters['receiver_id']);
        }
        if (!empty($filters['subject'])) {
            $this->db->where('n.subject', $filters['subject']);
        }
        if (!empty($filters['body'])) {
            $this->db->where('n.body', $filters['body']);
        }
        if (isset($filters['is_read'])) {
            $this->db->where('n.is_read', $filters['is_read']);
        }
        if (!empty($filters['date_added'])) {
            $this->db->where('n.date_added', $filters['date_added']);
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
                return Orm_Notification::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Notification::to_object($row);
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
     * @param array $params
     * @return int
     */
    public function insert($params = array())
    {
        $this->db->insert(Orm_Notification::get_table_name(), $params);
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
        return $this->db->update(Orm_Notification::get_table_name(), $params, array('id' => (int)$id));
    }

    /**
     * delete item
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->db->delete(Orm_Notification::get_table_name(), array('id' => (int)$id));
    }

}
