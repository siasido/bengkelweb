<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class JasaMontir_M extends CI_Model {

    protected $table = 'montirorders';
    


    public function add($data){
        $this->db->insert($this->table, $data);
    }

    public function update($data, $id){
        
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    public function delete($id){
        $this->db->where('userid', $id);
        $this->db->delete($this->table);
    }

    public function get($id = null){
        $this->db->select('a.id as orderid, e.namamontir, a.statusbayar, a.notes, a.userid, b.nohp, b.fullname as nama, a.alamatlengkap, idmerk, merk, type, kendala, resi, idrekening, namabank, norek, namaakun, orderdate, status');
        $this->db->from('montirorders a');
        $this->db->join('users b', 'a.userid = b.userid');
        $this->db->join('motor c', 'a.idmerk = c.id');
        $this->db->join('rekening d', 'a.idrekening = d.id');
        $this->db->join('montir e', 'a.idmontir = e.idmontir', 'left');
        if($id != null){
            $this->db->where('a.id', $id);
        }
        $this->db->order_by('a.orderdate', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function getByUserId($id = null){
        $this->db->select('a.id as orderid, a.userid, a.statusbayar, a.notes, e.namamontir, b.nohp, b.fullname as nama, a.alamatlengkap, idmerk, merk, type, kendala, resi, idrekening, namabank, norek, namaakun, orderdate, status');
        $this->db->from('montirorders a');
        $this->db->join('users b', 'a.userid = b.userid');
        $this->db->join('motor c', 'a.idmerk = c.id');
        $this->db->join('rekening d', 'a.idrekening = d.id');
        $this->db->join('montir e', 'a.idmontir = e.idmontir', 'left');
        if($id != null){
            $this->db->where('a.userid', $id);
        }
        $this->db->order_by('a.orderdate', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function orderdate_check($orderdate){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('orderdate =', $orderdate);
        $query = $this->db->get();
        return $query;
    }

    public function getByMonth($month){
        $this->db->select('a.id as orderid, e.namamontir, a.statusbayar, a.notes, a.userid, b.nohp, b.fullname as nama, a.alamatlengkap, idmerk, merk, type, kendala, resi, idrekening, namabank, norek, namaakun, orderdate, status');
        $this->db->from('montirorders a');
        $this->db->join('users b', 'a.userid = b.userid');
        $this->db->join('motor c', 'a.idmerk = c.id');
        $this->db->join('rekening d', 'a.idrekening = d.id');
        $this->db->join('montir e', 'a.idmontir = e.idmontir', 'left');
        $this->db->where('month(a.orderdate)', $month);
        $query = $this->db->get();
        return $query;
    }
    
}
