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

	public function get_data_grosscom($tgl_awal, $tgl_akhir, $limit, $offset){
		$sql = $this->db->query("SELECT c.user_nicename as sales_consultant, b.organisational_unit_name as harcourts,
								CASE WHEN b.jenis_listing = 'Jual' THEN b.property_price ELSE '' END as grosscom_jual, 
								CASE WHEN b.jenis_listing = 'Sewa' THEN b.property_price ELSE '' END as grosscom_sewa,
								b.property_price as total
								FROM ( SELECT ID
									FROM wpgy_posts
									WHERE DATE(post_date) BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."' AND post_type = 'estate_property'
								) a
								LEFT JOIN (
									SELECT post_id, MAX(CASE WHEN meta_key = 'property_address' THEN meta_value ELSE '' END) as property_address,
									MAX(CASE WHEN meta_key = 'OrganisationalUnitName' THEN meta_value ELSE '' END) as organisational_unit_name,
									MAX(CASE WHEN meta_key = 'jenis_listing' THEN meta_value ELSE '' END) as jenis_listing,
									MAX(CASE WHEN meta_key = 'property_price' THEN meta_value ELSE '' END) as property_price,
									MAX(CASE WHEN meta_key = 'property_agent' THEN meta_value ELSE '' END) as property_agent
									FROM wpgy_postmeta
									WHERE post_id IN (
										SELECT ID FROM wpgy_posts WHERE DATE(post_date) BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."' AND post_type = 'estate_property'
									) AND meta_key IN ('property_address', 'OrganisationalUnitName', 'jenis_listing', 'property_price', 'property_agent')
									GROUP BY post_id
								) b ON a.ID = b.post_id
								LEFT JOIN wpgy_users c ON b.property_agent = c.ID
								WHERE c.user_nicename IS NOT NULL OR c.user_nicename <> ''
						ORDER BY c.user_nicename
						LIMIT $limit OFFSET $offset");

		return $sql->result();
	}

    public function get_count_data_grosscom($tgl_awal, $tgl_akhir){
		$sql = $this->db->query("SELECT COUNT(*) as jumlah
								FROM (
									SELECT post_id, meta_value as property_agent
									FROM wpgy_postmeta
									WHERE post_id IN (
										SELECT ID FROM wpgy_posts WHERE DATE(post_date) BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."' AND post_type = 'estate_property'
									) AND meta_key = 'property_agent'
									GROUP BY post_id
								) b
								LEFT JOIN wpgy_users c ON b.property_agent = c.ID
								WHERE c.user_nicename IS NOT NULL OR c.user_nicename <> ''");
		
		return $sql->row();
	}

	public function get_data_total_unit($tgl_awal, $tgl_akhir, $limit, $offset){
		$sql = $this->db->query("SELECT COALESCE(c.user_nicename, '') as sales_consultant, b.organisational_unit_name as harcourts,
								SUM(CASE WHEN b.jenis_listing = 'Jual' THEN 1 ELSE 0 END) as unit_jual, 
								SUM(CASE WHEN b.jenis_listing = 'Sewa' THEN 1 ELSE 0 END) as unit_sewa,
								COUNT(b.jenis_listing) as total
								FROM (
									SELECT post_id,
									MAX(CASE WHEN meta_key = 'OrganisationalUnitName' THEN meta_value ELSE '' END) as organisational_unit_name,
									MAX(CASE WHEN meta_key = 'jenis_listing' THEN meta_value ELSE '' END) as jenis_listing,
									MAX(CASE WHEN meta_key = 'property_agent' THEN meta_value ELSE '' END) as property_agent
									FROM wpgy_postmeta
									WHERE post_id IN (
										SELECT ID FROM wpgy_posts WHERE DATE(post_date) BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."' AND post_type = 'estate_property'
									) AND meta_key IN ('OrganisationalUnitName', 'jenis_listing', 'property_agent')
									GROUP BY post_id
								) b
								LEFT JOIN wpgy_users c ON b.property_agent = c.ID
								WHERE c.user_nicename IS NOT NULL OR c.user_nicename <> ''
						GROUP BY 1, 2
						ORDER BY 1
						LIMIT $limit OFFSET $offset");

		return $sql->result();
	}

    public function get_count_data_total_unit($tgl_awal, $tgl_akhir){
		$sql = $this->db->query("SELECT COUNT(*) as jumlah
								FROM (
									SELECT COALESCE(c.user_nicename, '') as sales_consultant, b.organisational_unit_name as harcourts,
									SUM(CASE WHEN b.jenis_listing = 'Jual' THEN 1 ELSE 0 END) as unit_jual, 
									SUM(CASE WHEN b.jenis_listing = 'Sewa' THEN 1 ELSE 0 END) as unit_sewa
									FROM (
										SELECT post_id,
										MAX(CASE WHEN meta_key = 'OrganisationalUnitName' THEN meta_value ELSE '' END) as organisational_unit_name,
										MAX(CASE WHEN meta_key = 'jenis_listing' THEN meta_value ELSE '' END) as jenis_listing,
										MAX(CASE WHEN meta_key = 'property_agent' THEN meta_value ELSE '' END) as property_agent
										FROM wpgy_postmeta
										WHERE post_id IN (
											SELECT ID FROM wpgy_posts WHERE DATE(post_date) BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."' AND post_type = 'estate_property'
										) AND meta_key IN ('OrganisationalUnitName', 'jenis_listing', 'property_agent')
										GROUP BY post_id
									) b
									LEFT JOIN wpgy_users c ON b.property_agent = c.ID
									WHERE c.user_nicename IS NOT NULL OR c.user_nicename <> ''
							GROUP BY 1, 2
								) xx1");
		
		return $sql->row();
	}

	public function get_data_ina_office_revenue($tgl_awal, $tgl_akhir, $limit, $offset){
		$sql = $this->db->query("SELECT DISTINCT b.organisational_unit_name as harcourts
								FROM (
									SELECT post_id,
									MAX(CASE WHEN meta_key = 'OrganisationalUnitName' THEN meta_value ELSE '' END) as organisational_unit_name
									FROM wpgy_postmeta
									WHERE post_id IN (
										SELECT ID FROM wpgy_posts WHERE DATE(post_date) BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."' AND post_type = 'estate_property'
									) AND meta_key = 'OrganisationalUnitName'
									GROUP BY post_id
								) b
						ORDER BY 1
						LIMIT $limit OFFSET $offset");

		return $sql->result();
	}

    public function get_count_ina_office_revenue($tgl_awal, $tgl_akhir){
		$sql = $this->db->query("SELECT COUNT(*) as jumlah
								FROM (
									SELECT DISTINCT b.organisational_unit_name as harcourts
									FROM (
										SELECT post_id,
										MAX(CASE WHEN meta_key = 'OrganisationalUnitName' THEN meta_value ELSE '' END) as organisational_unit_name
										FROM wpgy_postmeta
										WHERE post_id IN (
											SELECT ID FROM wpgy_posts WHERE DATE(post_date) BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."' AND post_type = 'estate_property'
										) AND meta_key = 'OrganisationalUnitName'
										GROUP BY post_id
									) b
								) xx1");
		
		return $sql->row();
	}

	public function get_data_ina_sales_consultant($tgl_awal, $tgl_akhir, $limit, $offset){
		$sql = $this->db->query("SELECT COALESCE(c.user_nicename, '') as sales_consultant, b.organisational_unit_name as harcourts
								FROM (
									SELECT post_id,
									MAX(CASE WHEN meta_key = 'OrganisationalUnitName' THEN meta_value ELSE '' END) as organisational_unit_name,
									MAX(CASE WHEN meta_key = 'property_agent' THEN meta_value ELSE '' END) as property_agent
									FROM wpgy_postmeta
									WHERE post_id IN (
										SELECT ID FROM wpgy_posts WHERE DATE(post_date) BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."' AND post_type = 'estate_property'
									) AND meta_key IN ('OrganisationalUnitName', 'property_agent')
									GROUP BY post_id
								) b
								LEFT JOIN wpgy_users c ON b.property_agent = c.ID
								WHERE c.user_nicename IS NOT NULL OR c.user_nicename <> ''
						GROUP BY 1, 2
						ORDER BY 1
						LIMIT $limit OFFSET $offset");

		return $sql->result();
	}

    public function get_count_ina_sales_consultant($tgl_awal, $tgl_akhir){
		$sql = $this->db->query("SELECT COUNT(*) as jumlah
								FROM (
									SELECT COALESCE(c.user_nicename, '') as sales_consultant, b.organisational_unit_name as harcourts
											FROM (
												SELECT post_id,
												MAX(CASE WHEN meta_key = 'OrganisationalUnitName' THEN meta_value ELSE '' END) as organisational_unit_name,
												MAX(CASE WHEN meta_key = 'property_agent' THEN meta_value ELSE '' END) as property_agent
												FROM wpgy_postmeta
												WHERE post_id IN (
													SELECT ID FROM wpgy_posts WHERE DATE(post_date) BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."' AND post_type = 'estate_property'
												) AND meta_key IN ('OrganisationalUnitName', 'property_agent')
												GROUP BY post_id
											) b
											LEFT JOIN wpgy_users c ON b.property_agent = c.ID
											WHERE c.user_nicename IS NOT NULL OR c.user_nicename <> ''
									GROUP BY 1, 2
								) xx1");
		
		return $sql->row();
	}

	public function get_data_ina_principal_report($tgl_awal, $tgl_akhir, $limit, $offset){
		$sql = $this->db->query("SELECT DISTINCT b.organisational_unit_name as harcourts
								FROM (
									SELECT post_id,
									MAX(CASE WHEN meta_key = 'OrganisationalUnitName' THEN meta_value ELSE '' END) as organisational_unit_name
									FROM wpgy_postmeta
									WHERE post_id IN (
										SELECT ID FROM wpgy_posts WHERE DATE(post_date) BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."' AND post_type = 'estate_property'
									) AND meta_key = 'OrganisationalUnitName'
									GROUP BY post_id
								) b
						ORDER BY 1
						LIMIT $limit OFFSET $offset");

		return $sql->result();
	}

    public function get_count_ina_principal_report($tgl_awal, $tgl_akhir){
		$sql = $this->db->query("SELECT COUNT(*) as jumlah
								FROM (
									SELECT DISTINCT b.organisational_unit_name as harcourts
									FROM (
										SELECT post_id,
										MAX(CASE WHEN meta_key = 'OrganisationalUnitName' THEN meta_value ELSE '' END) as organisational_unit_name
										FROM wpgy_postmeta
										WHERE post_id IN (
											SELECT ID FROM wpgy_posts WHERE DATE(post_date) BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."' AND post_type = 'estate_property'
										) AND meta_key = 'OrganisationalUnitName'
										GROUP BY post_id
									) b
								) xx1");
		
		return $sql->row();
	}

}