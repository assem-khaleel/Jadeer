<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thread_Model extends CI_Model
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

        $user_id = Orm_User::get_logged_user()->get_id();

        $this->db->select('t.*,tm.sent_date');
        $this->db->distinct();
        $this->db->from(Orm_Thread::get_table_name().' AS t');

        $this->db->join(Orm_Thread_Message::get_table_name().' AS tm', 'tm.id = t.last_message_id', 'INNER');
        $this->db->join(Orm_Thread_Participant::get_table_name().' AS tp', "tp.thread_id = t.id AND tp.user_id = {$user_id}", 'INNER');

        if (isset($filters['id'])) {
            $this->db->where('t.id', $filters['id']);
        }
        if (!empty($filters['last_message_id'])) {
            $this->db->where('t.last_message_id', $filters['last_message_id']);
        }
        if (isset($filters['is_read'])) {
            $this->db->join(Orm_Thread_Message_Read_State::get_table_name().' AS tmrs', "tmrs.thread_message_id = tm.id AND tmrs.user_id = {$user_id}", 'LEFT');
            if ($filters['is_read']) {
                $this->db->where('tmrs.user_id IS NOT NULL', null, false);
            } else {
                $this->db->where('tmrs.user_id IS NULL', null, false);
            }
        }
        if (!empty($filters['type'])) {
            switch ($filters['type']) {
                case Orm_Thread::LIST_TYPE_SENT:
                    $this->db->where('tm.sender_id', $user_id);
                    $this->db->where('tp.is_deleted', 0);
                    break;

                case Orm_Thread::LIST_TYPE_IMPORTANT:
                    $this->db->where('tp.is_important', 1);
                    $this->db->where('tp.is_deleted', 0);
                    break;

                case Orm_Thread::LIST_TYPE_TRASH:
                    $this->db->where('tp.is_deleted', 1);
                    break;

                default:
                    $this->db->where('tp.is_deleted', 0);
                    $this->db->where('t.id in', "(SELECT tm.thread_id FROM ". Orm_Thread_Message::get_table_name(). " AS tm INNER JOIN ".Orm_Thread_Participant::get_table_name()." AS tp ON tp.thread_id = tm.thread_id AND tp.user_id = {$user_id} WHERE tm.sender_id != {$user_id})", false);
                    break;
            }
        }

        if (!empty($filters['keyword'])) {
            $this->db->group_start();
            $this->db->like('tm.subject', $filters['keyword']);
            $this->db->or_like('tm.body', $filters['keyword']);
            $this->db->group_end();
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
                return Orm_Thread::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Thread::to_object($row);
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
        $this->db->insert(Orm_Thread::get_table_name(), $params);
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
        return $this->db->update(Orm_Thread::get_table_name(), $params, array('id' => (int)$id));
    }

    /**
     * delete item
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->db->delete(Orm_Thread::get_table_name(), array('id' => (int)$id));
    }

}

