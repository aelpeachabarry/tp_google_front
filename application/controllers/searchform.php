<?php

class Searchform extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		//appel du helper site_url
		$this->load->helper('url');
		$this->load->model('search_model');
		$this->load->library('form_validation');
	}

	public function index()
    {
        $this->recherche();
    }

	public function recherche()
	{
		//	Le formulaire est invalide ou vide
		$this->load->view('connexion/form');
		$this->form_validation->set_rules('search',  '"recherche"',  'trim|min_length[2]');
		if($this->form_validation->run())
		{
			//	Nous disposons d'un pseudo et d'un commentaire sous une bonne forme
			
			//	Sauvegarde du commentaire dans la base de données
			$search = $this->input->post('search');
			//var_dump($search);
			$this->search_model->liste_url($search);
	
		}
		
	}

	public function indexer()
	{
		//redirection vers mon mvc google
		redirect('http://localhost/google_tp/indexp.php');
	}

	public function accueil()
	{
		$this->search_model->liste_url();
		//var_dump($data['url_result']);
		//	On inclut une vue
		//$this->load->view('info/vue_info', $data);
	}
}