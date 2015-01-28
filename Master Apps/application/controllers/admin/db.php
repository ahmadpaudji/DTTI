<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Db extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("admin/model_db");
	}

	public function index()
	{
		if ($this->session->userdata("hak") == "admin")
		{
			// Load the DB utility class
			$this->load->dbutil();

			$prefs = array(
                'format'      => 'sql',             // gzip, zip, txt
                'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
                'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
                'newline'     => "\n"               // Newline character used in backup file
              );

			// Backup your entire database and assign it to a variable
			$backup =& $this->dbutil->backup($prefs); 

			// Load the download helper and send the file to your desktop
			$this->load->helper('download');
			force_download('mybackup.sql', $backup);
		}
		else
		{
			redirect();
		}
	}

	public function restore()
	{
		$aktif['nav'] = "";
		$aktif['notif'] = $this->model_db->notif();

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/db/view_db');
	}

	public function aksi_restore()
	{
		if (!file_exists('./files/'))
		{
    		mkdir('./files/', 0777, true);
		}

		$config['upload_path'] = 'files/';
		$config['allowed_types'] = 'jpg|jpeg';
		$config['max_size']	= '2048';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			return false;
		}
		else
		{
			$file = file_get_contents($data['upload_data']['file_name']);
			
			$string_query = rtrim($file,"\n;");

			$array_query = explode(";",$string_query);

			foreach ($array_query as $query)
			{
				$this->db->query($query);
			}
		}

		redirect();
	}
}