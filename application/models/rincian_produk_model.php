<?php
class Rincian_produk_model extends CI_Model {

	function __construct() {
		// load the parent constructor
		parent::__construct();
	}
	
	function getPromo()
	{
		return $this->db->query("SELECT * FROM PROMOSI WHERE IDHPROMOSI IN (SELECT IDHPROMOSI FROM HPROMOSI WHERE `TGL_AKHIR_PROMOSI` < CURDATE());")->result();
		
	}	
	
	function getPromoById($id)
	{
		return $this->db->query("SELECT * FROM PROMOSI WHERE IDHPROMOSI IN (SELECT IDHPROMOSI FROM HPROMOSI WHERE `TGL_AKHIR_PROMOSI` < CURDATE()) and IDHPROMOSI ='".$id."'" )->result();
		
		
	}
	
	function getProdukByPromo($promo)
	{
		$hasil = array();
		foreach($promo as $p)
		{
			$this->db->where('ID_PRODUK',$p->ID_PRODUK);
			$obj = $this->db->get('produk')->row();
			//$temp = (object) array('')
			array_push($hasil,$obj);
		}
		return $hasil;
		
	}
	
	function getKategoriProduk($id)
	{
		$this->db->where('ID_PRODUK',$id);
		$this->db->select('KATEGORI_PRODUK');
		return $this->db->get('rincian_produk')->row();
	}
	
	function getKategori()
	{
		$this->db->distinct();
		
		$this->db->select('kategori_produk');
		return $this->db->get('rincian_produk')->result();
	}
	
	function getTotalItem($arr)
	{
		$hasil = array();
		foreach($arr as $a)
		{
			$this->db->where('kategori_produk',$a->kategori_produk);
			$this->db->select('count(kategori_produk) as total');
			$obj = (object) array('kategori_produk' => $a->kategori_produk, 'total' => $this->db->get('rincian_produk')->row()->total);
			array_push($hasil,$obj);
		}
		return $hasil;
	}
	
	function getSubKategori()
	{
		$this->db->distinct();
		$this->db->select('jenis_produk,kategori_produk');
		return $this->db->get('rincian_produk')->result();
	}
	
	function selectOther($id)
	{
		$this->db->where('ID_PRODUK',$id);
		$this->db->select('KATEGORI_PRODUK');
		$hasil= $this->db->get('rincian_produk')->row()->KATEGORI_PRODUK;
				
		$this->db->limit(3);
		$this->db->where('kategori_produk',$hasil);
		$this->db->where_not_in('ID_PRODUK',$id);
		$kategori = $this->db->get('rincian_produk')->result();
		$result=array();
		foreach($kategori as $k)
		{
			$this->db->where('ID_PRODUK',$k->ID_PRODUK);
			$h = $this->db->get('produk')->row();
			array_push($result,$h);
		}
		
		return $result;
	}
	
	function selectOtherImage($arr)
	{
		$result=array();
		foreach($arr as $a)
		{
			$this->db->where('ID_PRODUK',$a->ID_PRODUK);
			$this->db->limit(1);
			$h = $this->db->get('gambar')->num_rows();
			if($h==0)
			{
				$h=array();
				$h['NAMA_GAMBAR']='404';
				$h['EXTENSI'] ='.jpg';
			}
			else
			{
				$this->db->where('ID_PRODUK',$a->ID_PRODUK);
				$this->db->limit(1);
				$temp = $this->db->get('gambar')->result();
				$h=array();
				$h['NAMA_GAMBAR']=$temp[0]->NAMA_GAMBAR;
				$h['EXTENSI'] =$temp[0]->EXTENSI;
			}
			array_push($result,$h);
		}
		return $result;
	}
	
