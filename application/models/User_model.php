<?php 



class User_model extends CI_Model{

    public function getAllUsers($id = null){
        if($id === null ){
            return $this->db->get('tb_masyarakat')->result_array();
        }else{
            return $this->db->get_where('tb_masyarakat', ['id_user' => $id])->result_array();
        }
    }

    public function deleteUsers($id){
        $this->db->delete('tb_masyarakat', ['id_user' => $id] );
        return $this->db->affected_rows();
    }

    public function tambahUsers($data){
        $this->db->insert('tb_masyarakat',$data);
        return $this->db->affected_rows();
    }

    public function UpdateUsers($data, $id){
        $this->db->update('tb_masyarakat',$data,['id_user' => $id]);
        return $this->db->affected_rows();
    }
}