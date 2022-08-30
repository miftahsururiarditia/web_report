<?php 

class Report_model extends CI_Model {

	private function query_all_report($tgl_awal, $tgl_akhir, $user_role, $user_id, $user_name){
		$add_join = "";
		$filter = "";
		if ($user_role == '2') {
			$add_join = " LEFT JOIN wpgy_posts d ON c.user_nicename = d.post_name ";
			$filter = " AND d.post_author = $user_id";
		} else if ($user_role == '3') {
			$filter = " AND c.ID = $user_id";
		}

		$query = "SELECT a.post_id, a.post_author, a.organisational_unit_name as sales_listing, COALESCE(c.user_nicename, '') as sales_selling, a.organisational_unit_name as harcourts_office,
					a.property_address as alamat_property, CASE WHEN a.jenis_listing = 'Jual' THEN 'X' ELSE '' END as tipe_jual, 
					CASE WHEN a.jenis_listing = 'Sewa' THEN 'X' ELSE '' END as tipe_sewa, a.property_price as include_ppn, a.property_agent
					FROM (
						SELECT post_id, MAX(CASE WHEN meta_key = 'property_address' THEN meta_value ELSE '' END) as property_address,
						MAX(CASE WHEN meta_key = 'OrganisationalUnitName' THEN meta_value ELSE '' END) as organisational_unit_name,
						MAX(CASE WHEN meta_key = 'jenis_listing' THEN meta_value ELSE '' END) as jenis_listing,
						MAX(CASE WHEN meta_key = 'property_price' THEN meta_value ELSE '' END) as property_price,
						MAX(CASE WHEN meta_key = 'property_agent' THEN meta_value ELSE '' END) as property_agent,
						MAX(CASE WHEN meta_key = 'original_author' THEN meta_value ELSE '' END) as post_author
						FROM wpgy_postmeta
						WHERE post_id IN (
							SELECT ID FROM wpgy_posts WHERE DATE(post_date) BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."' AND post_type = 'estate_property'
						) AND meta_key IN ('property_address', 'OrganisationalUnitName', 'jenis_listing', 'property_price', 'property_agent', 'original_author')
						GROUP BY post_id
					) a
					INNER JOIN wpgy_term_relationships b ON a.post_id = b.object_id
                    LEFT JOIN wpgy_users c ON a.post_author = c.ID
					$add_join
					WHERE b.term_taxonomy_id IN (73, 74) $filter";
		return $query;
	}

	public function get_all_report_data($tgl_awal, $tgl_akhir, $is_export = FALSE, $user_role, $user_id, $user_name, $limit = 10, $offset = 0){
		$sql = $this->query_all_report($tgl_awal, $tgl_akhir, $user_role, $user_id, $user_name);

		if (!$is_export) {
			$sql .= " LIMIT $limit OFFSET $offset";
		}
		$res = $this->db->query($sql);
		return $res->result();
	}

    public function get_count_all_report_data($tgl_awal, $tgl_akhir, $user_role, $user_id, $user_name){
		$all_report = $this->query_all_report($tgl_awal, $tgl_akhir, $user_role, $user_id, $user_name);
        $this->db->select("COUNT(*) as jumlah", FALSE);
		$sql = "SELECT COUNT(*) as jumlah
				FROM (".$all_report.") xx1";
		$res = $this->db->query($sql);

		return $res->row()->jumlah;
	}

