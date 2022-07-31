<?php 

class Report_model extends CI_Model {

	public function get_data($limit, $offset){
        $this->db->limit($limit, $offset);
		$sql = $this->db->get('wpgy_posts');
		return $sql->result();
	}

    public function get_count_data(){
        $this->db->select("COUNT(*) as jumlah", FALSE);
		$sql = $this->db->get('wpgy_posts');
		return $sql->row();
	}

}