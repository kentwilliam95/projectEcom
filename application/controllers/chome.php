<?php



defined('BASEPATH') OR exit('No direct script access allowed');

class Chome extends CI_Controller {

	
	public function index()
	{
		$data['log'] = $this->ceklog();
		$data['barang']=$this->rincian_produk_model->getProduk();
		$data['kategori'] = $this->rincian_produk_model->getKategori();
		$data['subkategori'] = $this->rincian_produk_model->getSubKategori();
		if($data['log'])
		{
			$data['isicart'] = $this->rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
		}
		else
		{
			$data['isicart']=0;
		}
		
		$this->load->view('Customer/index.php',$data);
	}
	
	public function getId()
	{
		$id=$this->input->post('id');
		
		$this->session->set_userdata('filterSearch',$id);
	}
	
	public function searchProdukByMerk()
	{
		//Variabel milik daniel
		$data['isicart'] = $this->rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
		$data['log'] = $this->ceklog();
		
		//Variabel milik Der Fuhrer
		$data['hasil']=$this->rincian_produk_model->searchProdukByMerk($this->session->userdata('filterSearch'));
		$data['merek']=$this->session->userdata('filterSearch');
		$data['barang']=$this->rincian_produk_model->getProduk();
		$data['kategori'] = $this->rincian_produk_model->getKategori();
		$data['subkategori'] = $this->rincian_produk_model->getSubKategori();
		$data['gambar']=$this->GambarModel->selectFilteredProduct($data['hasil']);
		
		if($data['log'] == true){
		}
		else
		{
			$data['isicart'] = 0;
		}
		$this->load->view('Customer/searchFilter.php',$data);
	}
	
	public function searchProdukByNama()
	{
		$data['log'] = $this->ceklog();
		$data['isicart'] = $this->rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
	
		$data['hasil']=$this->rincian_produk_model->searchProdukByNama($this->session->userdata('filterSearch'));
		$temp = $this->session->userdata('filterSearch');
		$data['merek']="Hasil Penelusuran untuk '".$temp ."'";
		$data['barang']=$this->rincian_produk_model->getProduk();
		$data['kategori'] = $this->rincian_produk_model->getKategori();
		$data['subkategori'] = $this->rincian_produk_model->getSubKategori();
		$data['gambar']=$this->GambarModel->selectFilteredProduct($data['hasil']);
		
		if($data['log'] == true){
		}
		else
		{
			$data['isicart'] = 0;
		}
		
		$this->load->view('Customer/searchFilter.php',$data);
	}
	
	public function getIdToDetail()
	{
		$id=$this->input->post('id');
		
		$this->session->set_userdata('idBarang',$id);
	}
	
	public function showProductDetail()
	{
		$data['isicart'] = $this->rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
		$data['log'] = $this->ceklog();
	
		
		$data['hasil']=$this->rincian_produk_model->selectById($this->session->userdata('idBarang'));		
		$data['barang']=$this->rincian_produk_model->getProduk();
		$data['gambar']=$this->GambarModel->selectById($this->session->userdata('idBarang'));		
		
		$data['other']=$this->rincian_produk_model->selectOther($this->session->userdata('idBarang'));
		$data['gambarOther']=$this->rincian_produk_model->selectOtherImage($data['other']);
		
		$data['kategoriBarang']=$this->rincian_produk_model->getKategoriProduk($this->session->userdata('idBarang'))->KATEGORI_PRODUK;
		$temp = $this->rincian_produk_model->getKategori();
		$data['kategori'] = $this->rincian_produk_model->getTotalItem($temp);
		$data['subkategori'] = $this->rincian_produk_model->getSubKategori();
		
		if($data['log'] == true){
		}
		else
		{
			$data['isicart'] = 0;
		}
		
		$this->load->view('Customer/detail.php',$data);
		
	}
	
