<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    /**This class is being used for user login.Index method is being used for load the login view */
    
    public function index(){
            
            $data = $this->viewText();             
            $this->load->view('login',$data);
    }

    /*This function is being used for validating the user*/

    public function doLogin(){

        $data = json_decode(file_get_contents("php://input"));
        $user_row = $this->user->checkUser($data->username,$data->password);
        if($user_row==1){
            $this->session->set_userdata(array('user_id'=>$data->username));
            $response[] = array('status'=>1);
        }else{
            $response[] = array('status'=>0);
        }

        echo json_encode($response);        
    }

    /*This function is being used for defining the view label*/

    protected function viewText(){

        $data['title']          =   "NetMeds Assignment";
        $data['heading']        =   "NetMeds";
        $data['login_title']    =   "Login";
        $data['username']       =   "Username";
        $data['password']       =   "Password";
        $data['login']          =   "Login";
        return $data;
    } 

}
?>