<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Motor_M extends CI_Model {

    protected $table = 'motor';

    public function get($id = null){
        $this->db->select('*');
        $this->db->from($this->table);
        if($id != null){
            $this->db->where('id', $id);
        }
        $this->db->where('is_deleted', 0);
        $query = $this->db->get();
        return $query;
    }

    public function add($data){
        $this->db->insert($this->table, $data);
    }

    public function update($data, $id){
        
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->update($this->table, ['is_deleted' => 1]);
    }
}
