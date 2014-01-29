<?php

class Searchform extends CI_Controller
{

	const NB_LIEN_PAR_PAGE = 15;
	
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
			$this->ajax();	
		}
		
		
	}

	public function indexer()
	{
		//redirection vers mon mvc google
		redirect('http://localhost/google_tp/indexp.php');
	}

	public function accueil()
	{
		$this->load->library('pagination');
		$data = array();
		$nb_liens_total = $this->search_model->count();
		//$this->search_model->liste_url();
		//var_dump($data['url_result']);
		//	On inclut une vue
		//$this->load->view('info/vue_info', $data);
		//	Mise en place de la pagination
		/*$this->pagination->initialize(array('base_url' => base_url() . '/searchform/accueil/',
						    'total_rows' => $nb_liens_total,
						    'per_page' => self::NB_LIEN_PAR_PAGE)); 
		
		$data['pagination'] = $this->pagination->create_links();
		$data['nb_liens'] = $nb_liens_total;*/
	}

	public function ajax()
	{
		
			$search = $this->input->post('search');
			//var_dump($search);
			$data['url_result'] = $this->search_model->liste_url($search);
			//var_dump($data['url_result']);
			$url_result =  $data['url_result'];
			foreach ($url_result as $url) {
				$link = htmlentities($url->URL_url);// on recupere les commentaires
				$searchremplace = '<u>'.$search.'</u>';//on met le mot rechercher en $searchremplace
				$string = str_ireplace($search, $searchremplace, $link);//on remplace l'occurence par le $searchremplace
				//echo '<p>'.$url->URL_url.'</p><br/>';
				echo '<p>'.$string.'</p><br/>';
				echo '<hr />';
			}
	}
}