	public function addwish()
	{
		$data['idproduk'] = $this->input->post('id_produk');
		$data['idwish'] = $this->generateRandomString();
		
		if($this->session->userdata('sessionid')==null)
		{
			$this->session->set_userdata('sessionid',$this->generateRandomString());
		}
		
		$data['log'] = $this->ceklog();
		$data['cekwish'] = $this->rincian_produk_model->cekwish($data['idproduk'],$this->session->userdata('ID_CUSTOMER'));
		$data['hasil']=$this->rincian_produk_model->searchProdukByNama($this->session->userdata('filterSearch'));
		$temp = $this->session->userdata('filterSearch');
		$data['merek']="Hasil Penelusuran untuk '".$temp ."'";
		$data['barang']=$this->rincian_produk_model->getProduk();
		$data['kategori'] = $this->rincian_produk_model->getKategori();
		$data['subkategori'] = $this->rincian_produk_model->getSubKategori();
		$data['isicart'] = $this->rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
		
		if(isset($_POST["add"]))
		{
			if($data['cekwish']==0)
			{
				$this->rincian_produk_model->insertWish($data['idproduk'],$this->session->userdata('ID_CUSTOMER'),$data['idwish'],$this->session->userdata('sessionid'));	
			}
		}
		if($data['log'] == true){
			
			$this->load->view('Customer/searchFilter.php',$data);
		}
		else
		{
			$this->load->view('Customer/index.php',$data);
		}
	}
	public function towish()
	{
		$data['wishlist']="";
		$data['log'] = $this->ceklog();
		$data['hasil']=$this->rincian_produk_model->searchProdukByNama($this->session->userdata('filterSearch'));
		$temp = $this->session->userdata('filterSearch');
		$data['merek']="Hasil Penelusuran untuk '".$temp ."'";
		$data['barang']=$this->rincian_produk_model->getProduk();
		$data['kategori'] = $this->rincian_produk_model->getKategori();
		$data['subkategori'] = $this->rincian_produk_model->getSubKategori();
		if($data['log'] == true){
			$data['wishlist']= $this->rincian_produk_model->getWishlistById($this->session->userdata('ID_CUSTOMER'));
		
			$data['isicart'] = $this->rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
		}
		else
		{
			$data['wishlist']= $this->rincian_produk_model->getWishlistBySession($this->session->userdata('sessionid'));
			$data['isicart'] = 0;
		}
		$data['gambar']=$this->GambarModel->selectFilteredProduct($data['wishlist']);
		$this->load->view('Customer/customer-wishlist.html',$data);
		
	}public function deletewish()
	{
		$data['wishlist']="";
		$data['log'] = $this->ceklog();
		$data['hasil']=$this->rincian_produk_model->searchProdukByNama($this->session->userdata('filterSearch'));
		$temp = $this->session->userdata('filterSearch');
		$data['merek']="Hasil Penelusuran untuk '".$temp ."'";
		$data['barang']=$this->rincian_produk_model->getProduk();
		$data['kategori'] = $this->rincian_produk_model->getKategori();
		$data['subkategori'] = $this->rincian_produk_model->getSubKategori();
		
		if($data['log'] == true){
			$this->rincian_produk_model->deleteWish($this->input->post('idwish'),$this->session->userdata('ID_CUSTOMER'));
			$data['wishlist']= $this->rincian_produk_model->getWishlistById($this->session->userdata('ID_CUSTOMER'));
		
			$data['isicart'] = $this->rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
		}
		else
		{
			$this->rincian_produk_model->deleteWish($this->input->post('idwish'),null);
			$data['wishlist']= $this->rincian_produk_model->getWishlistBySession($this->session->userdata('sessionid'));
			$data['isicart'] = 0;
		}
		$data['gambar']=$this->GambarModel->selectFilteredProduct($data['wishlist']);
		$this->load->view('Customer/customer-wishlist.html',$data);
		
	}
	public function basket()
	{
		$nama = $this->input->post('nama_produk');
		$data['nama_produk'] = $this->rincian_produk_model->getProdukId($nama);
		$data['idproduk'] = '';
		foreach($data['nama_produk'] as $r)
		{
			$data['idproduk'] = $r->id_produk;
		}
		$data['idshop'] = $this->generateRandomString();
		$data['jumlahcart'] = $this->rincian_produk_model->getprodukjumlahcart($data['idproduk'],$this->session->userdata('ID_CUSTOMER'));
		$data['log'] = $this->ceklog();
		$data['hasil']=$this->rincian_produk_model->searchProdukByNama($this->session->userdata('filterSearch'));
		$temp = $this->session->userdata('filterSearch');
		
		$data['gambar']=$this->GambarModel->selectFilteredProduct($data['hasil']);
		$data['merek']="Hasil Penelusuran untuk '".$temp ."'";
		$data['barang']=$this->rincian_produk_model->getProduk();
		$data['kategori'] = $this->rincian_produk_model->getKategori();
		$data['subkategori'] = $this->rincian_produk_model->getSubKategori();
		if($data['jumlahcart']==null)
		{
			$data['jumlahcart'] = 0;
		}
		if($data['log'] == true){
			if($data['jumlahcart']==0)
			{
				$this->rincian_produk_model->insertCart($data['idshop'],$data['idproduk'],$this->session->userdata('ID_CUSTOMER'),$data['jumlahcart']+1);
			}
			else
			{
				$this->rincian_produk_model->updateCart($data['idproduk'],$this->session->userdata('ID_CUSTOMER'),$data['jumlahcart']+1);
			}
			$data['isicart'] = $this->rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
			if($this->input->post('idwish')!=null)
			{
				$this->rincian_produk_model->deleteWish($this->input->post('idwish'),$this->session->userdata('ID_CUSTOMER'));
			}
			$this->load->view('Customer/searchFilter.php',$data);
		}
		else
		{
			
			$data['isicart'] = 0;
			$this->load->view('Customer/index.php',$data);
		}
	}
	public function deletebasket()
	{
		$data['log'] = $this->ceklog();
		$data['hasil']=$this->rincian_produk_model->searchProdukByNama($this->session->userdata('filterSearch'));
		$temp = $this->session->userdata('filterSearch');
		$data['merek']="Hasil Penelusuran untuk '".$temp ."'";
		$data['barang']=$this->rincian_produk_model->getProduk();
		$data['kategori'] = $this->rincian_produk_model->getKategori();
		$data['subkategori'] = $this->rincian_produk_model->getSubKategori();
		if($data['log'] == true){
			$this->rincian_produk_model->deletecart($this->input->post('id_produk'),$this->session->userdata('ID_CUSTOMER'));
			$data['cart'] = $this->rincian_produk_model->getProdukById($this->session->userdata('ID_CUSTOMER'));
			
			$data['isicart'] = $this->rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
			$this->load->view('Customer/basket.html',$data);
		}
		else
		{
			
			$data['isicart'] = 0;
			$this->load->view('Customer/index.php',$data);
		}
		
	}
	public function tobasket()
	{
		$data['log'] = $this->ceklog();
		$data['hasil']=$this->rincian_produk_model->searchProdukByNama($this->session->userdata('filterSearch'));
		$temp = $this->session->userdata('filterSearch');
		$data['merek']="Hasil Penelusuran untuk '".$temp ."'";
		$data['barang']=$this->rincian_produk_model->getProduk();
		$data['kategori'] = $this->rincian_produk_model->getKategori();
		$data['subkategori'] = $this->rincian_produk_model->getSubKategori();
		if($data['log'] == true){
			$data['cart'] = $this->rincian_produk_model->getProdukById($this->session->userdata('ID_CUSTOMER'));
			
			$data['isicart'] = $this->rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
			$this->load->view('Customer/basket.html',$data);
		}
		else
		{
			
			$data['isicart'] = 0;
			$this->load->view('Customer/index.php',$data);
		}
		
	}
	
