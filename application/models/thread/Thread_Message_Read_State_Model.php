<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thread_Message_Read_State_Model extends CI_Model
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

        $this->db->select('tmrs.*');
        $this->db->distinct();
        $this->db->from(Orm_Thread_Message_Read_State::get_table_name().' AS tmrs');

        if (isset($filters['id'])) {
            $this->db->where('tmrs.id', $filters['id']);
        }
        if (isset($filters['thread_message_id'])) {
            $this->db->where('tmrs.thread_message_id', $filters['thread_message_id']);
        }
        if (isset($filters['user_id'])) {
            $this->db->where('tmrs.user_id', $filters['user_id']);
        }
        if (!empty($filters['read_date'])) {
            $this->db->where('tmrs.read_date', $filters['read_date']);
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
                return Orm_Thread_Message_Read_State::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Thread_Message_Read_State::to_object($row);
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
        $this->db->insert(Orm_Thread_Message_Read_State::get_table_name(), $params);
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
        return $this->db->update(Orm_Thread_Message_Read_State::get_table_name(), $params, array('id' => (int)$id));
    }

    /**
     * delete item
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->db->delete(Orm_Thread_Message_Read_State::get_table_name(), array('id' => (int)$id));
    }

}