	private function query_grosscom($tgl_awal, $tgl_akhir, $user_role, $user_id, $user_name) {
		$add_join = "";
		$filter = "";
		if ($user_role == '2') {
			$add_join = " LEFT JOIN wpgy_posts d ON c.user_nicename = d.post_name ";
			$filter = " AND d.post_author = $user_id";
		} else if ($user_role == '3') {
			$filter = " AND c.ID = $user_id";
		}

		$query = "SELECT c.user_nicename as sales_consultant, a.organisational_unit_name as harcourts,
					CASE WHEN a.jenis_listing = 'Jual' THEN a.property_price ELSE '' END as grosscom_jual, 
					CASE WHEN a.jenis_listing = 'Sewa' THEN a.property_price ELSE '' END as grosscom_sewa,
					a.property_price as total, a.property_agent
					FROM (
						SELECT post_id, MAX(CASE WHEN meta_key = 'property_address' THEN meta_value ELSE '' END) as property_address,
						MAX(CASE WHEN meta_key = 'OrganisationalUnitName' THEN meta_value ELSE '' END) as organisational_unit_name,
						MAX(CASE WHEN meta_key = 'jenis_listing' THEN meta_value ELSE '' END) as jenis_listing,
						MAX(CASE WHEN meta_key = 'property_price' THEN meta_value ELSE '' END) as property_price,
						MAX(CASE WHEN meta_key = 'property_agent' THEN meta_value ELSE '' END) as property_agent,
						MAX(CASE WHEN meta_key = 'original_author' THEN meta_value ELSE '' END) as post_author
						FROM wpgy_postmeta
							WHERE post_id IN (
								SELECT ID FROM wpgy_posts WHERE DATE(post_date) BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."' AND post_type = 'estate_property'
							) AND meta_key IN ('property_address', 'OrganisationalUnitName', 'jenis_listing', 'property_price', 'property_agent', 'original_author')
							GROUP BY post_id
						) a
						INNER JOIN wpgy_term_relationships b ON a.post_id = b.object_id
						LEFT JOIN wpgy_users c ON a.post_author = c.ID
						$add_join
						WHERE b.term_taxonomy_id IN (73, 74) $filter
						ORDER BY CASE WHEN c.user_nicename IS NOT NULL OR c.user_nicename <> '' THEN 1 ELSE 2 END";
		return $query;
	}

	public function get_data_grosscom($tgl_awal, $tgl_akhir, $is_export = FALSE, $user_role, $user_id, $user_name, $limit = 10, $offset = 0){
		$sql = $this->query_grosscom($tgl_awal, $tgl_akhir, $user_role, $user_id, $user_name);
		if (!$is_export) {
			$sql .= "
					LIMIT $limit OFFSET $offset";
		}

		$res = $this->db->query($sql);

		return $res->result();
	}

