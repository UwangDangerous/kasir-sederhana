<?php 

    class Masuk_model extends CI_Model{
        public function getDataMasuk()
        {
            return $this->db->get('masuk')->result_array() ;
        }

        public function getDataMasukEdit($id)
        {
            $this->db->where('id_masuk', $id) ;
            return $this->db->get('masuk')->row_array() ;
        }

        public function addMasuk()
        {
            $query = [
                'nama_masuk' => $this->input->post('nama_masuk', true) ,
                'harga_jual' => $this->input->post('harga_jual', true) ,
                'stok' => $this->input->post('stok') 
            ] ;

            if($this->db->insert('masuk', $query)) {
                $pesan = [
                    'pesan' => 'Data Berhasil Disimpan' ,
                    'warna' => 'success'
                ];
            }else{
                $pesan = [
                    'pesan' => 'Data Gagal Disimpan' ,
                    'warna' => 'danger'
                ];
            }

            $this->session->set_flashdata($pesan) ;
            redirect("masuk") ;
        }

        public function editMasuk($id)
        {
            $query = [
                'nama_masuk' => $this->input->post('nama_masuk', true) ,
                'harga_jual' => $this->input->post('harga_jual', true) ,
                'stok' => $this->input->post('stok') 
            ] ;

            $this->db->where('id_masuk', $id) ;
            if($this->db->update('masuk', $query)) {
                $pesan = [
                    'pesan' => 'Data Berhasil Diubah' ,
                    'warna' => 'success'
                ];
            }else{
                $pesan = [
                    'pesan' => 'Data Gagal Diubah' ,
                    'warna' => 'danger'
                ];
            }

            $this->session->set_flashdata($pesan) ;
            redirect("masuk") ;
        }

        public function deleteMasuk($id)
        {
            $this->db->where('id_masuk', $id) ;
            if($this->db->delete('masuk')) {
                $pesan = [
                    'pesan' => 'Data Berhasil Dihapus' ,
                    'warna' => 'success'
                ];
            }else{
                $pesan = [
                    'pesan' => 'Data Gagal Dihapus' ,
                    'warna' => 'danger'
                ];
            }

            $this->session->set_flashdata($pesan) ;
            redirect("masuk") ;
        }
    }

?>