	public function generateRandomString($length = 10) 
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	public function detail()
	{
		$nama = $this->input->post('nama_produk');
		$data['isicart'] = $this->rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
		$data['nama_produk'] = $this->rincian_produk_model->getProdukId($nama);
		$data['idproduk'] = '';
		foreach($data['nama_produk'] as $r)
		{
			$data['idproduk'] = $r->id_produk;
		}
		$data['log'] = $this->ceklog();
		$data['hasil']=$this->rincian_produk_model->searchProdukByNama($this->session->userdata('filterSearch'));
		$temp = $this->session->userdata('filterSearch');
		$data['merek']="Hasil Penelusuran untuk '".$temp ."'";
		$data['barang']=$this->rincian_produk_model->getProduk();
		$data['kategori'] = $this->rincian_produk_model->getKategori();
		$data['subkategori'] = $this->rincian_produk_model->getSubKategori();
		if($data['log'] == true){
			$this->load->view('Customer/searchFilter.php',$data);
		}
		else
		{
			
			$data['isicart'] = 0;
			$this->load->view('Customer/index.php',$data);
		}
	}
	public function Login()
	{
		$data['email'] = $this->input->post('email');
		$data['pass'] = $this->input->post('pass');
		$log = $this->rincian_produk_model->cekLogin($data['email'],$data['pass']);
		$data['isicart'] = $this->rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
		$data['hasil']=$this->rincian_produk_model->searchProdukByNama($this->session->userdata('filterSearch'));
		$temp = $this->session->userdata('filterSearch');
		$data['merek']="Hasil Penelusuran untuk '".$temp ."'";
		$data['barang']=$this->rincian_produk_model->getProduk();
		$data['kategori'] = $this->rincian_produk_model->getKategori();
		$data['subkategori'] = $this->rincian_produk_model->getSubKategori();
		if($log==1)
		{
			$data['log'] = true;
			$this->session->set_userdata('ID_CUSTOMER',$data['email']);
			$this->rincian_produk_model->updateWish($data['email'],$this->session->userdata('sessionid'));
			$this->load->view('Customer/index.php',$data);
		}
		else
		{
			$data['log'] = false;
			$data['isicart'] = 0;	
			$this->load->view('Customer/index.php',$data);
		}
	}
	public function Logout()
	{
		
		$data['hasil']=$this->rincian_produk_model->searchProdukByNama($this->session->userdata('filterSearch'));
		$temp = $this->session->userdata('filterSearch');
		$data['merek']="Hasil Penelusuran untuk '".$temp ."'";
		$data['barang']=$this->rincian_produk_model->getProduk();
		$data['kategori'] = $this->rincian_produk_model->getKategori();
		$data['subkategori'] = $this->rincian_produk_model->getSubKategori();
		
		$data['log'] = false;
		$this->session->unset_userdata('ID_CUSTOMER');
		$this->session->unset_userdata('sessionid');
		$data['isicart'] = 0;
		$this->load->view('Customer/index.php',$data);
		
	}
	public function ceklog()
	{
		$data['log'] = false;
		if($this->session->userdata('ID_CUSTOMER')!=null)
		{
			$data['log'] = true;
		}
		return $data['log'];
	}
}
