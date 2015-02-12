<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_pegawai extends Model_tambahan
{
    public $tambah_pegawai_rules = array(
        'nik' => array(
            'field' => 'nik',
            'rules' => 'trim|required|is_unique[tb_pegawai.nik_pgw]|xss_clean',
            ),
        'ktp' => array(
            'field' => 'no_ktp',
            'rules' => 'trim|required|is_unique[tb_pegawai.no_ktp_pgw]|xss_clean',
            ),
        'akun' => array(
            'field' => 'no_akun',
            'rules' => 'trim|required|is_unique[tb_akun.no_akun_pgw]|xss_clean',
            ),
        'npwp' => array(
            'field' => 'npwp',
            'rules' => 'trim|required|is_unique[tb_pegawai.npwp_pgw]|xss_clean',
            ),
        'email' => array(
            'field' => 'email',
            'rules' => 'trim|required|is_unique[tb_pegawai.email_pgw]|xss_clean',
            ),
        'username' => array(
            'field' => 'username',
            'rules' => 'trim|required|is_unique[tb_pegawai.uname_pgw]|xss_clean',
            )
        );

    public $pegawai_rules = array(
        'nik' => array(
            'field' => 'nik',
            'rules' => 'trim|required|callback__nik|xss_clean',
            ),
        'ktp' => array(
            'field' => 'no_ktp',
            'rules' => 'trim|required|callback__ktp|xss_clean',
            ),
        'akun' => array(
            'field' => 'no_akun',
            'rules' => 'trim|required|callback__akun|xss_clean',
            ),
        'npwp' => array(
            'field' => 'npwp',
            'rules' => 'trim|required|callback__npwp|xss_clean',
            ),
        'email' => array(
            'field' => 'email',
            'rules' => 'trim|required|callback__npwp|xss_clean',
            ),
        'username' => array(
            'field' => 'username',
            'rules' => 'trim|required|callback__username|xss_clean',
            ),
        );

    public function _nik()
    {
        $result = $this->db->get_where('tb_pegawai','nik_pgw',$this->input->post('nik'));

        if (count($result) >= 1)
        {
            $this->form_validation->set_message('_nik', 'NIK sudah digunakan');
            return FALSE;
        }

        return true;
    }

    public function _akun()
    {
        $result = $this->db->get_where('tb_akun','no_akun_pgw',$this->input->post('no_akun'));

        if (count($result) >= 1)
        {
            $this->form_validation->set_message('_akun', 'No. Akun sudah digunakan');
            return FALSE;
        }

        return true;
    }

    public function _ktp()
    {
        $result = $this->db->get_where('tb_pegawai','no_ktp_pgw',$this->input->post('no_ktp'));

        if (count($result) >= 1)
        {
            $this->form_validation->set_message('_ktp', 'Nomor KTP sudah digunakan');
            return FALSE;
        }

        return true;
    }

    public function _npwp()
    {
        $result = $this->db->get_where('tb_pegawai','npwp_pgw',$this->input->post('npwp'));

        if (count($result) >= 1)
        {
            $this->form_validation->set_message('_npwp', 'Nomor NPWP sudah digunakan');
            return FALSE;
        }

        return true;
    }

    public function _email()
    {
        $result = $this->db->get_where('tb_pegawai','email_pgw',$this->input->post('email'));

        if (count($result) >= 1)
        {
            $this->form_validation->set_message('_email', 'Email sudah digunakan');
            return FALSE;
        }

        return true;
    }

    public function _username()
    {
        $result = $this->db->get_where('tb_pegawai','uname_pgw',$this->input->post('username'));

        if (count($result) >= 1)
        {
            $this->form_validation->set_message('_username', 'Username sudah digunakan');
            return FALSE;
        }

        return true;
    }

    //DROPDOWN
    function jabatan()
    {
        return $this->db->get('tb_jabatan')->result();
    }
    //AKHIR DROPDOWN
	
    function index()
    {
        $this->db->select('id_pgw,nik_pgw,nma_lkp_pgw,email_pgw,div_jbtn,nma_jbtn,stat_akt_pgw');
        $this->db->from('tb_pegawai');
        $this->db->join('tb_jabatan','tb_jabatan.id_jbtn = tb_pegawai.id_jbtn');
        $result = $this->db->get()->result();

        return $result;
    }

    function detail($id_pgw)
    {
        $this->db->select();
        $this->db->from('tb_pegawai');
        $this->db->where('tb_pegawai.id_pgw',$id_pgw);
        $this->db->join('tb_jabatan','tb_jabatan.id_jbtn = tb_pegawai.id_jbtn');
        $result = $this->db->get()->row();

        return $result;
    }

    function aksi_tambah($upload = null,$random_pass)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tgl_exp = explode('/',$this->input->post('tanggal'));
        $tgl = $tgl_exp[2].'-'.$tgl_exp[0].'-'.$tgl_exp[1];
        $level = '';
        $divisi = $this->db->get_where("tb_jabatan",array('id_jbtn' => $this->input->post('jabatan')))->row();

        if ($divisi->div_jbtn == "direksi" || $divisi->div_jbtn == "komisaris")
        {
            $level = "special user";
        }
        else if ($divisi->nma_jbtn == "kepala")
        {
            $level = "admin";
        }
        else
        {
            $level = "user";
        }

        $pegawai = array (
            'id_jbtn' => $this->input->post('jabatan'),
            'nik_pgw' => $this->input->post('nik'),
            'no_ktp_pgw' => $this->input->post('no_ktp'),
            'npwp_pgw' => $this->input->post('npwp'),
            'nma_lkp_pgw' => $this->input->post('nama'),
            'email_pgw' => $this->input->post('email'),
            'almt_pgw' => $this->input->post('alamat'),
            'jk_pgw' => $this->input->post('jk'),
            'stat_pgw' => $this->input->post('status'),
            'lev_usr_pgw' => $level,
            'uname_pgw' => $this->input->post('username'),
            'pass_pgw' => md5($random_pass),
            'photo_pgw' => null,
            'tmp_lhr_pgw' => $this->input->post('tempat'),
            'tgl_lhr_pgw' => $tgl,
            'hp_pgw' => $this->input->post('no_hp'),
            'telp_pgw' => $this->input->post('no_tlp'),
            'gol_drh_pgw' => $this->input->post('gd'),
            'nma_psg_pgw' => $this->input->post('pasangan'),
            'pc_ktp_pgw' => $upload,
            'stat_akt_pgw' => 'Y'
            );
        
        if ($this->db->insert('tb_pegawai',$pegawai) and $this->db->insert_id() > 0)
        {
            $akun = array (
                'no_akun_pgw' => $this->input->post('no_akun'),
                'id_pgw' => $this->db->insert_id()
                );

            if ($this->db->insert('tb_akun',$akun)) 
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    function ubah($id_pgw)
    {
        $this->db->select();
        $this->db->from('tb_pegawai');
        $this->db->where('tb_pegawai.id_pgw',$id_pgw);
        $this->db->join('tb_akun','tb_akun.id_pgw = tb_pegawai.id_pgw');
        $result = $this->db->get()->row();

        return $result;
    }

    function aksi_ubah($id_pgw,$upload = null)
    {
        $tgl_exp = explode('/',$this->input->post('tanggal'));
        $tgl = $tgl_exp[2].'-'.$tgl_exp[0].'-'.$tgl_exp[1];

        $level = '';
        $divisi = $this->db->get_where("tb_jabatan",array('id_jbtn' => $this->input->post('jabatan')))->row();

        if ($divisi->div_jbtn == "direksi" || $divisi->div_jbtn == "komisaris")
        {
            $level = "special user";
        }
        else if ($divisi->nma_jbtn == "kepala")
        {
            $level = "admin";
        }
        else
        {
            $level = "user";
        }
        
        if ($upload == null && $this->input->post('photo') != null)
        {
            $upload = $this->input->post('photo');
        }
        
        if (md5($this->input->post('password')) == $this->session->flashdata('pass') || $this->input->post('password') == "")
        {
            if ($this->session->userdata("hak") == "admin")
            {
                $pegawai = array (
                'id_jbtn' => $this->input->post('jabatan'),
                'nik_pgw' => $this->input->post('nik'),
                'no_ktp_pgw' => $this->input->post('no_ktp'),
                'npwp_pgw' => $this->input->post('npwp'),
                'nma_lkp_pgw' => $this->input->post('nama'),
                'email_pgw' => $this->input->post('email'),
                'almt_pgw' => $this->input->post('alamat'),
                'jk_pgw' => $this->input->post('jk'),
                'stat_pgw' => $this->input->post('status'),
                'lev_usr_pgw' => $level,
                'uname_pgw' => $this->input->post('username'),
                'photo_pgw' => null,
                'tmp_lhr_pgw' => $this->input->post('tempat'),
                'tgl_lhr_pgw' => $tgl,
                'hp_pgw' => $this->input->post('no_hp'),
                'telp_pgw' => $this->input->post('no_tlp'),
                'gol_drh_pgw' => $this->input->post('gd'),
                'nma_psg_pgw' => $this->input->post('pasangan'),
                'pc_ktp_pgw' => $upload
                );    
            }
            else
            {
                $pegawai = array (
                    'nik_pgw' => $this->input->post('nik'),
                    'no_ktp_pgw' => $this->input->post('no_ktp'),
                    'npwp_pgw' => $this->input->post('npwp'),
                    'nma_lkp_pgw' => $this->input->post('nama'),
                    'email_pgw' => $this->input->post('email'),
                    'almt_pgw' => $this->input->post('alamat'),
                    'jk_pgw' => $this->input->post('jk'),
                    'stat_pgw' => $this->input->post('status'),
                    'uname_pgw' => $this->input->post('username'),
                    'photo_pgw' => null,
                    'tmp_lhr_pgw' => $this->input->post('tempat'),
                    'tgl_lhr_pgw' => $tgl,
                    'hp_pgw' => $this->input->post('no_hp'),
                    'telp_pgw' => $this->input->post('no_tlp'),
                    'gol_drh_pgw' => $this->input->post('gd'),
                    'nma_psg_pgw' => $this->input->post('pasangan'),
                    'pc_ktp_pgw' => $upload
                    );
            }
        }
        else
        {
            if ($this->session->userdata("hak") == "admin")
            {
                $pegawai = array (
                    'id_jbtn' => $this->input->post('jabatan'),
                    'nik_pgw' => $this->input->post('nik'),
                    'no_ktp_pgw' => $this->input->post('no_ktp'),
                    'npwp_pgw' => $this->input->post('npwp'),
                    'nma_lkp_pgw' => $this->input->post('nama'),
                    'email_pgw' => $this->input->post('email'),
                    'almt_pgw' => $this->input->post('alamat'),
                    'jk_pgw' => $this->input->post('jk'),
                    'stat_pgw' => $this->input->post('status'),
                    'lev_usr_pgw' => $level,
                    'uname_pgw' => $this->input->post('username'),
                    'pass_pgw' => md5($this->input->post('password')),
                    'photo_pgw' => null,
                    'tmp_lhr_pgw' => $this->input->post('tempat'),
                    'tgl_lhr_pgw' => $tgl,
                    'hp_pgw' => $this->input->post('no_hp'),
                    'telp_pgw' => $this->input->post('no_tlp'),
                    'gol_drh_pgw' => $this->input->post('gd'),
                    'nma_psg_pgw' => $this->input->post('pasangan'),
                    'pc_ktp_pgw' => $upload
                    );
            }
            else
            {       
                $pegawai = array (
                    'nik_pgw' => $this->input->post('nik'),
                    'no_ktp_pgw' => $this->input->post('no_ktp'),
                    'npwp_pgw' => $this->input->post('npwp'),
                    'nma_lkp_pgw' => $this->input->post('nama'),
                    'email_pgw' => $this->input->post('email'),
                    'almt_pgw' => $this->input->post('alamat'),
                    'jk_pgw' => $this->input->post('jk'),
                    'stat_pgw' => $this->input->post('status'),
                    'uname_pgw' => $this->input->post('username'),
                    'pass_pgw' => md5($this->input->post('password')),
                    'photo_pgw' => null,
                    'tmp_lhr_pgw' => $this->input->post('tempat'),
                    'tgl_lhr_pgw' => $tgl,
                    'hp_pgw' => $this->input->post('no_hp'),
                    'telp_pgw' => $this->input->post('no_tlp'),
                    'gol_drh_pgw' => $this->input->post('gd'),
                    'nma_psg_pgw' => $this->input->post('pasangan'),
                    'pc_ktp_pgw' => $upload
                    );
            }
        }

        if ($this->db->where('id_pgw',$id_pgw)->update('tb_pegawai',$pegawai)) 
        {
            $akun = array (
                'no_akun_pgw' => $this->input->post('no_akun')
                );

            if ($this->db->where('id_pgw',$id_pgw)->update('tb_akun',$akun)) 
            {
                if ($this->session->userdata("id_pgw") == $id_pgw)
                {
                    $this->session->set_userdata('nik',$this->input->post('nik'));
                    $this->session->set_userdata('nama',$this->input->post('nama'));
                }
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    function aktifasi($id_pgw,$status)
    {
        if ($status == 0)
        {
            $stat = array(
            'stat_akt_pgw' => 'T'
            );
        }
        else
        {
            $stat = array(
            'stat_akt_pgw' => 'Y'
            );
        }

        if ($this->db->where('id_pgw',$id_pgw)->update('tb_pegawai',$stat))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function foto()
    {
        $foto = array (
            'photo_pgw' => 'images/'.$this->session->userdata['id_pgw']."/".$this->session->userdata['id_pgw'].'.jpg'
            );

        if ($this->db->where('id_pgw',$this->session->userdata['id_pgw'])->update('tb_pegawai',$foto)) 
        {
            $this->session->set_userdata('foto','images/'.$this->session->userdata['id_pgw']."/".$this->session->userdata['id_pgw'].'.jpg');
            return true;
        }
        else
        {
            return false;
        }
    }
}