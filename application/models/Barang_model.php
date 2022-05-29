<?php 

    class Barang_model extends CI_Model{
        public function getDataBarang()
        {
            return $this->db->get('barang')->result_array() ;
        }

        public function getDataBarangEdit($id)
        {
            $this->db->where('id_barang', $id) ;
            return $this->db->get('barang')->row_array() ;
        }

        public function addBarang()
        {
            $query = [
                'nama_barang' => $this->input->post('nama_barang', true) ,
                'harga_jual' => $this->input->post('harga_jual', true) ,
                'stok' => $this->input->post('stok', true) ,
                'satuan' => $this->input->post('satuan', true)
            ] ;

            if($this->db->insert('barang', $query)) {
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
            redirect("barang") ;
        }

        public function editBarang($id)
        {
            $query = [
                'nama_barang' => $this->input->post('nama_barang', true) ,
                'harga_jual' => $this->input->post('harga_jual', true) ,
                'stok' => $this->input->post('stok', true) ,
                'satuan' => $this->input->post('satuan', true)
            ] ;

            $this->db->where('id_barang', $id) ;
            if($this->db->update('barang', $query)) {
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
            redirect("barang") ;
        }

        public function deleteBarang($id)
        {
            $this->db->where('id_barang', $id) ;
            if($this->db->delete('barang')) {
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
            redirect("barang") ;
        }
    }

?>