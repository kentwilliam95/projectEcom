<?php
class MasterPromosi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->helper("form");
        $this->load->model("ModelPromosi");
        header('Access-Control-Allow-Origin: *');
    }

	function index()
	{
		$data["msg"] = $this->session->flashdata("item");
		$data["gambar"] = array();
		$data["Autogen"] = $this->getAutogenProduk(); 
		$data["produkx"] = $this->ModelPromosi->getData("produk");
		
		$produk = $this->ModelPromosi->getData2("produk");
        $data["hasil"] = array();
        
        $count = count($produk);
        for($i=0;$i<$count/5;$i++)
        {
            $q = array();
            $b = array();
			$c = array();
            //$i = array("PR001","PR002","PR003","PR004","PR005");
            //$b = array("ROTI","FLASH DISK","AQUA","MAP","KOMPAS");
            //$a = array($i,$b);
            $t1 = $i*5;
            $t2 = $t1 + 5;
            for($ss=$t1;$ss<$t2;$ss++)
            { 
                if($ss < $count)
                {
                    array_push($b,$produk[$ss]["NAMA_PRODUK"]);
					array_push($c,$produk[$ss]["ID_PRODUK"]);
                }
               
            }
            for($as=$t1;$as<$t2;$as++)
            {
                if($as < $count)
                {
                $dat = $this->ModelPromosi->getDataWhere_array("gambar",array("ID_PRODUK"=>$produk[$as]["ID_PRODUK"]));    
                    if(!empty($dat))
                    {
                        array_push($q,$dat[0]["NAMA_GAMBAR"]);
                    }
					else
					{
						array_push($q,"5.png");
					}
                }
            }
            $a = array($q,$b,$c);
            array_push($data["hasil"],$a);
			
        }
		
		//print_r($data["hasil"][0][2]);
		$data['b_url'] = base_url();
		$this->load->view("HeaderMaster");
        $this->load->view("MasterPromosi",$data);
	}
	
	function ListPromosi()
    {
        $HasilVendor=$this->ModelPromosi->getData("hpromosi",null);
		$data["promosi"] = Array();
		$hasil=array();
		$temp = array();
		$diskon = 0;
			
		foreach($HasilVendor as $row)
		{
			$gabung = "";
			$promosi_produk = $this->ModelPromosi->getDataWhere("promosi",Array("IDHPROMOSI" => $row->IDHPROMOSI));
			foreach($promosi_produk as $a)
			{
				$diskon = $a->DISKON_PROMOSI;
				if($gabung == "")
				{
					$gabung = $gabung.$a->ID_PRODUK;
				}
				else
				{
					$gabung = $gabung."-".$a->ID_PRODUK;
				}
			}
			
			$temp = Array($row->IDHPROMOSI,$gabung,$row->NAMA_PROMOSI,$row->TGL_MULAI_PROMOSI,$row->TGL_AKHIR_PROMOSI,$diskon,$row->STATUS,$row->DESKRIPSI_PROMO,"<a href='".site_url('MasterPromosi/UpdateForm/'.$row->IDHPROMOSI)."'>Update</a>|<a href='".site_url('MasterPromosi/DeletePromosi/'.$row->IDHPROMOSI)."'>Delete</a>");
			Array_push($hasil,$temp);
			$temp = Array();
		}
		$data["promosi"] = json_encode($hasil);
		
        $this->load->view("HeaderMaster");
        $this->load->view("listpromosi",$data);
    }
	
	 public function do_upload()
     {
			$fakta = $this->GetInputData();
            
			
			$config['upload_path']          = './Produk/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 0;
            $config['max_width']            = 4084;
            $config['max_height']           = 4084; 
            $config["file_name"]            = $fakta["Id"];
            $this->load->library('upload', $config);
			$msg = array();
			if($this->upload->do_upload('userfile'))
			{
				array_push($msg,"Image Berhasil Di Upload");
			}
			else
			{
				array_push($msg,"Image Gagal Di upload : ".$this->upload->display_errors()." Silahkan Pergi Ke Update");
			}
			$value = Array("IDHPROMOSI"=>$fakta["Id"],"NAMA_PROMOSI"=>$fakta["Nama"],"TGL_MULAI_PROMOSI"=>$fakta["TglMulai"],"TGL_AKHIR_PROMOSI"=>$fakta["TglAkhir"],"STATUS"=>"Y","DESKRIPSI_PROMO"=>$fakta["Deskrip"],"GAMBARPROMO"=>$this->upload->data()["file_name"]);
            $this->ModelPromosi->Insert("hpromosi",$value); 
			foreach($fakta["Id_pro"] as $a)
			{
				$value2 = Array("ID_DPROMOSI"=>$this->getAutogenPromosi(),"ID_PRODUK"=>$a,"IDHPROMOSI"=>$fakta["Id"],"DISKON_PROMOSI"=>$fakta["Diskon"]);
				$this->ModelPromosi->Insert("promosi",$value2);
			}
			$this->session->set_flashdata("item",$msg);
            redirect("MasterPromosi/index");
      }
	
	function getAutogenProduk()
    {
        $nomor = $this->ModelPromosi->Autogen("SELECT (max(SUBSTRING(`IDHPROMOSI`,4))+1)as nomor from hpromosi")[0]->nomor;
        $Autogen = "HPR".sprintf("%04d",$nomor);
        return $Autogen;
    }

	function getAutogenPromosi()
    {
        $nomor = $this->ModelPromosi->Autogen("SELECT (max(SUBSTRING(`ID_DPROMOSI`,4))+1)as nomor from promosi")[0]->nomor;
        $Autogen = "DPR".sprintf("%04d",$nomor);
        return $Autogen;
    }
	
	function GetInputData()
      {
          $bahan["Id"] = $this->input->post("Idh",true);
		  $bahan["Id_pro"] = $this->input->post("Id_pro",true);
          $bahan["Nama"] = $this->input->post("Nama",true);
          $bahan["TglMulai"] = $this->input->post("TglMulai",true);
		  $bahan["TglAkhir"] = $this->input->post("TglAkhir",true);
          $bahan["Diskon"] = $this->input->post("Diskon",true);
		  $bahan["Deskrip"] = $this->input->post("Deskrip",true);
          return $bahan;
      }
	  
	function UpdateForm($value)
    {
		$data["msg"] = $this->session->flashdata("item");
		$data["gambar"] = array();
		$data["Autogen"] = $this->getAutogenProduk(); 
		$data["produkx"] = $this->ModelPromosi->getData("produk");
		$data["promo"] = $this->ModelPromosi->getData("hpromosi");
		$produk = $this->ModelPromosi->getData2("produk");
        $data["hasil"] = array();
        
        $count = count($produk);
        for($i=0;$i<$count/5;$i++)
        {
            $q = array();
            $b = array();
			$c = array();
            //$i = array("PR001","PR002","PR003","PR004","PR005");
            //$b = array("ROTI","FLASH DISK","AQUA","MAP","KOMPAS");
            //$a = array($i,$b);
            $t1 = $i*5;
            $t2 = $t1 + 5;
            for($ss=$t1;$ss<$t2;$ss++)
            { 
                if($ss < $count)
                {
                    array_push($b,$produk[$ss]["NAMA_PRODUK"]);
					array_push($c,$produk[$ss]["ID_PRODUK"]);
                }
               
            }
            for($as=$t1;$as<$t2;$as++)
            {
                if($as < $count)
                {
                $dat = $this->ModelPromosi->getDataWhere_array("gambar",array("ID_PRODUK"=>$produk[$as]["ID_PRODUK"]));    
                    if(!empty($dat))
                    {
                        array_push($q,$dat[0]["NAMA_GAMBAR"]);
                    }
					else
					{
						array_push($q,"5.png");
					}
                }
            }
            $a = array($q,$b,$c);
            array_push($data["hasil"],$a);
        }
		
		$data["potongID"] = $this->ModelPromosi->getDataWhere("promosi",Array("IDHPROMOSI" => $value));
		
		//print_r($data["promo"][0]->ID_PRODUKS);
		//$data["potongID"] = explode("-",$data["promo"][0]->ID_PRODUKS);
		$data['b_url'] = base_url();
        $promosi = $this->ModelPromosi->getDataWhere("hpromosi",Array("IDHPROMOSI" => $value));
        $data["detail"] = $promosi[0];
		$data["GambarPth"] = $promosi[0]->GAMBARPROMO;
		$disc = $this->ModelPromosi->getDataWhere("promosi",Array("IDHPROMOSI" => $value));
		$data["detaildisc"] = $disc[0];
        $this->load->view("HeaderMaster");
        $this->load->view("updateform/UpdateFormPromosi",$data);
    }
	
	function UpdatePromosi()
    {
        $fakta = $this->GetInputData();
		$config['upload_path']          = './Produk/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 0;
            $config['max_width']            = 4084;
            $config['max_height']           = 4084; 
            $config["file_name"]            = $fakta["Id"];
			$config["overwrite"]            = true;
            $this->load->library('upload', $config);
			$msg = array();
			if($this->upload->do_upload('userfile'))
			{
				array_push($msg,"Image Berhasil Di Upload");
			}
			else
			{
				array_push($msg,"Image Gagal Di upload : ".$this->upload->display_errors()." Silahkan Pergi Ke Update");
			}
			
		$value = Array("IDHPROMOSI"=>$fakta["Id"],"NAMA_PROMOSI"=>$fakta["Nama"],"TGL_MULAI_PROMOSI"=>$fakta["TglMulai"],"TGL_AKHIR_PROMOSI"=>$fakta["TglAkhir"],"STATUS"=>"Y","DESKRIPSI_PROMO"=>$fakta["Deskrip"],"GAMBARPROMO"=>$this->upload->data()["file_name"]);
        $this->ModelPromosi->UpdateData("hpromosi",$value,Array("IDHPROMOSI"=>$fakta["Id"]));
		
		$this->ModelPromosi->deleteData("promosi",array("IDHPROMOSI" => $fakta["Id"]));	
		foreach($fakta["Id_pro"] as $a)
		{
			$value2 = Array("ID_DPROMOSI"=>$this->getAutogenPromosi(),"ID_PRODUK"=>$a,"IDHPROMOSI"=>$fakta["Id"],"DISKON_PROMOSI"=>$fakta["Diskon"]);
			$this->ModelPromosi->Insert("promosi",$value2);
		}
	    $this->session->set_flashdata("item",$msg);
		redirect("MasterPromosi/ListPromosi");
    }
	
	function DeletePromosi($value)
    {
        $data = array("IDHPROMOSI" => $value);
		$this->ModelPromosi->deleteData("promosi",$data);
        $this->ModelPromosi->deleteData("hpromosi",$data);
		
		redirect("MasterPromosi/ListPromosi");
    }
}
?>