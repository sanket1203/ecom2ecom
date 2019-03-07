<?php

class General extends CI_Model {

    public function __construct() {
        parent::__construct();
        /*
          Argument should be in this format only
          $table='xyz table name';
          $column='xyz column name';
          $where=array('xyzkey'=>'xyzvalue');
          $offset=123 or $limit=123
         */
    }

    public function insert($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function insert_batch($table, $data) {
        /*
          $data = array(
          array(
          'title' => 'My title',
          'name' => 'My Name',
          'date' => 'My date'
          ),
          array(
          'title' => 'Another title',
          'name' => 'Another Name',
          'date' => 'Another date'
          )
          );
         */
        return $this->db->insert_batch($table, $data);
    }

    public function edit($table, $data, $where) {
        return $this->db->update($table, $data, $where);
    }

    public function edit_batch($table, $data, $where) {
        /* $data = array(
          array(
          'token'           => '657871316787544',
          'device'          => 'none',
          'new_token_value' => ''
          ),
          array(
          'token'           => '757984513154644',
          'device'          => 'none',
          'new_token_value' => ''
          )
          );
          Produces:
          UPDATE `tablexyz` SET
          `token` = CASE
          WHEN `token` = '657871316787544' THEN '123'
          WHEN `token` = '757984513154644' THEN '789'
          ELSE token END,
          `device` = CASE
          WHEN `token` = '657871316787544' THEN 'none'
          WHEN `token` = '757984513154644' THEN 'none'
          ELSE device END
          WHERE token IN (657871316787544,757984513154644)
         */
        return $this->db->update_batch($table, $data, $where);
    }

    public function delete($table, $where) {
        return $this->db->delete($table, $where);
    }

    public function getData($table, $column, $where = '', $limit = '', $offset = '') {
        if (!$where) {
            if ($column)
                $this->db->select($column);
            $query = $this->db->get($table, $limit, $offset);
        }
        else {
            if ($column)
                $this->db->select($column);
            $query = $this->db->get_where($table, $where, $limit, $offset);
        }
        return $query->result();
    }
    public function get_where($table,$where)
    {
        $result = $this->db->get_where($table,$where);
        return $result->row_array();
    }

    public function rowCount($table, $where = '') {
        if (!$where) {
            return $this->db->count_all($table);
        } else {
            return $this->db->where($where)->count_all_results($table);
        }
    }

    public function query($query) {
        $query = $this->db->query($query);
        return $query->result();
    }
    
    public function insert_invite($promocode,$email) {
        $data = array(
            'promocode' =>$promocode,
            'friend_email' => $email
        );
        $this->db->insert('friend_invite',$data);
        
        return true;
    }
    
    public function invitedata($promocode) {
        $this->db->select('COUNT(invite_id) as total_accepted_invite');
        $this->db->from('friend_invite');
        $this->db->where('promocode',$promocode);
        $this->db->where('status',1);
        $query = $this->db->get();
        return $query->row_array();
    }     
}