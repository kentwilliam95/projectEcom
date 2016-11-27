<?php
class GambarModel extends CI_Model {

	function __construct() {
		// load the parent constructor
		parent::__construct();
	}
	
	
	function selectById($id)
	{
		$this->db->where('ID_PRODUK',$id);
		$hasil= $this->db->get('gambar')->result();
		
		if(count($hasil)<3)
		{	
			$num = count($hasil);
			for($i=0;$i<3-$num;$i++)
			{
				$obj = (object) array('NAMA_GAMBAR' => '404', 'EXTENSI' => '.jpg');
				array_push($hasil,$obj);
			}
		}
		return $hasil;
	}
	
	function selectFilteredProduct($arr)
	{
		$hasil = array();
		foreach($arr as $a)
		{
			$this->db->where('ID_PRODUK',$a->ID_PRODUK);
			$this->db->limit(1);
			$temp = $this->db->get('gambar')->row();
			if(count($temp)==0)
			{
				$obj = (object) array('NAMA_GAMBAR' => '404', 'EXTENSI' => '.jpg');
				array_push($hasil,$obj);
			}
			else
			{
				array_push($hasil,$temp);
			}
		}
		
		return $hasil;
	}
	
	
}
?> 