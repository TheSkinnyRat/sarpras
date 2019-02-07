<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class PX_Model extends CI_Model {

    function __construct() {
        parent::__construct();
		// DEFAULT TIME ZONE
		date_default_timezone_set('Asia/Jakarta');
		// TABLE 
		$this->tbl_prefix = 'px_';
		$this->tbl_adm_config = $this->tbl_prefix.'adm_config';
		$this->tbl_logs = $this->tbl_prefix.'logs';
		$this->tbl_master_data = $this->tbl_prefix.'master_data';
		$this->tbl_menu = $this->tbl_prefix.'menu';
		$this->tbl_settings = $this->tbl_prefix.'settings';
		$this->tbl_user = $this->tbl_prefix.'user';
		$this->tbl_useraccess = $this->tbl_prefix.'useraccess';
		$this->tbl_usergroup = $this->tbl_prefix.'usergroup';
		$this->tbl_galeri = $this->tbl_prefix.'galeri';
		$this->tbl_galeri_content = $this->tbl_prefix.'galeri_content';
    }
}
