<?php
class Rincian_produk_model extends CI_Model {

	function __construct() {
		// load the parent constructor
		parent::__construct();
	}
	
	function getPromo()
	{
		return $this->db->query("SELECT * FROM PROMOSI WHERE IDHPROMOSI IN (SELECT IDHPROMOSI FROM HPROMOSI WHERE `STATUS`  = 'Y');")->result();
		
	}	
	
	function getHotProduk()
	{
		$this->db->limit(8);
		$this->db->order_by('ID_PRODUK','desc');
		return $this->db->get('produk')->result();
	}
	
	function getBannerPromo()
	{
		return $this->db->query("select * from hpromosi")->result();
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
	
	function searchProdukByMerk($merk,$tipe)
	{
		
		return $this->db->query("select * from produk where id_produk in(select id_produk from rincian_produk where jenis_produk='".$tipe."') and merek_produk='".$merk."'")->result();
		
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
	
	function getStokProduk($id)
	{
		$this->db->select('stok');
		$this->db->where('id_produk',$id);
		$result = $this->db->get('produk')->row();  
		return $result->stok;
	}
	
	function getNamaProdukById($id)
	{
		$this->db->select('nama_produk');
		$this->db->where('id_produk',$id);
		$result = $this->db->get('produk')->row();  
		return $result->nama_produk;
	}
	
	function updateStokProduk($idproduk,$jumlah) 
	{
		$data= array(
		   'STOK'=>$jumlah
		);
		$this->db->where('ID_PRODUK', $idproduk);
		return $this->db->update('PRODUK',$data);
	}
	//hjual djual
	function getHjualId($id)
	{
		$this->db->select("lpad((count(`ID_HJUAL`)+1),4,'0') AS NO");
		$this->db->where('LEFT(`ID_HJUAL`,6)',$id);
		$result = $this->db->get('hjual')->row();  
		return $result->NO;
	}
	function getSJId()
	{
		$this->db->select("lpad((count(`NO_SURATJALAN`)+1),10,'0') AS NO");
		$result = $this->db->get('hjual')->row();  
		return $result->NO;
	}
	
	function insertHjual($id,$total,$surat,$status) 
	{		
		$data= array(
		   'ID_HJUAL' => $id,
		   'TOTAL'=>$total,
		   'NO_SURATJALAN'=>$surat,
		   'STATUS'=>$status
		);
		return $this->db->insert('hjual',$data);
	}
	function getDjualId($id)
	{
		$this->db->select("lpad((count(`IDDJUAL`)+1),4,'0') AS NO");
		$this->db->where('LEFT(`IDDJUAL`,6)',$id);
		$result = $this->db->get('djual')->row();  
		return $result->NO;
	}
	
	function insertDjual($id,$idhjual,$idproduk,$nama,$harga,$jumlah,$total) 
	{		
		$data= array(
			'IDDJUAL' => $id,
			'ID_HJUAL' => $idhjual,
			'ID_PRODUK' => $idproduk,
			'NAMA_PRODUK' => $nama,
			'HARGA_PRODUK' => $harga,
			'JUMLAH_PRODUK' => $jumlah,
			'TOTAL'=>$total
		);
		return $this->db->insert('djual',$data);
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
	function clearCart($idcust) 
	{
		$this->db->delete('shoppingcart', array('ID_CUSTOMER' => $idcust));
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
	function cekLoginStaff($user,$pass) 
	{
		$this->db->where('ID_PEGAWAI',$user);
		$this->db->where('PASSWORD',$pass);
		$hasil= $this->db->get('PEGAWAI')->result();
		
		$count = count($hasil);
		return $count;
	}
	function cekEmail($user) 
	{
		$this->db->where('ID_CUSTOMER',$user);
		$hasil= $this->db->get('CUSTOMER')->result();
		
		$count = count($hasil);
		return $count;
	}
	
	function insertCustomer($id,$nama,$pass,$alamat,$jk,$tgl,$kota,$negara,$kode,$telp) 
	{		
		$data= array(
		   'ID_CUSTOMER' => $id,
		   'NAMA_CUSTOMER'=>$nama,
		   'PASSWORD'=>$pass,
		   'ALAMAT_CUSTOMER'=>$alamat,
		   'GENDER'=>$jk,
		   'TANGGAL_LAHIR'=>$tgl,
		   'KOTA'=>$kota,
		   'NEGARA'=>$negara,
		   'KODE_POSTAL'=>$kode,
		   'TELEPHON'=>$telp
		);
		return $this->db->insert('customer',$data);
	}
}
?> ;
