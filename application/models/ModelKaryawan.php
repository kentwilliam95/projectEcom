<?php
class ModelKaryawan extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
	
	function getData($tablename)
    {
        return $this->db->get($tablename)->result();
    }
	
	function Autogen($data)
    {
        $query = $data;
        return $this->db->query($query)->result();
    }
	
	function Insert($table,$data)
    {
        $this->db->insert($table,$data);
    }
	
	function getDataWhere($tablename,$kondisi)
    {
        $this->db->select("*");
        $this->db->from($tablename);
        $this->db->where($kondisi);
        return $this->db->get()->result();
    }
	
	function UpdateData($tablename,$data,$kondisi)
    {
        $this->db->where($kondisi);
        $this->db->update($tablename,$data);
    }
	
	function deleteData($tablename,$kondisi)
    {
        $this->db->delete($tablename,$kondisi);
    }
}
?>