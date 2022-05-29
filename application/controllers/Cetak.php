<?php 

    class Cetak extends CI_Controller{
        public function __construct()
        {
            parent::__construct() ;
            $this->load->model("_Date") ; 
        }
        
        public function cetakNotaKeluar($kode)
        {
            $data['kode'] = $kode ;

            $tanggal = explode(" ",$this->db->get_where('keluar', ['kode_keluar' => $kode])->row_array()['tgl_keluar'] ) ;
            $data['tgl'] = $this->_Date->formatTanggal($tanggal[0]).' '.$tanggal[1];

            $this->db->where('keluar.kode_keluar', $kode) ;
            $this->db->join('keluar', 'keluar.kode_keluar = keluar_item.kode_keluar') ;
            $this->db->join('barang', 'barang.id_barang = keluar_item.id_barang') ;
            $data['keluar'] = $this->db->get('keluar_item')->result_array() ;

            $this->load->view('cetak/cetakNotaKeluar', $data);
        }
    }

?>