<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Info_model extends CI_Model
{
	protected $table = 'news';
	
	/**
	 *	Ajoute une news
	 *
	 *	@param string $auteur 	L'auteur de la news
	 *	@param string $titre 	Le titre de la news
	 *	@param string $contenu 	Le contenu de la news
	 *	@return bool		Le résultat de la requête
	 *
	 */
	public function ajouter_news($auteur, $titre, $contenu)
	{
		

		return $this->db->set('auteur',	 $auteur)
			->set('titre', 	 $titre)
			->set('contenu', $contenu)
			->set('date_ajout', 'NOW()', false)//pas echappé
			->set('date_modif', 'NOW()', false)//pas echappé
			->insert($this->table);
	}
	
	/**
	 *	Édite une news déjà existante
	 *
	 *	@param integer $id	L'id de la news à modifier
 	 *	@param string  $titre 	Le titre de la news
     *	@param string  $contenu Le contenu de la news
     *	@return bool		Le résultat de la requête
	 */
	public function editer_news()
	{
			//	Il n'y a rien à éditer
		if($titre == null AND $contenu == null)
		{
			return false;
		}
		
		//	Ces données seront échappées
		if($titre != null)
		{
			$this->db->set('titre', $titre);
		}
		if($contenu != null)
		{
			$this->db->set('contenu', $contenu);
		}
		
		//	Ces données ne seront pas échappées
		$this->db->set('date_modif', 'NOW()', false);
		
		//	La condition
		$this->db->where('id', (int) $id);
		
		return $this->db->update($this->table);
	}
	
	/**
	 *	Supprime une news
	 */
	public function supprimer_news()
	{
		return $this->db->where('id', (int) $id)
            ->delete($this->table);
	}
	
	/**
	 *	Retourne le nombre de news
	 */
	public function count($where = array())
	{
		return (int) $this->db->where($where)
			      ->count_all_results($this->table);
	}
	
	/**
	 *	Retourne une liste de news
	 */
	public function liste_news($nb = 10, $debut = 0)
	{
		return $this->db->select('*')
			->from($this->table)
			->limit($nb, $debut)
			->order_by('id', 'asc')
			->get()
			->result();
	}
}


/* End of file news_model.php */
/* Location: ./application/models/news_model.php */