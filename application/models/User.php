<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class user extends CI_Model{

    function __construct() { 
        // Set table name 
        $this->user_table = 'user'; 
        $this->test_table = 'testlist'; 
    } 

    /* This function is used for whether the user is exist or not */
    public function checkUser($username,$password){

         return $this->db->get_where($this->user_table,array('username'=>$username,'password'=>$password))->num_rows();
    }

    public function getAllTest(){

        return $this->db->get($this->test_table)->result();
    }

    public function getTest($key){

        return $this->db->like('itemName',$key)->get($this->test_table)->result(); 
    }

    public function saveTest(){
        
        foreach($this->input->post('testid') as $val){             
            $datas[] = array(
                    'user_name'   => $this->session->userdata('user_id'),
                    'test_id'   =>  $val
            );
        }

        $this->db->insert_batch('cart',$datas);
        return true;
    }

    public function getCartItems(){

        $this->db->select('*');
        $this->db->from('cart');
        $this->db->join('testlist', 'cart.test_id = testlist.test_id');
        $this->db->where('cart.user_name', $this->session->userdata('user_id'));
        $query = $this->db->get();
        return $query->result();
    }

    public function remove_cart($id){

        $this->db->query("delete  from cart where cart_id='".$id."'");
        return true;
    }

}
?>