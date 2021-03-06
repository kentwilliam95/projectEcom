<?php



defined('BASEPATH') OR exit('No direct script access allowed');

class Chome extends CI_Controller {

	
	public function index()
	{
		$data['log'] = $this->ceklog();
		$data['barang']=$this->Rincian_produk_model->getProduk();
		$data['kategori'] = $this->Rincian_produk_model->getKategori();
		$data['subkategori'] = $this->Rincian_produk_model->getSubKategori();
		$data['promo']=$this->Rincian_produk_model->getBannerPromo();
		$data['produkHot']=$this->Rincian_produk_model->getHotProduk();
		$data['promoYangBerlaku']=$this->Rincian_produk_model->getPromo();
		$data['gambar']=$this->GambarModel->selectFilteredProduct($data['produkHot']);
		
		
		if($data['log'])
		{
			$data['isicart'] = $this->Rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
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
	
	public function getKategoriId()
	{
		$id=$this->input->post('id');
		
		$this->session->set_userdata('kategoriId',$id);
	}
	
	public function getPromoId()
	{
		$id=$this->input->post('id');
		
		$this->session->set_userdata('promoId',$id);
	}
	
	public function searchProdukByPromo()
	{
		//Variabel milik daniel
		$data['isicart'] = $this->Rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
		$data['log'] = $this->ceklog();
		
		//Variabel de Fuhrer
		$data['promo']=$this->Rincian_produk_model->getPromoById($this->session->userdata('promoId'));
		$data['hasil']=$this->Rincian_produk_model->getProdukByPromo($data['promo']);
		$data['merek']="Hasil Penelusuran untuk Promo";
		$data['barang']=$this->Rincian_produk_model->getProduk();
		$data['kategori'] = $this->Rincian_produk_model->getKategori();
		$data['subkategori'] = $this->Rincian_produk_model->getSubKategori();
		$data['gambar']=$this->GambarModel->selectFilteredProduct($data['hasil']);
		

		if($data['log'] == true){
		}
		else
		{
			$data['isicart'] = 0;
		}
		$this->load->view('Customer/searchFilter.php',$data);
		
	}
	
	public function searchProdukByKategori()
	{
		//Variabel milik daniel
		$data['isicart'] = $this->Rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
		$data['log'] = $this->ceklog();
		
		//Variabel milik Der Fuhrer
		$data['hasil']=$this->Rincian_produk_model->searchProdukByKategori($this->session->userdata('kategoriId'));
		$data['merek']=$this->session->userdata('kategoriId');
		$data['barang']=$this->Rincian_produk_model->getProduk();
		$data['kategori'] = $this->Rincian_produk_model->getKategori();
		$data['subkategori'] = $this->Rincian_produk_model->getSubKategori();
		$data['gambar']=$this->GambarModel->selectFilteredProduct($data['hasil']);
		$data['promo']=$this->Rincian_produk_model->getPromo();
		
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
		$data['isicart'] = $this->Rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
		$data['log'] = $this->ceklog();
		
		//Variabel milik Der Fuhrer
		$arr =  explode("|",$this->session->userdata('filterSearch'));
		$data['hasil']=$this->Rincian_produk_model->searchProdukByMerk($arr[0],$arr[1]);
		$data['merek']=$arr[0];
		$data['barang']=$this->Rincian_produk_model->getProduk();
		$data['kategori'] = $this->Rincian_produk_model->getKategori();
		$data['subkategori'] = $this->Rincian_produk_model->getSubKategori();
		$data['gambar']=$this->GambarModel->selectFilteredProduct($data['hasil']);
		$data['promo']=$this->Rincian_produk_model->getPromo();
		
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
		$data['isicart'] = $this->Rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
		
		$temp = $this->session->userdata('filterSearch');
		$this->session->set_userdata('filterSearch',$temp."|searchNama");
		$arr =  explode("|",$this->session->userdata('filterSearch'));
		
		if($arr[1]=="searchNama")
		{
			$data['hasil']=$this->Rincian_produk_model->searchProdukByNama($arr[0]);
		}
		else
		{
			$data['hasil']=$this->Rincian_produk_model->searchProdukByMerk($arr[0],$arr[1]);
		}
		
		
		$data['merek']="Hasil Penelusuran untuk '".$arr[0] ."'";
		$data['barang']=$this->Rincian_produk_model->getProduk();
		$data['kategori'] = $this->Rincian_produk_model->getKategori();
		$data['subkategori'] = $this->Rincian_produk_model->getSubKategori();
		$data['gambar']=$this->GambarModel->selectFilteredProduct($data['hasil']);
		$data['promo']=$this->Rincian_produk_model->getPromo();
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
		$data['isicart'] = $this->Rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
		$data['log'] = $this->ceklog();
	
		
		$data['hasil']=$this->Rincian_produk_model->selectById($this->session->userdata('idBarang'));		
		$data['barang']=$this->Rincian_produk_model->getProduk();
		$data['gambar']=$this->GambarModel->selectById($this->session->userdata('idBarang'));		
		
		$data['other']=$this->Rincian_produk_model->selectOther($this->session->userdata('idBarang'));
		$data['gambarOther']=$this->Rincian_produk_model->selectOtherImage($data['other']);
		
		$data['kategoriBarang']=$this->Rincian_produk_model->getKategoriProduk($this->session->userdata('idBarang'))->KATEGORI_PRODUK;
		$temp = $this->Rincian_produk_model->getKategori();
		$data['kategori'] = $this->Rincian_produk_model->getTotalItem($temp);
		$data['subkategori'] = $this->Rincian_produk_model->getSubKategori();
		$data['promo']=$this->Rincian_produk_model->getPromo();
		
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
		
		$data['promo']=$this->Rincian_produk_model->getPromo();
		$data['log'] = $this->ceklog();
		$data['cekwish'] = $this->Rincian_produk_model->cekwish($data['idproduk'],$this->session->userdata('ID_CUSTOMER'));
		
		$arr =  explode("|",$this->session->userdata('filterSearch'));
		if($arr[1]=="searchNama")
		{
			$data['hasil']=$this->Rincian_produk_model->searchProdukByNama($arr[0]);
		}
		else
		{
			$data['hasil']=$this->Rincian_produk_model->searchProdukByMerk($arr[0],$arr[1]);
		}
		$data['merek']=$arr[0];
		$data['barang']=$this->Rincian_produk_model->getProduk();
		$data['gambar']=$this->GambarModel->selectFilteredProduct($data['hasil']);
		$data['kategori'] = $this->Rincian_produk_model->getKategori();
		$data['subkategori'] = $this->Rincian_produk_model->getSubKategori();
		$data['isicart'] = $this->Rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
		
		if(isset($_POST["add"]))
		{
			if($data['cekwish']==0)
			{
				$this->Rincian_produk_model->insertWish($data['idproduk'],$this->session->userdata('ID_CUSTOMER'),$data['idwish'],$this->session->userdata('sessionid'));	
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
		
		$arr =  explode("|",$this->session->userdata('filterSearch'));
		$data['hasil']=$this->Rincian_produk_model->searchProdukByMerk($arr[0],$arr[1]);
		$data['merek']=$arr[0];
		
		$data['barang']=$this->Rincian_produk_model->getProduk();
		$data['kategori'] = $this->Rincian_produk_model->getKategori();
		$data['gambar']=$this->GambarModel->selectFilteredProduct($data['hasil']);
		$data['subkategori'] = $this->Rincian_produk_model->getSubKategori();
		$data['promo']=$this->Rincian_produk_model->getPromo();
		if($data['log'] == true){
			$data['wishlist']= $this->Rincian_produk_model->getWishlistById($this->session->userdata('ID_CUSTOMER'));
		
			$data['isicart'] = $this->Rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
		}
		else
		{
			$data['wishlist']= $this->Rincian_produk_model->getWishlistBySession($this->session->userdata('sessionid'));
			$data['isicart'] = 0;
		}
		$data['gambar']=$this->GambarModel->selectFilteredProduct($data['wishlist']);
		$this->load->view('Customer/customer-wishlist.html',$data);
		
	}public function deletewish()
	{
		$data['wishlist']="";
		$data['log'] = $this->ceklog();
		$arr =  explode("|",$this->session->userdata('filterSearch'));
		if($arr[1]=="searchNama")
		{
			$data['hasil']=$this->Rincian_produk_model->searchProdukByNama($arr[0]);
		}
		else
		{
			$data['hasil']=$this->Rincian_produk_model->searchProdukByMerk($arr[0],$arr[1]);
		}
		$data['merek']=$arr[0];
		$data['barang']=$this->Rincian_produk_model->getProduk();
		$data['gambar']=$this->GambarModel->selectFilteredProduct($data['hasil']);
		$data['kategori'] = $this->Rincian_produk_model->getKategori();
		$data['subkategori'] = $this->Rincian_produk_model->getSubKategori();
		$data['promo']=$this->Rincian_produk_model->getPromo();
		if($data['log'] == true){
			$this->Rincian_produk_model->deleteWish($this->input->post('idwish'),$this->session->userdata('ID_CUSTOMER'));
			$data['wishlist']= $this->Rincian_produk_model->getWishlistById($this->session->userdata('ID_CUSTOMER'));
		
			$data['isicart'] = $this->Rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
		}
		else
		{
			$this->Rincian_produk_model->deleteWish($this->input->post('idwish'),null);
			$data['wishlist']= $this->Rincian_produk_model->getWishlistBySession($this->session->userdata('sessionid'));
			$data['isicart'] = 0;
		}
		$data['gambar']=$this->GambarModel->selectFilteredProduct($data['wishlist']);
		$this->load->view('Customer/customer-wishlist.html',$data);
		
	}
	public function basket()
	{
		$nama = $this->input->post('nama_produk');
		$data['nama_produk'] = $this->Rincian_produk_model->getProdukId($nama);
		$data['idproduk'] = '';
		foreach($data['nama_produk'] as $r)
		{
			$data['idproduk'] = $r->id_produk;
		}
		$data['idshop'] = $this->generateRandomString();
		$data['jumlahcart'] = $this->Rincian_produk_model->getprodukjumlahcart($data['idproduk'],$this->session->userdata('ID_CUSTOMER'));
		$data['log'] = $this->ceklog();
		$arr =  explode("|",$this->session->userdata('filterSearch'));
		if($arr[1]=="searchNama")
		{
			$data['hasil']=$this->Rincian_produk_model->searchProdukByNama($arr[0]);
		}
		else
		{
			$data['hasil']=$this->Rincian_produk_model->searchProdukByMerk($arr[0],$arr[1]);
		}
		$data['merek']=$arr[0];
		
		$data['gambar']=$this->GambarModel->selectFilteredProduct($data['hasil']);
		
		$data['barang']=$this->Rincian_produk_model->getProduk();
		$data['kategori'] = $this->Rincian_produk_model->getKategori();
		$data['subkategori'] = $this->Rincian_produk_model->getSubKategori();
		$data['promo']=$this->Rincian_produk_model->getPromo();
		
		if($data['jumlahcart']==null)
		{
			$data['jumlahcart'] = 0;
		}
		if($data['log'] == true){
			if($data['jumlahcart']==0)
			{
				$this->Rincian_produk_model->insertCart($data['idshop'],$data['idproduk'],$this->session->userdata('ID_CUSTOMER'),$data['jumlahcart']+1);
			}
			else
			{
				$this->Rincian_produk_model->updateCart($data['idproduk'],$this->session->userdata('ID_CUSTOMER'),$data['jumlahcart']+1);
			}
			$data['isicart'] = $this->Rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
			if($this->input->post('idwish')!=null)
			{
				$this->Rincian_produk_model->deleteWish($this->input->post('idwish'),$this->session->userdata('ID_CUSTOMER'));
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
		$arr =  explode("|",$this->session->userdata('filterSearch'));
		if($arr[1]=="searchNama")
		{
			$data['hasil']=$this->Rincian_produk_model->searchProdukByNama($arr[0]);
		}
		else
		{
			$data['hasil']=$this->Rincian_produk_model->searchProdukByMerk($arr[0],$arr[1]);
		}
		$data['merek']=$arr[0];
		$data['barang']=$this->Rincian_produk_model->getProduk();
		$data['kategori'] = $this->Rincian_produk_model->getKategori();
		$data['gambar']=$this->GambarModel->selectFilteredProduct($data['hasil']);
		$data['subkategori'] = $this->Rincian_produk_model->getSubKategori();
		$data['promo']=$this->Rincian_produk_model->getPromo();
		if($data['log'] == true){
			$this->Rincian_produk_model->deletecart($this->input->post('id_produk'),$this->session->userdata('ID_CUSTOMER'));
			$data['cart'] = $this->Rincian_produk_model->getProdukById($this->session->userdata('ID_CUSTOMER'));
			
			$data['isicart'] = $this->Rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
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
			$this->Rincian_produk_model->updateCart($produks[$i],$this->session->userdata('ID_CUSTOMER'),$jumlah[$i]);
		}
		
		$data['log'] = $this->ceklog();
		$arr =  explode("|",$this->session->userdata('filterSearch'));
		if($arr[1]=="searchNama")
		{
			$data['hasil']=$this->Rincian_produk_model->searchProdukByNama($arr[0]);
		}
		else
		{
			$data['hasil']=$this->Rincian_produk_model->searchProdukByMerk($arr[0],$arr[1]);
		}
		$data['merek']=$arr[0];
		$data['barang']=$this->Rincian_produk_model->getProduk();
		$data['kategori'] = $this->Rincian_produk_model->getKategori();
		$data['subkategori'] = $this->Rincian_produk_model->getSubKategori();
		$data['promo']=$this->Rincian_produk_model->getPromo();
		if($data['log'] == true){
			
			$data['cart'] = $this->Rincian_produk_model->getProdukById($this->session->userdata('ID_CUSTOMER'));
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
			$data['isicart'] = $this->Rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
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
		$arr =  explode("|",$this->session->userdata('filterSearch'));
		if($arr[1]=="searchNama")
		{
			$data['hasil']=$this->Rincian_produk_model->searchProdukByNama($arr[0]);
		}
		else
		{
			$data['hasil']=$this->Rincian_produk_model->searchProdukByMerk($arr[0],$arr[1]);
		}
		$data['merek']=$arr[0];
		$data['barang']=$this->Rincian_produk_model->getProduk();
		$data['gambar']=$this->GambarModel->selectFilteredProduct($data['hasil']);
		$data['kategori'] = $this->Rincian_produk_model->getKategori();
		$data['subkategori'] = $this->Rincian_produk_model->getSubKategori();
		$data['promo']=$this->Rincian_produk_model->getPromo();
		
		if($data['log'] == true){
			$data['cart'] = $this->Rincian_produk_model->getProdukById($this->session->userdata('ID_CUSTOMER'));
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
			$data['isicart'] = $this->Rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
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
			
			$this->Rincian_produk_model->updateCart($produks[$i],$this->session->userdata('ID_CUSTOMER'),$jumlah[$i]);
			$tempstok = $this->Rincian_produk_model->getStokProduk($produks[$i]);
			if($jumlah[$i] > $tempstok)
			{
				$namaproduk .= $this->Rincian_produk_model->getNamaProdukById($produks[$i]). ", ";
			}
		}
		$data['log'] = $this->ceklog();
		$arr =  explode("|",$this->session->userdata('filterSearch'));
		$data['hasil']=$this->Rincian_produk_model->searchProdukByMerk($arr[0],$arr[1]);
		$data['merek']=$arr[0];
		$data['barang']=$this->Rincian_produk_model->getProduk();
		$data['kategori'] = $this->Rincian_produk_model->getKategori();
		$data['subkategori'] = $this->Rincian_produk_model->getSubKategori();
		$data['promo']=$this->Rincian_produk_model->getPromo();
		if($data['log'] == true){
			
			$data['cart'] = $this->Rincian_produk_model->getProdukById($this->session->userdata('ID_CUSTOMER'));
			
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
			$data['isicart'] = $this->Rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));	
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
		$cart = $this->Rincian_produk_model->getProdukById($this->session->userdata('ID_CUSTOMER'));
		
		$data['promo']=$this->Rincian_produk_model->getPromo();
		
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
		$cart = $this->Rincian_produk_model->getProdukById($this->session->userdata('ID_CUSTOMER'));
		$totalHjual= 0;
		
		$tgl = date("dmy");
		$noHjual = $this->Rincian_produk_model->getHjualId($tgl);
		$idHjual = $tgl.$noHjual;
		
		$surat = "SJ".$this->Rincian_produk_model->getSJId();
		
		$data['promo']=$this->Rincian_produk_model->getPromo();
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
		$this->Rincian_produk_model->insertHjual($idHjual, $totalHjual, $surat, 'D');
		
		foreach($cart as $a)
		{
			$noDjual = $this->Rincian_produk_model->getDjualId($tgl);
			$idDjual = $tgl.$noDjual;
			$tempstok = $this->Rincian_produk_model->getStokProduk($a->ID_PRODUK);
			$stok = $tempstok - $a->JUMLAH;
			$this->Rincian_produk_model->updateStokProduk($a->ID_PRODUK,$stok);
			$this->Rincian_produk_model->insertDjual($idDjual, $idHjual, $a->ID_PRODUK, $a->NAMA_PRODUK, $a->HARGA_JUAL, $a->JUMLAH, ($a->HARGA_JUAL*$a->JUMLAH));
		}
		
		$data['log'] = $this->ceklog();
		$data['barang']=$this->Rincian_produk_model->getProduk();
		$data['kategori'] = $this->Rincian_produk_model->getKategori();
		$data['subkategori'] = $this->Rincian_produk_model->getSubKategori();
		if($data['log'])
		{
			
			$this->Rincian_produk_model->clearCart($this->session->userdata('ID_CUSTOMER'));
			$data['isicart'] = $this->Rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
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
		$data['isicart'] = $this->Rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
		$data['nama_produk'] = $this->Rincian_produk_model->getProdukId($nama);
		$data['idproduk'] = '';
		foreach($data['nama_produk'] as $r)
		{
			$data['idproduk'] = $r->id_produk;
		}
		$data['log'] = $this->ceklog();
		$arr =  explode("|",$this->session->userdata('filterSearch'));
		$data['hasil']=$this->Rincian_produk_model->searchProdukByMerk($arr[0],$arr[1]);
		$data['merek']=$arr[0];
		$data['barang']=$this->Rincian_produk_model->getProduk();
		$data['gambar']=$this->GambarModel->selectFilteredProduct($data['hasil']);
		$data['kategori'] = $this->Rincian_produk_model->getKategori();
		$data['subkategori'] = $this->Rincian_produk_model->getSubKategori();
		if($data['log'] == true){
			$this->load->view('Customer/searchFilter.php',$data);
		}
		else
		{
			
			$data['isicart'] = 0;
	redirect('chome/index','refresh');
		}
	}
	public function toregister()
	{
		$data['nama'] = "";
		$data['email'] = "";
		$data['alamat'] = "";
		$data['kota'] = "";
		$data['negara'] = "";
		$data['kodepost'] = "";
		$data['notelp'] = "";
		$this->load->view('Customer/register.html',$data);
	}
	public function register()
	{
		$this->load->model("rincian_produk_model");
		$data['nama'] = ($this->input->post('nama'));
		$pass = ($this->input->post('pass'));
		$cpass = ($this->input->post('cpass'));
		$data['email'] = ($this->input->post('email'));
		$data['alamat'] = ($this->input->post('alamat'));
		$jk = ($this->input->post('jk'));
		$tgl = ($this->input->post('tgllahir'));
		$data['kota'] = ($this->input->post('kota'));
		$data['negara'] = ($this->input->post('negara'));
		$data['kodepost'] = ($this->input->post('kodepost'));
		$data['notelp'] = ($this->input->post('notelp'));
		$ada = $this->rincian_produk_model->cekEmail($data['email']);
		if($ada>0)
		{
			echo "<script> alert('Email sudah terdaftar'); </script>";
			$data['email']="";
			$this->load->view('Customer/register.html',$data);
		}
		else
		{
			if($pass==$cpass)
			{
				$this->rincian_produk_model->insertCustomer($data['email'],$data['nama'],$pass,$data['alamat'],$jk,$tgl,$data['kota'],$data['negara'],$data['kodepost'],$data['notelp']);
				echo "<script> alert('Register Berhasil !'); </script>";
				redirect('chome/index','refresh');
			}
			else
			{
				echo "<script> alert('Password dan Confirm Password tidak sama !'); </script>";
				$this->load->view('Customer/register.html',$data);
			}
		}
	}
	public function Login()
	{
		$data['email'] = $this->input->post('email');
		$data['pass'] = $this->input->post('pass');
		$log = $this->Rincian_produk_model->cekLogin($data['email'],$data['pass']);
		$logstaff = $this->Rincian_produk_model->cekLoginStaff($data['email'],$data['pass']);
		$data['isicart'] = $this->Rincian_produk_model->getTotalJumlahCart($this->session->userdata('ID_CUSTOMER'));
		$arr =  explode("|",$this->session->userdata('filterSearch'));
		$data['hasil']=$this->Rincian_produk_model->searchProdukByMerk($arr[0],$arr[1]);
		$data['merek']=$arr[0];
		$data['barang']=$this->Rincian_produk_model->getProduk();
		$data['kategori'] = $this->Rincian_produk_model->getKategori();
		$data['subkategori'] = $this->Rincian_produk_model->getSubKategori();
		if($log==1)
		{
			$data['log'] = true;
			$this->session->set_userdata('ID_CUSTOMER',$data['email']);
			$this->Rincian_produk_model->updateWish($data['email'],$this->session->userdata('sessionid'));
			redirect('chome/index','refresh');
		}
		else if ($logstaff==1)
		{
			redirect('Master/index');
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
		
		$arr =  explode("|",$this->session->userdata('filterSearch'));
		$data['hasil']=$this->Rincian_produk_model->searchProdukByMerk($arr[0],$arr[1]);
		$data['merek']=$arr[0];
		$data['barang']=$this->Rincian_produk_model->getProduk();
		$data['kategori'] = $this->Rincian_produk_model->getKategori();
		$data['subkategori'] = $this->Rincian_produk_model->getSubKategori();
		
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

	function Akun()
	{
		$this->load->model("Basic");
		$idcust = $this->session->userdata('ID_CUSTOMER');
		if(empty($idcust))
		{redirect("Chome/index");}
		$data["datacust"]=$this->Basic->getDataWhere("customer",array("ID_CUSTOMER" => $idcust));
		$this->load->view("Customer/customer-account",$data);
	}
	function Akun2()
	{
		//buat update data customer
		$this->load->model("Basic");
		$nama = $this->input->post('nama');
		$zip = $this->input->post('zip');
		$kota = $this->input->post('kota');
		$negara = $this->input->post('negara');
		$telepon = $this->input->post('telepon');
		$id = $this->input->post('id');
		$alamat = $this->input->post('alamat');
		
		$data = array("NAMA_CUSTOMER" =>$nama,"ALAMAT_CUSTOMER" =>$alamat,"KOTA" =>$kota,"NEGARA" =>$negara,"KODE_POSTAL" =>$zip,"TELEPHON" =>$telepon);
		$kondisi = array("ID_CUSTOMER" => $id);
		
		$this->Basic->UpdateData("customer",$data,$kondisi);
		redirect("Chome/Akun");
	}
}
