<?php 

    class Login_model extends CI_Model{

        public function cekLogin($name, $pass)
        {
            $pass = md5(sha1($pass));
            $this->db->where("username", $name) ; //= '$name' OR 'email' = '$name' "
            $this->db->where('password', $pass);
            $query = $this->db->get('user')->row_array();
            if ($query){
    
                $sesi = [
                    'id_user' => $query['id_user'] ,
                    'nama_toko' => $query['nama_toko']
                ] ;
                $this->session->set_userdata($sesi);
                redirect('home');
    
            }
            else{
                $this->session->set_flashdata('login' , 'MAAF Username atau Password Anda salah!, Mohon diperiksa kembali');
                redirect('login');
            }
        }
        
    }

?>