<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_model extends CI_Model
{
	protected $table = 'url';

	public function liste_url($search/*, $nb*/)
	{

		if(!is_string($search) || empty($search) /*|| !is_int($nb)*/ )
		{
			return false;
		}

		return $this->db->select('URL_url')
			->from($this->table)
			//->where('URL_url')
			->like('URL_url', $search)
			->order_by('idURL')
			//->limit($nb)
			->get()
			->result();
			//$rowcount = $query->num_rows();


	}

	public function count(){
		
		return $this->db->count_all($this->table);//count des commentaires
	}

}