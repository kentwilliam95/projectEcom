<?php
class Report extends CI_Controller
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
        $data["labelnya"] = ["JAN","FEB","MAR","APR","MEI","JUN","JUL","AGUST","SEPT","OKT","NOV","DES"];
		$data["valuenya"] = [0,0,0,0,0,0,0,0,0,0,0,0];
		
		$bongkar_id = $this->Basic->getData("hjual");
		
		foreach($bongkar_id as $a)
		{
			for($i = 0; $i < 12; $i++)
			{
				if(substr($a->ID_HJUAL,2,2) == $i+1)
				{
					$data["valuenya"][$i] += $a->TOTAL; 
				}
			}
		}
		
		$data["judul"] = "Laporan Penjualan Per Bulan";
		$data["waktu"] = "Bulan";
        $this->load->view("HeaderMaster");
        $this->load->view("ReportView",$data);/**/
    }
	function harian()
	{
	
	}
	function bulanan()
	{
		$data["labelnya"] = ["JAN","FEB","MAR","APR","MEI","JUN","JUL","AGUST","SEPT","OKT","NOV","DES"];
		$data["valuenya"] = [0,0,0,0,0,0,0,0,0,0,0,0];
		
		$bongkar_id = $this->Basic->getData("hjual");
		
		foreach($bongkar_id as $a)
		{
			for($i = 0; $i < 12; $i++)
			{
				if(substr($a->ID_HJUAL,2,2) == $i+1)
				{
					$data["valuenya"][$i] += $a->TOTAL; 
				}
			}
		}
		
		$data["judul"] = "Laporan Penjualan Per Bulan";
		$data["waktu"] = "Bulan";
        $this->load->view("HeaderMaster");
        $this->load->view("ReportView",$data);/**/
	}
	function tahunan()
	{
		$data["labelalphanya"] = array();
		$data["labelnya"] = array();
		$data["valuenya"] = [0,0,0,0,0];
		$max = 0;
		
		$bongkar_id = $this->Basic->getData("hjual");
		
		foreach($bongkar_id as $carimax)
		{
			if(substr($carimax->ID_HJUAL,4,2) > $max)
			{
				$max = substr($carimax->ID_HJUAL,4,2);
			}
		}
		
		
		for($j = 4; $j >= 0; $j--)
		{
			array_push($data["labelalphanya"],$max-$j);	
		}
		
		foreach($bongkar_id as $a)
		{
			$temp = "";
			for($i = $max-4; $i < $max+1; $i++)
			{
				if(substr($a->ID_HJUAL,4,2) == $i)
				{
					for($h = 0; $h < 5; $h++)
					{
						if($data["labelalphanya"][$h] == $i)
						{
							$temp = $h;
						}
					}
					$data["valuenya"][$temp] += $a->TOTAL; 
				}
			}
		}

		foreach($data["labelalphanya"] as $u)
		{
			array_push($data["labelnya"],"20".$u);	
		}
		
		$data["judul"] = "Laporan Selama 5 Tahun Terakhir";
		$data["waktu"] = "Tahun";
        $this->load->view("HeaderMaster");
        $this->load->view("ReportView",$data);/**/
	}
}
?>