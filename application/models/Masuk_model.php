<?php 

    class Masuk_model extends CI_Model{
        public function getDataMasuk()
        {
            $this->db->where('id_user', $this->session->userdata('id_user')) ;
            $this->db->order_by('tgl_masuk', 'desc') ;
            return $this->db->get('masuk')->result_array() ;
        }

        public function getRinciMasuk($kode)
        {
            $this->db->where('kode_masuk', $kode) ;
            return $this->db->get('masuk')->row_array() ;
        }
        
        public function getDataItem($kode)
        {
            $this->db->where('masuk.kode_masuk', $kode) ;
            $this->db->join('masuk', 'masuk.kode_masuk = masuk_item.kode_masuk') ;
            $this->db->join('barang', 'barang.id_barang = masuk_item.id_barang') ;
            $this->db->select('masuk_item.kode_masuk as kode_masuk, qty, harga_beli, total_beli , nama_barang, satuan, id_masuk') ;
            return $this->db->get('masuk_item')->result_array() ;
        }

        public function totalMasuk($kode)
        {
            $this->db->where('kode_masuk', $kode);
            $this->db->select_sum('total_beli') ;
            $total = $this->db->get('masuk_item')->row_array()['total_beli'];
            
            if($total == null){
                return 0 ;
            }else{
                return $total ;
            }
        }

        public function deleteMasuk($kode)
        {
            $this->db->where('kode_masuk', $kode) ;
            if($this->db->delete('masuk')) {

                $this->db->where('kode_masuk', $kode) ;
                $this->db->delete('masuk_item') ;

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

        public function deleteMasukItem($id)
        {
            $this->db->where('id_masuk', $id) ;
            if($this->db->delete('masuk_item')) {
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
        }
    }

?>