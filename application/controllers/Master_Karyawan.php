<?php
class Master_Karyawan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->helper("form");
        $this->load->model("ModelKaryawan");
        header('Access-Control-Allow-Origin: *');
    }

	function index()
	{
		$data["Autogen"] = $this->getAutogenProduk(); 
		$this->load->view("HeaderMaster");
        $this->load->view("MasterKaryawan",$data);
	}
	
	function ListKaryawan()
    {
        $HasilVendor=$this->ModelKaryawan->getData("pegawai",null);
		$data["karyawan"] = Array();
		$hasil=array();$temp = array();
		foreach($HasilVendor as $row)
		{
			$temp = Array($row->ID_PEGAWAI,$row->NAMA_PEGAWAI,$row->PASSWORD,$row->TANGGAL_LAHIR,$row->JENIS_KELAMIN,$row->PRIVILAGE,"<a href='".site_url('Master_Karyawan/UpdateForm/'.$row->ID_PEGAWAI)."'>Update</a>|<a href='".site_url('Master_Karyawan/DeletePegawai/'.$row->ID_PEGAWAI)."'>Delete</a>");
			Array_push($hasil,$temp);
			$temp = Array();
		}
		$data["karyawan"] = json_encode($hasil);
		
        $this->load->view("HeaderMaster");
        $this->load->view("listkaryawan",$data);
    }
	
	 public function do_upload()
     {
			$fakta = $this->GetInputData();

            $value = Array("ID_PEGAWAI"=>$fakta["Id"],"NAMA_PEGAWAI"=>$fakta["Nama"],"PASSWORD"=>$fakta["Pass"],"TANGGAL_LAHIR"=>$fakta["TglLahir"],"JENIS_KELAMIN"=>$fakta["Kelamin"],"PRIVILAGE"=>$fakta["Privilage"]);
            $this->ModelKaryawan->Insert("pegawai",$value); 
			
            redirect("Master_Karyawan/index");
      }
	
	function getAutogenProduk()
    {
        $nomor = $this->ModelKaryawan->Autogen("SELECT (max(SUBSTRING(`ID_PEGAWAI`,4))+1)as nomor from pegawai")[0]->nomor;
        $Autogen = "P".sprintf("%04d",$nomor);
        return $Autogen;
    }
	
	function GetInputData()
      {
          $bahan["Id"] = $this->input->post("Idh",true);
          $bahan["Nama"] = $this->input->post("Nama",true);
		  $bahan["Pass"] = $this->input->post("Password",true);
          $bahan["TglLahir"] = $this->input->post("TglLahir",true);
          $bahan["Kelamin"] = $this->input->post("gender",true);
		  $bahan["Privilage"] = $this->input->post("Privilage",true);
          return $bahan;
      }
	  
	function UpdateForm($value)
    {
        $pegawai = $this->ModelKaryawan->getDataWhere("pegawai",Array("ID_PEGAWAI" => $value));
        $data["detail"] = $pegawai[0];
        $this->load->view("HeaderMaster");
        $this->load->view("updateform/UpdateFormKaryawan",$data);
    }
	
	function UpdatePegawai()
    {
       $fakta = $this->GetInputData();
     
       $value = Array("ID_PEGAWAI"=>$fakta["Id"],"NAMA_PEGAWAI"=>$fakta["Nama"],"PASSWORD"=>$fakta["Pass"],"TANGGAL_LAHIR"=>$fakta["TglLahir"],"JENIS_KELAMIN"=>$fakta["Kelamin"],"PRIVILAGE"=>$fakta["Privilage"]);
       $this->ModelKaryawan->UpdateData("pegawai",$value,Array("ID_PEGAWAI"=>$fakta["Id"]));
	   
	   redirect("Master_Karyawan/ListKaryawan");
    }
	
	function DeletePegawai($value)
    {
        $data = array("ID_PEGAWAI" => $value);
        $this->ModelKaryawan->deleteData("pegawai",$data);
		
		redirect("Master_Karyawan/ListKaryawan");
    }
}
?>