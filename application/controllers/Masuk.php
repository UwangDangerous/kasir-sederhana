<?php 

    class Masuk extends CI_Controller{
        public function __construct()
        {
            parent::__construct() ;
            $this->load->library('form_validation');
            $this->load->model('Masuk_model');
            $this->load->model('_Date');
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
                
                $this->form_validation->set_rules('nama_masuk', 'Nama Masuk', 'required');
                $this->form_validation->set_rules('harga_jual', 'Harga Jual', 'required');

                $data['tanggal'] = date("Y-m-d G:i:s") ;

                if($this->form_validation->run() == FALSE) {
                    $this->load->view('temp/header', $data) ;
                    $this->load->view('temp/dsbHeader') ;

                    $this->load->view('masuk/tambah', $data) ;

                    $this->load->view('temp/dsbFooter') ;
                    $this->load->view('temp/footer') ;
                }else{
                    $this->Masuk_model->addMasuk() ;
                }

            }else{
                redirect("login") ;
            }
        }

        public function ubah($id)
        {   
            if( $this->session->userdata('id_user') != null ){
                $data['judul'] = 'Ubah Masuk' ;
                $data['header'] = 'Ubah Masuk' ;
                $data['bread'] = '
                    <li class="breadcrumb-item"><a href="'.base_url().'">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="'.base_url().'masuk">Masuk</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ubah Masuk</li>
                ' ;
                $data['aksi'] = 'Ubah' ;
                $data['masuk'] = $this->Masuk_model->getDataMasukEdit($id) ;
                
                $this->form_validation->set_rules('nama_masuk', 'Nama Masuk', 'required');
                $this->form_validation->set_rules('harga_jual', 'Harga Jual', 'required');

                if($this->form_validation->run() == FALSE) {
                    $this->load->view('temp/header', $data) ;
                    $this->load->view('temp/dsbHeader') ;

                    $this->load->view('masuk/aksi', $data) ;

                    $this->load->view('temp/dsbFooter') ;
                    $this->load->view('temp/footer') ;
                }else{
                    $this->Masuk_model->editMasuk($id) ;
                }

            }else{
                redirect("login") ;
            }
        }

        public function hapus($id)
        {
            $this->Masuk_model->deleteMasuk($id) ;
        }








        public function itemTambah($kode)
        {
            $data['kode'] = $kode ;
            $data['barang'] = $this->db->get('barang')->result_array() ;

            $this->load->view('masuk/tambahItem', $data) ;
        }
    }

?>