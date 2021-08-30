<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class JasaService_M extends CI_Model {

    protected $table = 'serviceorders';
    


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
        $this->db->select('a.id as orderid, a.statusbayar,  a.userid, b.nohp, b.fullname as nama, idmerk, merk, type, kendala, resi, idrekening, namabank, norek, namaakun, orderdate, status');
        $this->db->from('serviceorders a');
        $this->db->join('users b', 'a.userid = b.userid');
        $this->db->join('motor c', 'a.idmerk = c.id');
        $this->db->join('rekening d', 'a.idrekening = d.id');
        if($id != null){
            $this->db->where('a.id', $id);
        }
        $this->db->order_by('a.orderdate', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function getByUserId($id = null){
        $this->db->select('a.id as orderid, a.statusbayar,  a.userid, b.nohp, b.fullname as nama, idmerk, merk, type, kendala, resi, idrekening, namabank, norek, namaakun, orderdate, status');
        $this->db->from('serviceorders a');
        $this->db->join('users b', 'a.userid = b.userid');
        $this->db->join('motor c', 'a.idmerk = c.id');
        $this->db->join('rekening d', 'a.idrekening = d.id');
        if($id != null){
            $this->db->where('a.userid', $id);
        }
        $this->db->order_by('a.orderdate', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function getByMonth($month){
        $this->db->select('a.id as orderid, a.statusbayar,  a.userid, b.nohp, b.fullname as nama, idmerk, merk, type, kendala, resi, idrekening, namabank, norek, namaakun, orderdate, status');
        $this->db->from('serviceorders a');
        $this->db->join('users b', 'a.userid = b.userid');
        $this->db->join('motor c', 'a.idmerk = c.id');
        $this->db->join('rekening d', 'a.idrekening = d.id');
        $this->db->where('month(a.orderdate)', $month);
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

    public function getBookedHours($param){
        $query = "SELECT id as orderid, DATE_FORMAT(orderdate, '%H:%i') jam from serviceorders where orderdate like '$param%' and statusbayar = 2";
        return $this->db->query($query)->result();
    }

    public function getOrdersCount($param){
        $this->db->select('*');
        $this->db->from('serviceorders');
        $this->db->where('userid', $param);
        return $this->db->count_all_results(); 
    }

    public function getFinishedOrdersCount($param = null){
        $this->db->select('*');
        $this->db->from('serviceorders');
        if ($param){
            $this->db->where('userid', $param);
        }
        $this->db->where('status', 2);
        return $this->db->count_all_results(); 
    }

    public function getOngoingOrdersCount($param = null){
        $this->db->select('*');
        $this->db->from('serviceorders');
        if ($param){
            $this->db->where('userid', $param);
        }
        $this->db->where('status <', 2);
        return $this->db->count_all_results(); 
    }
    
}
