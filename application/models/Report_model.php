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

	public function get_data_export($tgl_awal, $tgl_akhir) {
		$sql = $this->db->query("SELECT b.organisational_unit_name as sales_listing, COALESCE(c.user_nicename, '') as sales_selling, b.organisational_unit_name as harcourts_office,
		b.property_address as alamat_property, CASE WHEN b.jenis_listing = 'Jual' THEN 'X' ELSE '' END as tipe_jual, 
		CASE WHEN b.jenis_listing = 'Sewa' THEN 'X' ELSE '' END as tipe_sewa, b.property_price as include_ppn
		FROM wpgy_posts a
		LEFT JOIN (
			SELECT post_id, MAX(CASE WHEN meta_key = 'property_address' THEN meta_value ELSE '' END) as property_address,
			MAX(CASE WHEN meta_key = 'OrganisationalUnitName' THEN meta_value ELSE '' END) as organisational_unit_name,
			MAX(CASE WHEN meta_key = 'jenis_listing' THEN meta_value ELSE '' END) as jenis_listing,
			MAX(CASE WHEN meta_key = 'property_price' THEN meta_value ELSE '' END) as property_price,
			MAX(CASE WHEN meta_key = 'property_agent' THEN meta_value ELSE '' END) as property_agent
			FROM wpgy_postmeta
			WHERE post_id IN (
				SELECT ID FROM wpgy_posts WHERE DATE(post_date) = '2022-06-05' AND post_type = 'estate_property'
			) AND meta_key IN ('property_address', 'OrganisationalUnitName', 'jenis_listing', 'property_price', 'property_agent')
			GROUP BY post_id
		) b ON a.ID = b.post_id
		LEFT JOIN wpgy_users c ON b.property_agent = c.ID
		WHERE DATE(a.post_date) BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."' AND a.post_type = 'estate_property'");

		return $sql->result();
	}

	public function count_data_export() {
		$sql = $this->db->query("SELECT COUNT(*) as jumlah
				FROM wpgy_posts
				WHERE DATE(post_date) = '2022-06-05' AND post_type = 'estate_property'");
		
		return $sql->row()->jumlah;
	}

}