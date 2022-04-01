<?php
class Auth_model extends CI_Model{
    public function create($formArray){
        $this->db->insert('users',$formArray);
    }

    public function checkUser($email){
        $this->db->where('email',$email);
        return $this->db->get('users')->row_array();
    }

    public function authorized(){
        $user = $this->session->userdata('user');
        if(!empty($user)){

            return true;
        }
        else{

            return false;
        }
    }

    public function getUser(){
        $user = $this->db->get('users');
        return $user->result();
    }

    public function editUser($id){
      $query = $this->db->get_where('users', ['id' => $id]);
      return $query->row();
    }

    public function updateUser($updateArray, $id){
        return $this->db->update('users', $updateArray, ['id' => $id]);
    }

    public function checkUserImage($id){
        $query = $this->db->get_where('users' , ['id' => $id]);
        return $query->row();
    }

    public function deleteUser($id){
        return $this->db->delete('users', ['id' =>$id]);
    }
}
?>