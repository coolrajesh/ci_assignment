<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReadTestList extends CI_Controller {

	/**
	 * This class is used for read the testlist api , create the testlist table.
      * and insert these data.
      *index function is used for read the testlist api and insert data into table.
	 *  
	 */
	public function index(){
                 
                $url = "https://5f1a8228610bde0016fd2a74.mockapi.io/getTestList"; 
                $ch = curl_init(); 
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_URL, $url);
                $result = curl_exec($ch);
                curl_close($ch);
                $testlists = json_decode($result);
                foreach($testlists as $testlists){

                        $datas[] = array(

                                        'itemName'=>$testlists->itemName,
                                        'labName'=>$testlists->labName,
                                        'minPrice'=>$testlists->minPrice,
                                        'category'=>$testlists->category
                        );
                }

               $this->db->insert_batch('testlist',$datas);
	}
}
