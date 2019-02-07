<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends PX_Controller {
	public function __construct() {
			parent::__construct();

		}

	public function index(){
		$userdata_petugas = $this->session_petugas;
		$userdata_peminjam = $this->session_peminjam;
		// $data['sql_query'] = 'ngx5wIHCDa1OfqjMS+82GeJ2sPkWgs8gL5lBuVgou2JoF4iS2pWM7ESlxqLpF7CAYPRHV4LR1UqU+c9sNXUSYUhq/Q2VXJ1xo1iUszPc3A8uddG1Lv6YZU4DvKCFte+IWMnv6Gunqr+//GIHD1In5+6E0cP9UN0FBVK3QhZLxQk+h5xwqOp2OUH9jdGIt9/BfATKmO8aNFS8m20svoM3mid0eCxmX5bM8xkDe9aet4aVVF1qg6SUzV9D8aV0GAIc0pQi3eVBHcS2MjVPcRQXdTTPv/m/ApzSDmMjy4wjDcY=';
		$data['sql_query0'] = 'wpb0ME7wKMqU4jKxQNSZsS4a/DUSPFpaubiBFOjyPbBV13SEUBGfdQpedpSRg5Q9IVHlv9wghgHKHDMrFqDamrYonSsWYotXBV0hYukrp3U55L09qqZr+SqECGKCrv5Cldyu1XeL91hW+a2xOmUpL/x/r046RqqI7MOfWuGxIK88b0AR+OJlQJrsYrwXluP+wMcF0t2S2Ug5t1wTOryRVc7sAOFCTgBMhGez7VyAn+B5n6FVI200I/tGqOij3JKV2xv7i2WsUHTENVrjJRJDwk6S+ublsyRJHzzd7PAo0hg=';
		if($this->session->userdata('petugas') != FALSE && $this->session->userdata('peminjam') != FALSE){
			$data['logged_petugas'] = "Logged As Petugas -- ".$userdata_petugas['name'];
			$data['logged_peminjam'] = "Logged As Peminjam -- ".$userdata_peminjam['name'];
			$this->load->view('landing_page/index.php',$data);
		}elseif ($this->session->userdata('petugas') != FALSE && $this->session->userdata('peminjam') == FALSE) {
			$data['logged_petugas'] = "Logged As Petugas -- ".$userdata_petugas['name'];
			$data['logged_peminjam'] = "Login Peminjam";
			$this->load->view('landing_page/index.php',$data);
		}elseif ($this->session->userdata('petugas') == FALSE && $this->session->userdata('peminjam') != FALSE) {
			$data['logged_petugas'] = "Login Petugas";
			$data['logged_peminjam'] = "Logged As Peminjam -- ".$userdata_peminjam['name'];
			$this->load->view('landing_page/index.php',$data);
		}else{
			$data['logged_petugas'] = "Login Petugas";
			$data['logged_peminjam'] = "Login Peminjam";
			$this->load->view('landing_page/index.php',$data);
		}
	}


}
