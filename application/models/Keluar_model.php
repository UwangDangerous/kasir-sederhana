<?php 

    class Keluar_model extends CI_Model{
        public function getDataKeluar()
        {
            $this->db->where('id_user', $this->session->userdata('id_user')) ;
            $this->db->order_by('tgl_keluar', 'desc') ;
            return $this->db->get('keluar')->result_array() ;
        }

        public function getRinciKeluar($kode)
        {
            $this->db->where('kode_keluar', $kode) ;
            return $this->db->get('keluar')->row_array() ;
        }
        
        public function getDataItem($kode)
        {
            $this->db->where('keluar.kode_keluar', $kode) ;
            $this->db->join('keluar', 'keluar.kode_keluar = keluar_item.kode_keluar') ;
            $this->db->join('barang', 'barang.id_barang = keluar_item.id_barang') ;
            // $this->db->select('keluar_item.kode_keluar as kode_keluar, qty, harga_jual, total_jual , nama_barang, satuan, id_keluar, tgl_keluar') ;
            return $this->db->get('keluar_item')->result_array() ;
        }

        public function totalKeluar($kode)
        {
            $this->db->where('kode_keluar', $kode);
            $this->db->select_sum('total_jual') ;
            $total = $this->db->get('keluar_item')->row_array()['total_jual'];
            
            if($total == null){
                return 0 ;
            }else{
                return $total ;
            }
        }

        public function deleteKeluar($kode)
        {
            $this->db->where('kode_keluar', $kode) ;
            if($this->db->delete('keluar')) {

                $this->db->where('kode_keluar', $kode) ;
                $this->db->delete('keluar_item') ;

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
            redirect("keluar") ;
        }

        public function deleteKeluarItem($id)
        {
            $this->db->where('id_keluar', $id) ;
            if($this->db->delete('keluar_item')) {
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