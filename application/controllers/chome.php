<?php



defined('BASEPATH') OR exit('No direct script access allowed');

class Chome extends CI_Controller {

	
	public function index()
	{
		$data['log'] = $this->ceklog();
		$data['barang']=$this->rincian_produk_model->getProduk();
		$data['kategori'] = $this->rincian_produk_model->getKategori();
		$data['subkategori'] = $this->rincian_produk_model->getSubKategori();
		$data['promo']=$this->rincian_produk_model->getBannerPromo();
		$data['produkHot']=$this->rincian_produk_model->getHotProduk();
		$data['promoYangBerlaku']=$this->rincian_produk_model->getPromo();
		$data['gambar']=$this->GambarModel->selectFilteredProduct($data['produkHot']);
		
		
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
	
	public function getPromoId()
	{
		$id=$this->input->post('id');
		
		$this->session->set_userdata('promoId',$id);
	}
	
	public function searchProdukByPromo()
	{
		//Variabel milik daniel
		$data['isicart'] = $this->rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
		$data['log'] = $this->ceklog();
		
		//Variabel de Fuhrer
		$data['promo']=$this->rincian_produk_model->getPromoById($this->session->userdata('promoId'));
		$data['hasil']=$this->rincian_produk_model->getProdukByPromo($data['promo']);
		$data['merek']="Hasil Penelusuran untuk Promo";
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
		$data['promo']=$this->rincian_produk_model->getPromo();
		
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
		$data['promo']=$this->rincian_produk_model->getPromo();
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
		$data['promo']=$this->rincian_produk_model->getPromo();
		
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
		
		$data['promo']=$this->rincian_produk_model->getPromo();
		$data['log'] = $this->ceklog();
		$data['cekwish'] = $this->rincian_produk_model->cekwish($data['idproduk'],$this->session->userdata('ID_CUSTOMER'));
		$data['hasil']=$this->rincian_produk_model->searchProdukByNama($this->session->userdata('filterSearch'));
		$temp = $this->session->userdata('filterSearch');
		$data['merek']="Hasil Penelusuran untuk '".$temp ."'";
		$data['barang']=$this->rincian_produk_model->getProduk();
		$data['gambar']=$this->GambarModel->selectFilteredProduct($data['hasil']);
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
	redirect('chome/index','refresh');
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
		$data['gambar']=$this->GambarModel->selectFilteredProduct($data['hasil']);
		$data['subkategori'] = $this->rincian_produk_model->getSubKategori();
		$data['promo']=$this->rincian_produk_model->getPromo();
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
		$data['gambar']=$this->GambarModel->selectFilteredProduct($data['hasil']);
		$data['kategori'] = $this->rincian_produk_model->getKategori();
		$data['subkategori'] = $this->rincian_produk_model->getSubKategori();
		$data['promo']=$this->rincian_produk_model->getPromo();
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
		$data['promo']=$this->rincian_produk_model->getPromo();
		
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
	redirect('chome/index','refresh');
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
		$data['gambar']=$this->GambarModel->selectFilteredProduct($data['hasil']);
		$data['subkategori'] = $this->rincian_produk_model->getSubKategori();
		$data['promo']=$this->rincian_produk_model->getPromo();
		if($data['log'] == true){
			$this->rincian_produk_model->deletecart($this->input->post('id_produk'),$this->session->userdata('ID_CUSTOMER'));
			$data['cart'] = $this->rincian_produk_model->getProdukById($this->session->userdata('ID_CUSTOMER'));
			
			$data['isicart'] = $this->rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
			$this->load->view('Customer/basket.html',$data);
		}
		else
		{
			
			$data['isicart'] = 0;
	redirect('chome/index','refresh');
		}
		
	}
	public function dimanavariabelku()
	{
		
		$id=$this->input->post('id');
		$this->session->set_userdata('variabelgaib',$id);
		
		$produk=$this->input->post('produk');
		$this->session->set_userdata('produkgaib',$produk);
	}
	
	public function updatebasket()
	{
		$jumlah = explode(',',$this->session->userdata('variabelgaib'));
		
		$produks = $this->session->userdata('produkgaib');
		
		for($i=0;$i<count($jumlah);$i++)
		{
			$this->rincian_produk_model->updateCart($produks[$i],$this->session->userdata('ID_CUSTOMER'),$jumlah[$i]);
		}
		
		$data['log'] = $this->ceklog();
		$data['hasil']=$this->rincian_produk_model->searchProdukByNama($this->session->userdata('filterSearch'));
		$temp = $this->session->userdata('filterSearch');
		$data['merek']="Hasil Penelusuran untuk '".$temp ."'";
		$data['barang']=$this->rincian_produk_model->getProduk();
		$data['kategori'] = $this->rincian_produk_model->getKategori();
		$data['subkategori'] = $this->rincian_produk_model->getSubKategori();
		$data['promo']=$this->rincian_produk_model->getPromo();
		if($data['log'] == true){
			
			$data['cart'] = $this->rincian_produk_model->getProdukById($this->session->userdata('ID_CUSTOMER'));
			foreach($data['cart'] as $a)
			{
				foreach($data['promo'] as $k)
				{
					if($a->ID_PRODUK == $k->ID_PRODUK)
					{
						$a->HARGA_JUAL -= $a->HARGA_JUAL * ($k->DISKON_PROMOSI/100);
					}
				}
			}
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
		$data['gambar']=$this->GambarModel->selectFilteredProduct($data['hasil']);
		$data['kategori'] = $this->rincian_produk_model->getKategori();
		$data['subkategori'] = $this->rincian_produk_model->getSubKategori();
		$data['promo']=$this->rincian_produk_model->getPromo();
		
		if($data['log'] == true){
			$data['cart'] = $this->rincian_produk_model->getProdukById($this->session->userdata('ID_CUSTOMER'));
			foreach($data['cart'] as $a)
			{
				foreach($data['promo'] as $k)
				{
					if($a->ID_PRODUK == $k->ID_PRODUK)
					{
						$a->HARGA_JUAL -= $a->HARGA_JUAL * ($k->DISKON_PROMOSI/100);
					}
				}
			}
			$data['isicart'] = $this->rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
			$this->load->view('Customer/basket.html',$data);
		}
		else
		{
			
			$data['isicart'] = 0;
	redirect('chome/index','refresh');
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
	
	public function confirmcheck()
	{
		$jumlah = explode(',',$this->session->userdata('variabelgaib'));
		
		$produks = $this->session->userdata('produkgaib');
		$namaproduk="";
		for($i=0;$i<count($jumlah);$i++)
		{
			
			$this->rincian_produk_model->updateCart($produks[$i],$this->session->userdata('ID_CUSTOMER'),$jumlah[$i]);
			$tempstok = $this->rincian_produk_model->getStokProduk($produks[$i]);
			if($jumlah[$i] > $tempstok)
			{
				$namaproduk .= $this->rincian_produk_model->getNamaProdukById($produks[$i]). ", ";
			}
		}
		$data['log'] = $this->ceklog();
		$data['hasil']=$this->rincian_produk_model->searchProdukByNama($this->session->userdata('filterSearch'));
		$temp = $this->session->userdata('filterSearch');
		$data['merek']="Hasil Penelusuran untuk '".$temp ."'";
		$data['barang']=$this->rincian_produk_model->getProduk();
		$data['kategori'] = $this->rincian_produk_model->getKategori();
		$data['subkategori'] = $this->rincian_produk_model->getSubKategori();
		$data['promo']=$this->rincian_produk_model->getPromo();
		if($data['log'] == true){
			
			$data['cart'] = $this->rincian_produk_model->getProdukById($this->session->userdata('ID_CUSTOMER'));
			
			foreach($data['cart'] as $a)
			{
				foreach($data['promo'] as $k)
				{
					if($a->ID_PRODUK == $k->ID_PRODUK)
					{
						$a->HARGA_JUAL -= $a->HARGA_JUAL * ($k->DISKON_PROMOSI/100);
					}
				}
			}
			$data['isicart'] = $this->rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));	
			if($namaproduk=="")
			{
				$this->load->view('Customer/checkout4.html',$data);
			}
			else
			{
				$this->load->view('Customer/basket.html',$data);
				echo "<script> alert('Stok ".$namaproduk."Tidak cukup'); </script>";
			}	
		}
		else
		{
			
			$data['isicart'] = 0;
			$this->load->view('Customer/index.php',$data);
		}
	}
	public function dopurchase()
	{
		$cart = $this->rincian_produk_model->getProdukById($this->session->userdata('ID_CUSTOMER'));
		
		$data['promo']=$this->rincian_produk_model->getPromo();
		
		$this->paypal_lib->add_field("cmd","_cart");
		$this->paypal_lib->add_field("upload",1);
		$this->paypal_lib->add_field("return",site_url("chome/paypal_success"));
		$this->paypal_lib->add_field("cancel_return",site_url("chome/confirmcheck"));
		$this->paypal_lib->add_field("no_shipping",1);
		$this->paypal_lib->add_field("no_note",1);
		
		$index = 1;
		
		foreach($cart as $a)
		{
			
			foreach($data['promo'] as $k)
			{
				if($a->ID_PRODUK == $k->ID_PRODUK)
				{
					$a->HARGA_JUAL -= $a->HARGA_JUAL * ($k->DISKON_PROMOSI/100);
				}
			}
			$this->paypal_lib->add_field("item_name_$index",$a->NAMA_PRODUK);
			$this->paypal_lib->add_field("item_number_$index",$a->ID_PRODUK);
			$this->paypal_lib->add_field("quantity_$index",$a->JUMLAH);
			$this->paypal_lib->add_field("amount_$index",round($a->HARGA_JUAL/10000,2));
			$index++;
		}
		
        $this->paypal_lib->paypal_auto_form();
	}
    public function paypal_success() {
		$cart = $this->rincian_produk_model->getProdukById($this->session->userdata('ID_CUSTOMER'));
		$totalHjual= 0;
		
		$tgl = date("dmy");
		$noHjual = $this->rincian_produk_model->getHjualId($tgl);
		$idHjual = $tgl.$noHjual;
		
		$surat = "SJ".$this->rincian_produk_model->getSJId();
		
		$data['promo']=$this->rincian_produk_model->getPromo();
		foreach($cart as $a)
		{
			foreach($data['promo'] as $k)
			{
				if($a->ID_PRODUK == $k->ID_PRODUK)
				{
					$a->HARGA_JUAL -= $a->HARGA_JUAL * ($k->DISKON_PROMOSI/100);
				}
			}
			$totalHjual += $a->JUMLAH * $a->HARGA_JUAL;
		}
		$this->rincian_produk_model->insertHjual($idHjual, $totalHjual, $surat, 'D');
		
		foreach($cart as $a)
		{
			$noDjual = $this->rincian_produk_model->getDjualId($tgl);
			$idDjual = $tgl.$noDjual;
			$tempstok = $this->rincian_produk_model->getStokProduk($a->ID_PRODUK);
			$stok = $tempstok - $a->JUMLAH;
			$this->rincian_produk_model->updateStokProduk($a->ID_PRODUK,$stok);
			$this->rincian_produk_model->insertDjual($idDjual, $idHjual, $a->ID_PRODUK, $a->NAMA_PRODUK, $a->HARGA_JUAL, $a->JUMLAH, ($a->HARGA_JUAL*$a->JUMLAH));
		}
		
		$data['log'] = $this->ceklog();
		$data['barang']=$this->rincian_produk_model->getProduk();
		$data['kategori'] = $this->rincian_produk_model->getKategori();
		$data['subkategori'] = $this->rincian_produk_model->getSubKategori();
		if($data['log'])
		{
			
			$this->rincian_produk_model->clearCart($this->session->userdata('ID_CUSTOMER'));
			$data['isicart'] = $this->rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
		}
		else
		{
			$data['isicart']=0;
		}
		redirect("chome/index");
		$this->load->view('Customer/index.php',$data);
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
		$data['gambar']=$this->GambarModel->selectFilteredProduct($data['hasil']);
		$data['kategori'] = $this->rincian_produk_model->getKategori();
		$data['subkategori'] = $this->rincian_produk_model->getSubKategori();
		if($data['log'] == true){
			$this->load->view('Customer/searchFilter.php',$data);
		}
		else
		{
			
			$data['isicart'] = 0;
	redirect('chome/index','refresh');
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
			redirect('chome/index','refresh');
		}
		else
		{
			$data['log'] = false;
			$data['isicart'] = 0;	
			redirect('chome/index','refresh');
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
		redirect('chome/index','refresh');
		
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