	function getProduk()
	{
		$this->db->distinct();
		return $this->db->query("select  distinct p.merek_produk, r.jenis_produk,r.kategori_produk
		from rincian_produk r 
		left join produk p
		on r.id_produk=p.id_produk
		order by kategori_produk,jenis_produk")->result();
		
	}
	
	function searchProdukByMerk($merk)
	{
		$this->db->where('merek_produk',$merk);
		return $this->db->get('produk')->result();
	}
	
	
	function searchProdukByNama($nama)
	{
		$this->db->like('nama_produk',$nama);
		$this->db->or_like('merek_produk',$nama);
		return $this->db->get('produk')->result();
	}
	
	function selectByKategori($kat)
	{
		$this->db->order_by('waktu','desc');
		$this->db->where('Kode_Kategori',$kat);
		
		return $this->db->get('berita')->result();
	}
	
	function selectById($id)
	{
		$this->db->where('ID_PRODUK',$id);
		return $this->db->get('produk')->row();
	}
	
	function select() 
	{
		return $this->db->get('berita')->result();
	}
	
	function getProdukById($id)
	{
		return $this->db->query("select p.*, s.*
		from shoppingcart s, produk p
		where s.id_produk = p.id_produk AND s.id_customer ='".$id."'")->result();
	}
	
	function getProdukId($nama)
	{
		$this->db->select('id_produk');
		$this->db->where('nama_produk',$nama);
		return $this->db->get('produk')->result();
	}
	
		//cart
	
	function insertCart($id,$idproduk,$idcust,$jumlah) 
	{		
		$data= array(
		   'ID' => $id,
		   'ID_PRODUK' => $idproduk,
		   'ID_CUSTOMER'=>$idcust,
		   'JUMLAH'=>$jumlah
		);
		return $this->db->insert('shoppingcart',$data);
	}
	
	function updateCart($idproduk,$idcust,$jumlah) 
	{
		$data= array(
		   'JUMLAH'=>$jumlah
		);
		$this->db->where('ID_PRODUK', $idproduk);
		$this->db->where('ID_CUSTOMER', $idcust);
		return $this->db->update('shoppingcart',$data);
	}
	function deleteCart($idproduk,$idcust) 
	{
		$this->db->delete('shoppingcart', array('ID_CUSTOMER' => $idcust, 'ID_PRODUK'=>$idproduk));
	}
	function getIsiCart($idcust)
	{
		$this->db->where('id_customer',$idcust);
		return $this->db->get('shoppingcart')->result();
	}
	
	function getProdukJumlahCart($idproduk,$idcust)
	{
		$this->db->select_max('jumlah');
		$this->db->where('id_produk',$idproduk);
		$this->db->where('id_customer',$idcust);
		$result = $this->db->get('shoppingcart')->row();  
		return $result->jumlah;
	}
	function getTotalJumlahCart($idcust)
	{
		$this->db->select_sum('jumlah');
		$this->db->where('id_customer',$idcust);
		$result = $this->db->get('shoppingcart')->row();  
		return $result->jumlah;
	}
	
	//wish
	
	
	function insertWish($idproduk,$idcust,$idwish,$sessionid) 
	{		
		$data= array(
		   'ID_PRODUK' => $idproduk,
		   'ID_CUSTOMER'=>$idcust,
		   'ID_WISHLIST'=>$idwish,
		   'SESSIONID'=>$sessionid
		);
		return $this->db->insert('wishlist',$data);
	}
	
	function updatewish($idcust,$sessionid) 
	{
		$data= array(
		   'ID_CUSTOMER'=>$idcust
		);
		$this->db->where('SESSIONID', $sessionid);
		return $this->db->update('wishlist',$data);
	}
	
	
	function deleteWish($idwish,$idcust) 
	{
		$this->db->delete('wishlist', array('ID_CUSTOMER' => $idcust, 'ID_WISHLIST'=>$idwish));
	}
	function cekwish($idpro,$idcust) 
	{
		$this->db->where('ID_CUSTOMER',$idcust);
		$this->db->where('ID_PRODUK',$idpro);
		$hasil= $this->db->get('WISHLIST')->result();
		
		$count = count($hasil);
		return $count;
	}
	
	function getWishlistById($id)
	{
		return $this->db->query("select p.*, w.*
		from wishlist w, produk p
		where p.id_produk = w.id_produk and w.id_customer ='".$id."'")->result();
	}
	function getWishlistBySession($id)
	{
		return $this->db->query("select p.*, w.*
		from wishlist w, produk p
		where p.id_produk = w.id_produk and w.sessionid ='".$id."'")->result();
	}
	
	function cekLogin($user,$pass) 
	{
		$this->db->where('ID_CUSTOMER',$user);
		$this->db->where('PASSWORD',$pass);
		$hasil= $this->db->get('CUSTOMER')->result();
		
		$count = count($hasil);
		return $count;
	}
	
	
}
?> ;