<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mm_Meeting_Model extends CI_Model {
    
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

        $this->db->select('mm.*');
        $this->db->distinct();
        $this->db->from(Orm_Mm_Meeting::get_table_name() . ' AS mm');

        if (isset($filters['id'])) {
            $this->db->where('mm.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('mm.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('mm.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('mm.id', $filters['not_in_id']);
        }
        if (isset($filters['level'])) {
            $this->db->where('mm.level', $filters['level']);
        }
        if (isset($filters['level_id'])) {
            $this->db->where('mm.level_id', $filters['level_id']);
        }

        if (isset($filters['structure'])) {
            $this->db->group_start();
            if (isset($filters['structure']['college_level'])){
                $this->db->group_start();
                $this->db->where('mm.level',$filters['structure']['college_level']);
                $this->db->where('mm.level_id',$filters['structure']['college_id']);
                $this->db->group_end();
            }

            if (isset($filters['structure']['program_level'])) {

                $this->db->or_group_start();
                $this->db->where('mm.level',$filters['structure']['program_level']);
                $this->db->where_in('mm.level_id',$filters['structure']['program_id']);
                $this->db->group_end();
            }
            if (isset($filters['structure']['unit_level']) && isset($filters['structure']['unit_id'])) {
                $this->db->or_group_start();
                $this->db->where('mm.level',$filters['structure']['unit_level']);
                $this->db->where('mm.level_id',$filters['structure']['unit_id']);
                $this->db->where('mm.facilitator_id', Orm_User::get_logged_user_id());
                $this->db->group_end();
            }
            if (isset($filters['structure']['id_in'])) {
                $this->db->or_where_in('mm.id', $filters['structure']['id_in']);
            }
            $this->db->group_end();
        }
        if (isset($filters['room_id'])) {
            $this->db->where('mm.room_id', $filters['room_id']);
        }
        if (!empty($filters['type_class'])) {
            $this->db->where('mm.type_class', $filters['type_class']);
        }
        if (!empty($filters['not_type_class'])) {
            $this->db->where_not_in('mm.type_class', $filters['not_type_class']);
        }
        if (isset($filters['type_id'])) {
            $this->db->where('mm.type_id', $filters['type_id']);
        }
        if (isset($filters['facilitator_id'])) {
            $this->db->where('mm.facilitator_id', $filters['facilitator_id']);
        }
        if (!empty($filters['name'])) {
            $this->db->where('mm.name', $filters['name']);
        }
        if (!empty($filters['name_like'])) {
            $this->db->like('mm.name', $filters['name_like']);
        }
        if (!isset($filters['time_between'])) {
            if (isset($filters['start_date'])) {
                $this->db->where('mm.start_date', $filters['start_date']);
            }
            if (isset($filters['end_date'])) {
                $this->db->where('mm.end_date', $filters['end_date']);
            }
        }
        if (isset($filters['time_between'])) {
            if (isset($filters['end_date']) && isset($filters['start_date'])) {
                $this->db->group_start();
                $this->db->where(" '{$filters['start_date']}' BETWEEN `mm`.`start_date` AND  `mm`.`end_date`",null,true);
                $this->db->or_where(" '{$filters['end_date']}' BETWEEN `mm`.`start_date` AND  `mm`.`end_date`",null,true);
                $this->db->group_end();
            }

        }

        if (!empty($filters['objective'])) {
            $this->db->where('mm.objective', $filters['objective']);
        }
        if (!empty($filters['agenda_attachment'])) {
            $this->db->where('mm.agenda_attachment', $filters['agenda_attachment']);
        }
        if (!empty($filters['meeting_minutes'])) {
            $this->db->where('mm.meeting_minutes', $filters['meeting_minutes']);
        }
        if (!empty($filters['meeting_minutes_attachment'])) {
            $this->db->where('mm.meeting_minutes_attachment', $filters['meeting_minutes_attachment']);
        }
        if (!empty($filters['action_attachment'])) {
            $this->db->where('mm.action_attachment', $filters['action_attachment']);
        }
        if (isset($filters['meeting_ref_id'])) {
            $this->db->where('mm.meeting_ref_id', $filters['meeting_ref_id']);
        }
        if (isset($filters['user_id']) && empty($filters['structure']['unit_id'])) {
            $this->db->or_where('mm.facilitator_id', $filters['user_id']);
        }
        if (!empty($filters['keyword'])) {
            $this->db->group_start();
            $this->db->like('mm.name', $filters['keyword']);
            $this->db->group_end();
        }
        
        if ($orders) {
            $this->db->order_by(implode(',', $orders));
        }
        $this->db->order_by('id', 'desc');
        if ($page) {
            $offset = ($page - 1) * $per_page;
            $this->db->limit($per_page, $offset);
        }
        
        switch($fetch_as) {
            case Orm::FETCH_OBJECT:
            $row = $this->db->get()->row_array();
                return Orm_Mm_Meeting::to_object($row, ($row['type_class']?: ''));
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Mm_Meeting::to_object($row, $row['type_class']);
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
        $this->db->insert(Orm_Mm_Meeting::get_table_name(), $params);
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
        return $this->db->update(Orm_Mm_Meeting::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Mm_Meeting::get_table_name(), array('id' => $id)) &&
         $this->db->delete(Orm_Mm_Action::get_table_name(), array('meeting_id' => $id)) &&
         $this->db->delete(Orm_Mm_Agenda::get_table_name(), array('meeting_id' => $id)) &&
         $this->db->delete(Orm_Mm_Attendance::get_table_name(), array('meeting_id' => $id));
    }

}

