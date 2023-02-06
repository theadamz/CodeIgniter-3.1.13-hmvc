<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Info_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function get_test_data()
	{
		return $this->db->get('categories');
	}
}
