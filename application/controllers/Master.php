<?php
class Master extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->helper("form");
        $this->load->model("Basic");
        header('Access-Control-Allow-Origin: *');
    }
    function index()
    {
        $data["msg"] = Array();
        if(!is_null($this->session->flashdata("item")))
        {
            $data["msg"]=$this->session->flashdata("item");
        }
		$data["JenisProduk"] = $this->Basic->query("select distinct(jenis_produk) from rincian_produk");
		
		$data["KategoriProduk"] = $this->Basic->query("select distinct(KATEGORI_PRODUK) from rincian_produk");
		
        $data["Autogen"] = $this->getAutogenProduk(); 
        $this->load->view("HeaderMaster");
        $this->load->view("MasterProduk",$data);
    }
    
    function ListProduk()
    {
        $HasilVendor=$this->Basic->getData("produk",null);
		$data["produk"] = Array();
		$hasil=array();$temp = array();
		foreach($HasilVendor as $row)
		{
			$temp = Array($row->ID_PRODUK,$row->NAMA_PRODUK,$row->HARGA_JUAL,$row->MEREK_PRODUK,$row->STOK,"<a href='".site_url('master/UpdateForm/'.$row->ID_PRODUK)."'>Update</a>|<a href='".site_url('master/DeleteProduk/'.$row->ID_PRODUK)."'>Delete</a>");
			Array_push($hasil,$temp);
			$temp = Array();
		}
		$data["produk"] = json_encode($hasil);
		
        $this->load->view("HeaderMaster");
        $this->load->view("listproduk",$data);
    }
    function DeleteProduk($value)
    {
        $data = array("ID_PRODUK" => $value);
        $this->Basic->deleteData("Produk",$data);
    }
    function UpdateForm($value)
    {
        $data["msg"] = Array();
        if(!is_null($this->session->flashdata("item")))
        {
            $data["msg"]=$this->session->flashdata("item");
        }
        $data["path"] = $this->Basic->getDataWhere_array("gambar",Array("ID_PRODUK"=>$value));
        while(count($data["path"]) < 3)
        {
            array_push($data["path"],Array("ID_GAMBAR"=>'',"NAMA_GAMBAR"=>"Missing.png"));
        }
        $produk = $this->Basic->getDataWhere("produk",Array("ID_PRODUK" => $value));
        $data["detail"] = $produk[0];
        $this->load->view("HeaderMaster");
        $this->load->view("updateform/UpdateForm",$data);
    }
    function UpdateProduk()
    {
       $fakta = $this->GetInputData();
      
       $msg = Array();
       $arrGambar = Array($_FILES['userfile1']['name'],$_FILES['userfile2']['name'],$_FILES['userfile3']['name']);
       $userfiles=Array("userfile1","userfile2","userfile3");

       $value = Array("NAMA_PRODUK"=>$fakta["Nama"],"HARGA_JUAL"=>$fakta["Harga"],"MEREK_PRODUK"=>$fakta["Merek"],"STOK"=>$fakta["Stok"],"KETERANGAN"=>$fakta["Keterangan"]);
       $this->Basic->UpdateData("produk",$value,Array("ID_PRODUK"=>$fakta["Id"]));
       array_push($msg,"Data Berhasil di Update .");
	   
       for($i=0; $i<count($arrGambar); $i++)
        {
            $this->load->library('upload', $this->getConfig($fakta["Id"]));
            if($arrGambar[$i] !="")
            {
                if(!$this->upload->do_upload($userfiles[$i]))
                {
                    array_push($msg,"Gambar ".$i." Gagal Upload");
                }
                else
                {
                    if($fakta["Idg".$i] != "")
                    {
                          array_push($msg,"Gambar ".$i." Berhasil Update Gambar");
                          $gambarData = Array("NAMA_GAMBAR"=>$this->upload->data()["file_name"]);
                          echo $this->upload->data()["file_name"]."<br>";
                          echo $fakta["Idg".$i]."<br>";
                          $this->Basic->UpdateData("gambar",$gambarData,Array("ID_GAMBAR"=>$fakta["Idg".$i]));
                    }
                    else
                    {
                          array_push($msg,"Gambar ".$i." Berhasil Insert");
                          $gambarData = Array("ID_PRODUK"=>$fakta["Id"],"NAMA_GAMBAR"=>$this->upload->data()["file_name"]);
                          $this->Basic->Insert("gambar",$gambarData);
                    }
                   
                   
                }
            }
        }
        
       $this->session->set_flashdata("item",$msg);
       print(strpos($msg[1],"Gagal"));
       redirect("Master/UpdateForm/".$fakta["Id"]);
      // print_r($fakta);
    }
    function getAutogenProduk()
    {
        $nomor = $this->Basic->Autogen("SELECT (max(SUBSTRING(`ID_PRODUK`,4))+1)as nomor from produk")[0]->nomor;
        $Autogen = "PRO".sprintf("%04d",$nomor);
        return $Autogen;
    }
	function getAutogenRincian()
    {
        $nomor = $this->Basic->Autogen("SELECT (max(SUBSTRING(`ID_RINCIAN`,4))+1)as nomor from rincian_produk")[0]->nomor;
        $Autogen = "RIN".sprintf("%04d",$nomor);
        return $Autogen;
    }
    public function do_upload()
     {
           $fakta = $this->GetInputData();
            
            $arrGambar = Array($_FILES['userfile']['name'],$_FILES['userfile1']['name'],$_FILES['userfile2']['name']);
            $userfiles=Array("userfile","userfile1","userfile2");

            $msg = Array();
            
            $value = Array("ID_PRODUK"=>$fakta["Id"],"NAMA_PRODUK"=>$fakta["Nama"],"HARGA_JUAL"=>$fakta["Harga"],"MEREK_PRODUK"=>$fakta["Merek"],"STOK"=>$fakta["Stok"],"KETERANGAN"=>$fakta["Keterangan"]);
            $this->Basic->Insert("Produk",$value); 
			
			$autoGenRincian = $this->getAutogenRincian();
			$valrincian = Array("ID_RINCIAN"=>$autoGenRincian,"ID_PRODUK"=>$fakta["Id"],"JENIS_PRODUK"=>$fakta["jenis"],"KATEGORI_PRODUK"=>$fakta["kategori"]);
			
			$this->Basic->insert("rincian_produk",$valrincian);
            for($i=0; $i<count($arrGambar); $i++)
            {
                $this->load->library('upload', $this->getConfig($Id));
                if($arrGambar[$i] !="")
                {
                    if(!$this->upload->do_upload($userfiles[$i]))
                    {
                        array_push($msg,"Gambar ".$i." Gagal Upload");
                    }
                    else
                    {
                         array_push($msg,"Gambar ".$i." Berhasil Upload");
                         $gambarData = Array("ID_PRODUK"=>$fakta["Id"],"NAMA_GAMBAR"=>$this->upload->data()["file_name"]);
                         $this->Basic->insert("gambar",$gambarData);
                    }
                }
            }
            $this->session->set_flashdata("item",$msg);
            redirect("Master/index");
      }
      function getConfig($Id)
      {
            $config['upload_path']          = './Produk/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 0;
            $config['max_width']            = 2048;
            $config['max_height']           = 2048; 
            $config["file_name"]            = $Id;
            return $config;
      }
      function GetInputData()
      {
          $bahan["Id"] = $this->input->post("Idh",true);
          $bahan["Nama"] = $this->input->post("Nama",true);
          $bahan["Harga"] = $this->input->post("Harga",true);
          $bahan["Stok"] = $this->input->post("Stok",true);
          $bahan["Merek"] = $this->input->post("Merek",true);
          $bahan["Keterangan"] = $this->input->post("Detail",true);
          $bahan["Idg0"] = $this->input->post("Idg0",true);
          $bahan["Idg1"] = $this->input->post("Idg1",true);
          $bahan["Idg2"] = $this->input->post("Idg2",true);
		  $bahan["kategori"] = $this->input->post("kategori",true);
		  $bahan["jenis"] = $this->input->post("jenis",true);
          return $bahan;
      }
}
?>