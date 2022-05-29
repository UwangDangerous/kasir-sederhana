<?php 

    class Keluar extends CI_Controller{
        public function __construct()
        {
            parent::__construct() ;
            $this->load->library('form_validation');
            $this->load->model('Keluar_model');
            $this->load->model('_Date');
            date_default_timezone_set('Asia/Jakarta');
        }

        public function index()
        {
            if( $this->session->userdata('id_user') != null ){
                $data['judul'] = 'Barang Keluar - ' ;
                $data['header'] = 'Barang Keluar' ;
                $data['bread'] = '
                    <li class="breadcrumb-item"><a href="'.base_url().'">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Barang Keluar</li>
                ' ;

                $data['keluar'] = $this->Keluar_model->getDataKeluar() ;

                $this->load->view('temp/header', $data) ;
                $this->load->view('temp/dsbHeader') ;

                $this->load->view('keluar/index') ;

                $this->load->view('temp/dsbFooter') ;
                $this->load->view('temp/footer') ;
            }else{
                redirect("login") ;
            }
        }

        public function tambah()
        {   
            if( $this->session->userdata('id_user') != null ){
                $data['judul'] = 'Tambah Barang Keluar' ;
                $data['header'] = 'Tambah Barang Keluar' ;
                $data['bread'] = '
                    <li class="breadcrumb-item"><a href="'.base_url().'">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="'.base_url().'keluar">Keluar</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Barang Keluar</li>
                ' ;
                
                $data['tanggal'] = date("Y-m-d G:i:s") ;

                $this->load->view('temp/header', $data) ;
                $this->load->view('temp/dsbHeader') ;

                $this->load->view('keluar/tambah', $data) ;

                $this->load->view('temp/dsbFooter') ;
                $this->load->view('temp/footer') ;

            }else{
                redirect("login") ;
            }
        }

        public function detail($kode)
        {   
            if( $this->session->userdata('id_user') != null ){
                $data['judul'] = 'Rincian Barang Keluar' ;
                $data['header'] = 'Rincian Barang Keluar' ;
                $data['bread'] = '
                    <li class="breadcrumb-item"><a href="'.base_url().'">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="'.base_url().'keluar">Keluar</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Rincian Barang Keluar</li>
                ' ;
                
                $data['keluar'] = $this->Keluar_model->getRinciKeluar($kode) ;

                $this->load->view('temp/header', $data) ;
                $this->load->view('temp/dsbHeader') ;

                $this->load->view('keluar/detail', $data) ;

                $this->load->view('temp/dsbFooter') ;
                $this->load->view('temp/footer') ;

            }else{
                redirect("login") ;
            }
        }
        
        public function hapus($kode)
        {
            $this->Keluar_model->deleteKeluar($kode) ;
        }








        public function itemTambah($kode)
        {
            $data['kode'] = $kode ;
            $data['barang'] = $this->db->get('barang')->result_array() ;
            $data['item'] = $this->Keluar_model->getDataItem($kode) ;

            $this->load->view('keluar/tambahItem', $data) ;
        }

        public function addKeluar($kode)
        {
            $query = [
                'kode_keluar' => $kode ,
                'tgl_keluar' => $this->input->post('tgl_keluar'),
                'id_user' => $this->session->userdata('id_user') 
            ] ;

            $this->db->insert('keluar', $query) ;
            $this->itemTambah($kode) ;
        }

        public function addItemKeluar($kode)
        {
            $barang = explode("|", $this->input->post('id_barang')) ;
            $query = [
                'kode_keluar' => $kode ,
                'id_barang' =>  $barang[0],
                'qty' => $this->input->post('qty'),
                'harga_jual' => $this->input->post('harga_jual'),
                'total_jual' => $this->input->post('total_jual'),
            ];

            if($this->db->insert('keluar_item', $query)) {
                $this->session->set_flashdata('pesan', 'Data Berhasil Disimpan') ;
            }
            $this->itemTambah($kode) ;
        } 

        public function deleteItemKeluar($kode, $id) 
        {
            $this->Keluar_model->deleteKeluarItem($id) ;
            $this->itemTambah($kode) ;
        }
    }

?>