<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_libur extends Model_tambahan 
{
    public $libur_rules = array(
        'nama' => array(
            'field' => 'nama',
            'rules' => 'trim|required|xss_clean',
            )
        );

    function index()
    {
        $this->db->order_by("tgl_libur","desc");
        return $this->db->get("tb_tanggal_libur")->result();
    }

    function cek_tgl()
    {
        $tgl = explode('/', $this->input->post('tanggal'));
        $tgl_libur = $tgl[2].'-'.$tgl[0].'-'.$tgl[1];

        if ($this->db->get_where("tb_tanggal_libur",array("tgl_libur" => $tgl_libur))->result())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function aksi_tambah()
    {
        $tgl = explode('/', $this->input->post('tanggal'));
        $tanggal = $tgl[2].'-'.$tgl[0].'-'.$tgl[1];

        $libur = array (
            'tgl_libur' => $tanggal,
            'nama_libur' => $this->input->post('nama')
            );

        if ($this->db->insert('tb_tanggal_libur',$libur)) 
        {
            $akun = array();

            $prs = $this->db->get_where("tb_presensi",array('tgl_prs' => $tanggal,'stat_prs' => "alpha"))->result();
            
            if ($prs != null)
            {
                $presensi = array (
                    'stat_prs' => "libur"
                    );

                foreach ($prs as $p)
                {
                    $akun[] = $p->no_akun_pgw;
                }

                foreach ($akun as $a)
                {
                    $this->db->where('no_akun_pgw',$a)->where('tgl_prs',$tanggal)->update('tb_presensi',$presensi); 
                }
            }
            
            return true;
        }
        else
        {
            return false;
        }
    }

    function ubah($id_libur)
    {
        return $this->db->get_where('tb_tanggal_libur',array('id_libur' => $id_libur))->row();
    }

    function aksi_ubah($id_libur)
    {
        $libur = array (
            'nama_libur' => $this->input->post('nama')
            );

        if ($this->db->where('id_libur',$id_libur)->update('tb_tanggal_libur',$libur)) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function hapus($id_libur)
    {
        if ($this->db->delete('tb_tanggal_libur',array('id_libur' => $id_libur)))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}