<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 
 class Dashboard extends CI_Controller{

    /**This class is being used for shows all test and add to crt */

    /* this funciton is being used for load the showtest view*/
    public function index(){            
                     
            $data = $this->viewText(); 
            $this->load->view('showtest',$data);
    }

    /* This function is being used for get all test from model */
    public function testDetails(){        
         
            $tests = $this->user->getAllTest();
            echo json_encode($tests);
    }

    /* This function is being used for search the test*/
    public function search(){

        $tests = $this->user->getTest($this->input->get('key'));
        echo json_encode($tests);
        
    }

    /*This function is being used for save the test */

    public function savetest(){
       
        $ret=$this->user->saveTest($this->input->post('key'));
        if($ret){
            $this->session->set_flashdata('success', 'Test Added Successfully');
            $this->index();
        }
    }

    /*This function is being used for display  the cart item for particular user */

    public function getCartItems(){
       
        $data = $this->viewText(); 
        $data['cart_items']=$this->user->getCartItems();
        $this->load->view('show_cart',$data);
    }

    /*This is function being used for remove item from the cart */

    public function remove_cart(){

        $ret=$this->user->remove_cart($this->input->get('id'));
        if($ret){
            echo "true";
        }
    }

    public function confirmOrder(){

        $data = $this->viewText(); 
        $data['order_summary']=$this->user->getCartItems();
        $this->load->view('confirm_order',$data);
    }

    protected function viewText(){

        $data['title']          =   "NetMeds Assignment";
        $data['heading']        =   "NetMeds";
        $data['panel_title']    =   "All Test";    
        $data['cart']           =   "Cart Items"; 
        $data['order_summary_text']  =   "Order Summary";     
        return $data;
    } 

 }
?>