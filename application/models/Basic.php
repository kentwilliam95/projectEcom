<?php
class Basic extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
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
    function getData($tablename)
    {
        return $this->db->get($tablename)->result();
    }
      function getData_array($tablename)
    {
        return $this->db->get($tablename)->result_array();
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
    function getDataWhere($tablename,$kondisi)
    {
        $this->db->select("*");
        $this->db->from($tablename);
        $this->db->where($kondisi);
        return $this->db->get()->result();
    }
    function getDataWhere_array($tablename,$kondisi)
    {
        $this->db->select("*");
        $this->db->from($tablename);
        $this->db->where($kondisi);
        return $this->db->get()->result_array();
    }
}
?>