<?php 

    class Barang extends CI_Controller{
        public function __construct()
        {
            parent::__construct() ;
            $this->load->library('form_validation');
            $this->load->model('Barang_model');
        }

        public function index()
        {
            if( $this->session->userdata('id_user') != null ){
                $data['judul'] = 'Daftar Barang - ' ;
                $data['header'] = 'Daftar Barang' ;
                $data['bread'] = '
                    <li class="breadcrumb-item"><a href="'.base_url().'">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Barang</li>
                ' ;

                $data['barang'] = $this->Barang_model->getDataBarang() ;

                $this->load->view('temp/header', $data) ;
                $this->load->view('temp/dsbHeader') ;

                $this->load->view('barang/index') ;

                $this->load->view('temp/dsbFooter') ;
                $this->load->view('temp/footer') ;
            }else{
                redirect("login") ;
            }
        }

        public function tambah()
        {   
            if( $this->session->userdata('id_user') != null ){
                $data['judul'] = 'Tambah Barang' ;
                $data['header'] = 'Tambah Barang' ;
                $data['bread'] = '
                    <li class="breadcrumb-item"><a href="'.base_url().'">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="'.base_url().'barang">Barang</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Barang</li>
                ' ;
                $data['aksi'] = 'Tambah' ;
                
                $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
                $this->form_validation->set_rules('harga_jual', 'Harga Jual', 'required');

                if($this->form_validation->run() == FALSE) {
                    $this->load->view('temp/header', $data) ;
                    $this->load->view('temp/dsbHeader') ;

                    $this->load->view('barang/aksi', $data) ;

                    $this->load->view('temp/dsbFooter') ;
                    $this->load->view('temp/footer') ;
                }else{
                    $this->Barang_model->addBarang() ;
                }

            }else{
                redirect("login") ;
            }
        }

        public function ubah($id)
        {   
            if( $this->session->userdata('id_user') != null ){
                $data['judul'] = 'Ubah Barang' ;
                $data['header'] = 'Ubah Barang' ;
                $data['bread'] = '
                    <li class="breadcrumb-item"><a href="'.base_url().'">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="'.base_url().'barang">Barang</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ubah Barang</li>
                ' ;
                $data['aksi'] = 'Ubah' ;
                $data['barang'] = $this->Barang_model->getDataBarangEdit($id) ;
                
                $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
                $this->form_validation->set_rules('harga_jual', 'Harga Jual', 'required');

                if($this->form_validation->run() == FALSE) {
                    $this->load->view('temp/header', $data) ;
                    $this->load->view('temp/dsbHeader') ;

                    $this->load->view('barang/aksi', $data) ;

                    $this->load->view('temp/dsbFooter') ;
                    $this->load->view('temp/footer') ;
                }else{
                    $this->Barang_model->editBarang($id) ;
                }

            }else{
                redirect("login") ;
            }
        }

        public function hapus($id)
        {
            $this->Barang_model->deleteBarang($id) ;
        }
    }

?>