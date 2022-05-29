<?php 

    class Masuk extends CI_Controller{
        public function __construct()
        {
            parent::__construct() ;
            $this->load->library('form_validation');
            $this->load->model('Masuk_model');
            $this->load->model('_Date');
            date_default_timezone_set('Asia/Jakarta');
        }

        public function index()
        {
            if( $this->session->userdata('id_user') != null ){
                $data['judul'] = 'Barang Masuk - ' ;
                $data['header'] = 'Barang Masuk' ;
                $data['bread'] = '
                    <li class="breadcrumb-item"><a href="'.base_url().'">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Barang Masuk</li>
                ' ;

                $data['masuk'] = $this->Masuk_model->getDataMasuk() ;

                $this->load->view('temp/header', $data) ;
                $this->load->view('temp/dsbHeader') ;

                $this->load->view('masuk/index') ;

                $this->load->view('temp/dsbFooter') ;
                $this->load->view('temp/footer') ;
            }else{
                redirect("login") ;
            }
        }

        public function tambah()
        {   
            if( $this->session->userdata('id_user') != null ){
                $data['judul'] = 'Tambah Masuk' ;
                $data['header'] = 'Tambah Masuk' ;
                $data['bread'] = '
                    <li class="breadcrumb-item"><a href="'.base_url().'">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="'.base_url().'masuk">Masuk</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Masuk</li>
                ' ;
                
                $data['tanggal'] = date("Y-m-d G:i:s") ;

                $this->load->view('temp/header', $data) ;
                $this->load->view('temp/dsbHeader') ;

                $this->load->view('masuk/tambah', $data) ;

                $this->load->view('temp/dsbFooter') ;
                $this->load->view('temp/footer') ;

            }else{
                redirect("login") ;
            }
        }

        public function detail($kode)
        {   
            if( $this->session->userdata('id_user') != null ){
                $data['judul'] = 'Rincian Barang Masuk' ;
                $data['header'] = 'Rincian Barang Masuk' ;
                $data['bread'] = '
                    <li class="breadcrumb-item"><a href="'.base_url().'">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="'.base_url().'masuk">Masuk</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Rincian Barang Masuk</li>
                ' ;
                
                $data['masuk'] = $this->Masuk_model->getRinciMasuk($kode) ;

                $this->load->view('temp/header', $data) ;
                $this->load->view('temp/dsbHeader') ;

                $this->load->view('masuk/detail', $data) ;

                $this->load->view('temp/dsbFooter') ;
                $this->load->view('temp/footer') ;

            }else{
                redirect("login") ;
            }
        }
        
        public function hapus($kode)
        {
            $this->Masuk_model->deleteMasuk($kode) ;
        }








        public function itemTambah($kode)
        {
            $data['kode'] = $kode ;
            $data['barang'] = $this->db->get('barang')->result_array() ;
            $data['item'] = $this->Masuk_model->getDataItem($kode) ;

            $this->load->view('masuk/tambahItem', $data) ;
        }

        public function addMasuk($kode)
        {
            $query = [
                'kode_masuk' => $kode ,
                'tgl_masuk' => $this->input->post('tgl_masuk'),
                'id_user' => $this->session->userdata('id_user') 
            ] ;

            $this->db->insert('masuk', $query) ;
            $this->itemTambah($kode) ;
        }

        public function addItemMasuk($kode)
        {
            $barang = explode("|", $this->input->post('id_barang')) ;
            $query = [
                'kode_masuk' => $kode ,
                'id_barang' =>  $barang[0],
                'qty' => $this->input->post('qty'),
                'harga_beli' => $this->input->post('harga_beli'),
                'total_beli' => $this->input->post('total_beli'),
            ];

            if($this->db->insert('masuk_item', $query)) {
                $this->session->set_flashdata('pesan', 'Data Berhasil Disimpan') ;
            }
            $this->itemTambah($kode) ;
        } 

        public function deleteItemMasuk($kode, $id) 
        {
            $this->Masuk_model->deleteMasukItem($id) ;
            $this->itemTambah($kode) ;
        }
    }

?>