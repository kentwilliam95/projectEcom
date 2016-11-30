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
        $HasilVendor=$this->ModelPromosi->getData("promosi",null);
		$data["promosi"] = Array();
		$hasil=array();$temp = array();
		foreach($HasilVendor as $row)
		{
			$temp = Array($row->ID_PROMOSI,$row->ID_PRODUKS,$row->NAMA_PROMOSI,$row->TGL_MULAI_PROMOSI,$row->TGL_AKHIR_PROMOSI,$row->DISKON_PROMOSI,$row->STATUS_PROMOSI,$row->DESKRIPSI_PROMOSI,"<a href='".site_url('MasterPromosi/UpdateForm/'.$row->ID_PROMOSI)."'>Update</a>|<a href='".site_url('MasterPromosi/DeletePromosi/'.$row->ID_PROMOSI)."'>Delete</a>");
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
			$gabung = "";
			
			foreach($fakta["Id_pro"] as $a)
			{
				if($gabung == "")
				{
					$gabung = $gabung.$a;
				}
				else
				{
					$gabung = $gabung."-".$a;
				}
			}
			
            $value = Array("ID_PROMOSI"=>$fakta["Id"],"ID_PRODUKS"=>$gabung,"NAMA_PROMOSI"=>$fakta["Nama"],"TGL_MULAI_PROMOSI"=>$fakta["TglMulai"],"TGL_AKHIR_PROMOSI"=>$fakta["TglAkhir"],"DISKON_PROMOSI"=>$fakta["Diskon"],"STATUS_PROMOSI"=>1,"DESKRIPSI_PROMOSI"=>$fakta["Deskrip"]);
            $this->ModelPromosi->Insert("promosi",$value); 
			
            redirect("MasterPromosi/index");
      }
	
	function getAutogenProduk()
    {
        $nomor = $this->ModelPromosi->Autogen("SELECT (max(SUBSTRING(`ID_PROMOSI`,4))+1)as nomor from promosi")[0]->nomor;
        $Autogen = "PR".sprintf("%04d",$nomor);
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
		$data["gambar"] = array();
		$data["Autogen"] = $this->getAutogenProduk(); 
		$data["produkx"] = $this->ModelPromosi->getData("produk");
		$data["promo"] = $this->ModelPromosi->getData("promosi");
		
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
		
		//print_r($data["promo"][0]->ID_PRODUKS);
		$data["potongID"] = explode("-",$data["promo"][0]->ID_PRODUKS);
		$data['b_url'] = base_url();
        $promosi = $this->ModelPromosi->getDataWhere("promosi",Array("ID_PROMOSI" => $value));
        $data["detail"] = $promosi[0];
        $this->load->view("HeaderMaster");
        $this->load->view("updateform/UpdateFormPromosi",$data);
    }
	
	function UpdatePromosi()
    {
        $fakta = $this->GetInputData();
		$gabung = "";
			
		foreach($fakta["Id_pro"] as $a)
		{
			if($gabung == "")
			{
				$gabung = $gabung.$a;
			}
			else
			{
				$gabung = $gabung."-".$a;
			}
		}
			
       $value = Array("ID_PROMOSI"=>$fakta["Id"],"ID_PRODUKS"=>$gabung,"NAMA_PROMOSI"=>$fakta["Nama"],"TGL_MULAI_PROMOSI"=>$fakta["TglMulai"],"TGL_AKHIR_PROMOSI"=>$fakta["TglAkhir"],"DISKON_PROMOSI"=>$fakta["Diskon"],"DESKRIPSI_PROMOSI"=>$fakta["Deskrip"]);
       $this->ModelPromosi->UpdateData("promosi",$value,Array("ID_PROMOSI"=>$fakta["Id"]));
	   
	   redirect("MasterPromosi/ListPromosi");
    }
	
	function DeletePromosi($value)
    {
        $data = array("ID_PROMOSI" => $value);
        $this->ModelPromosi->deleteData("promosi",$data);
		
		redirect("MasterPromosi/ListPromosi");
    }
}
?>