    public function get_count_data_grosscom($tgl_awal, $tgl_akhir, $user_role, $user_id, $user_name){
		$grosscom = $this->query_grosscom($tgl_awal, $tgl_akhir, $user_role, $user_id, $user_name);
		$sql = $this->db->query("SELECT COUNT(*) as jumlah
								FROM (
									$grosscom
								) xx1");
		
		return $sql->row()->jumlah;
	}

	private function query_total_unit($tgl_awal, $tgl_akhir, $user_role, $user_id, $user_name) {
		$add_join = "";
		$filter = "";
		if ($user_role == '2') {
			$add_join = " LEFT JOIN wpgy_posts d ON c.user_nicename = d.post_name ";
			$filter = " AND d.post_author = $user_id";
		} else if ($user_role == '3') {
			$filter = " AND c.ID = $user_id";
		}

		$query = "SELECT COALESCE(c.user_nicename, '') as sales_consultant, a.organisational_unit_name as harcourts,
					SUM(CASE WHEN a.jenis_listing = 'Jual' THEN 1 ELSE 0 END) as unit_jual, 
					SUM(CASE WHEN a.jenis_listing = 'Sewa' THEN 1 ELSE 0 END) as unit_sewa,
					COUNT(a.jenis_listing) as total, a.property_agent
					FROM (
						SELECT post_id,
						MAX(CASE WHEN meta_key = 'OrganisationalUnitName' THEN meta_value ELSE '' END) as organisational_unit_name,
						MAX(CASE WHEN meta_key = 'jenis_listing' THEN meta_value ELSE '' END) as jenis_listing,
						MAX(CASE WHEN meta_key = 'property_agent' THEN meta_value ELSE '' END) as property_agent,
						MAX(CASE WHEN meta_key = 'original_author' THEN meta_value ELSE '' END) as post_author
						FROM wpgy_postmeta
							WHERE post_id IN (
								SELECT ID FROM wpgy_posts WHERE DATE(post_date) BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."' AND post_type = 'estate_property'
							) AND meta_key IN ('OrganisationalUnitName', 'jenis_listing', 'property_agent', 'original_author')
							GROUP BY post_id
						) a
						INNER JOIN wpgy_term_relationships b ON a.post_id = b.object_id
						LEFT JOIN wpgy_users c ON a.property_agent = c.ID
						$add_join
						WHERE b.term_taxonomy_id IN (73, 74) $filter
				GROUP BY 1, 2
				ORDER BY CASE WHEN c.user_nicename IS NOT NULL OR c.user_nicename <> '' THEN 1 ELSE 2 END";
		return $query;
	}

	public function get_data_total_unit($tgl_awal, $tgl_akhir, $is_export = FALSE, $user_role, $user_id, $user_name, $limit = 10, $offset = 0){
		$sql = $this->query_total_unit($tgl_awal, $tgl_akhir, $user_role, $user_id, $user_name);
		if (!$is_export) {
			$sql .= "
					LIMIT $limit OFFSET $offset";
		}

		$res = $this->db->query($sql);

		return $res->result();
	}

    public function get_count_data_total_unit($tgl_awal, $tgl_akhir, $user_role, $user_id, $user_name){
		$total_unit = $this->query_total_unit($tgl_awal, $tgl_akhir, $user_role, $user_id, $user_name);
		$sql = $this->db->query("SELECT COUNT(*) as jumlah
								FROM (
									$total_unit
								) xx1");
		
		return $sql->row()->jumlah;
	}

	private function query_ina_office_revenue($tgl_awal, $tgl_akhir, $user_role, $user_id, $user_name) {
		$add_join = "";
		$filter = "";
		// if ($user_role == '2') {
		// 	$add_join = " LEFT JOIN wpgy_posts d ON c.user_nicename = d.post_name ";
		// 	$filter = " AND d.post_author = $user_id";
		// } else if ($user_role == '3') {
		// 	$filter = " AND c.ID = $user_id";
		// }

		$query = "SELECT DISTINCT a.organisational_unit_name as harcourts
					FROM (
						SELECT post_id,
						MAX(CASE WHEN meta_key = 'OrganisationalUnitName' THEN meta_value ELSE '' END) as organisational_unit_name
						FROM wpgy_postmeta
						WHERE post_id IN (
							SELECT ID FROM wpgy_posts WHERE DATE(post_date) BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."' AND post_type = 'estate_property'
						) AND meta_key = 'OrganisationalUnitName'
						GROUP BY post_id
					) a
					$filter
					ORDER BY 1";
		return $query;
	}

	public function get_data_ina_office_revenue($tgl_awal, $tgl_akhir, $is_export = FALSE,  $user_role, $user_id, $user_name, $limit = 10, $offset = 0){
		$sql = $this->query_ina_office_revenue($tgl_awal, $tgl_akhir, $user_role, $user_id, $user_name);
		if (!$is_export) {
			$sql .= "
						LIMIT $limit OFFSET $offset";
		}

		$res = $this->db->query($sql);

		return $res->result();
	}

    public function get_count_ina_office_revenue($tgl_awal, $tgl_akhir, $user_role, $user_id, $user_name){
		$ina_office_revenue = $this->query_ina_office_revenue($tgl_awal, $tgl_akhir, $user_role, $user_id, $user_name);
		$sql = $this->db->query("SELECT COUNT(*) as jumlah
								FROM (
									$ina_office_revenue
								) xx1");
		
		return $sql->row()->jumlah;
	}

	private function query_ina_sales_consultant($tgl_awal, $tgl_akhir, $user_role, $user_id, $user_name) {
		$add_join = "";
		$filter = "";
		if ($user_role == '2') {
			$add_join = " LEFT JOIN wpgy_posts d ON c.user_nicename = d.post_name ";
			$filter = " WHERE d.post_author = $user_id";
		} else if ($user_role == '3') {
			$filter = " WHERE c.ID = $user_id";
		}

		$query = "SELECT COALESCE(c.user_nicename, '') as sales_consultant, a.organisational_unit_name as harcourts, c.ID as sales_consultant_id
						FROM (
							SELECT post_id,
							MAX(CASE WHEN meta_key = 'OrganisationalUnitName' THEN meta_value ELSE '' END) as organisational_unit_name,
							MAX(CASE WHEN meta_key = 'property_agent' THEN meta_value ELSE '' END) as property_agent,
							MAX(CASE WHEN meta_key = 'original_author' THEN meta_value ELSE '' END) as post_author
							FROM wpgy_postmeta
							WHERE post_id IN (
								SELECT ID FROM wpgy_posts WHERE DATE(post_date) BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."' AND post_type = 'estate_property'
							) AND meta_key IN ('OrganisationalUnitName', 'property_agent', 'original_author')
							GROUP BY post_id
						) a
						LEFT JOIN wpgy_users c ON a.post_author = c.ID
						$add_join
						$filter
				GROUP BY 1, 2
				ORDER BY CASE WHEN c.user_nicename IS NOT NULL OR c.user_nicename <> '' THEN 1 ELSE 2 END";

		return $query;
	}

	public function get_data_ina_sales_consultant($tgl_awal, $tgl_akhir, $is_export = FALSE, $user_role, $user_id, $user_name, $limit = 10, $offset = 0){
		$sql = $this->query_ina_sales_consultant($tgl_awal, $tgl_akhir, $user_role, $user_id, $user_name);
		if (!$is_export) {
			$sql .= "
					LIMIT $limit OFFSET $offset";
		}

		$res = $this->db->query($sql);

		return $res->result();
	}

    public function get_count_ina_sales_consultant($tgl_awal, $tgl_akhir, $user_role, $user_id, $user_name){
		$ina_sales_consultant = $this->query_ina_sales_consultant($tgl_awal, $tgl_akhir, $user_role, $user_id, $user_name);
		$sql = $this->db->query("SELECT COUNT(*) as jumlah
								FROM (
									$ina_sales_consultant
								) xx1");
		
		return $sql->row()->jumlah;
	}

	private function query_ina_principal($tgl_awal, $tgl_akhir, $user_role, $user_id, $user_name) {
		$add_join = "";
		$filter = "";
		// if ($user_role == '2') {
		// 	$add_join = " LEFT JOIN wpgy_posts d ON c.user_nicename = d.post_name ";
		// 	$filter = " AND d.post_author = $user_id";
		// } else if ($user_role == '3') {
		// 	$filter = " AND c.ID = $user_id";
		// }

		$query = "SELECT DISTINCT a.organisational_unit_name as harcourts
							FROM (
								SELECT post_id,
								MAX(CASE WHEN meta_key = 'OrganisationalUnitName' THEN meta_value ELSE '' END) as organisational_unit_name
								FROM wpgy_postmeta
								WHERE post_id IN (
									SELECT ID FROM wpgy_posts WHERE DATE(post_date) BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."' AND post_type = 'estate_property'
								) AND meta_key = 'OrganisationalUnitName'
								GROUP BY post_id
							) a
							$filter
					ORDER BY 1";
		return $query;
	}

	public function get_data_ina_principal_report($tgl_awal, $tgl_akhir, $is_export = FALSE, $user_role, $user_id, $user_name, $limit = 10, $offset = 0){
		$sql = $this->query_ina_principal($tgl_awal, $tgl_akhir, $user_role, $user_id, $user_name);

		if(!$is_export) {
			$sql .= "
					LIMIT $limit OFFSET $offset";
		}

		$res = $this->db->query($sql);

		return $res->result();
	}

    public function get_count_ina_principal_report($tgl_awal, $tgl_akhir, $user_role, $user_id, $user_name){
		$ina_principal_report = $this->query_ina_principal($tgl_awal, $tgl_akhir, $user_role, $user_id, $user_name);
		$sql = $this->db->query("SELECT COUNT(*) as jumlah
								FROM (
									$ina_principal_report
								) xx1");
		
		return $sql->row()->jumlah;
	}

}