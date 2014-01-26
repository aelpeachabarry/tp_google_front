<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_model extends CI_Model
{
	protected $table = 'website';

	public function liste_url($search)
	{
		return $this->db->select('WEB_url')
			->from($this->table)
			->where('WEB_url')
			->like('%$search%')
			->order_by('WEB_id')
			->get()
			->result();
	}

}