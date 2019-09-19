<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;
/**
    This class is for manage a APIREST endpoint for table 'usuarios' of database
    this class contains a index methos an prefixes[get, post, put, delete] for
    management of information whit HTTP Request.

    And the same way, this class manage the CRUD stack operations using REST
*/
class Usuario extends REST_Controller {

    /*Constructor of the class*/
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /*
        index method for get request
        This method will manage the 'GET' HTTP request in this REST endpoint
        This method will acomplishment the READ database operations
    */
	public function index_get($id = 0){
        if(!empty($id)){
            $data = $this->db->get_where("usuario", ['id_usuario' => $id])->row_array();
        }else{
            $data = $this->db->get("usuario")->result();
        }
        $this->response($data, REST_Controller::HTTP_OK);
	}
    
    /*
        index method for get request
        This method will manage the 'POST' HTTP request in this REST endpoint
        This method will acomplishment the CREATE database operations
    */
    public function index_post()
    {   
        if (count($this->input->post())>0) {
            $this->db->insert('usuario',$this->input->post());
            $this->response(['Usuario creado con exito'], REST_Controller::HTTP_OK);
        } 
        else{
            $input = json_decode(file_get_contents('php://input'), true);
            if($input != null && count($input, true)>0){
                $this->db->insert('usuario',$input);
                $this->response(['Usuario creado con exito'], REST_Controller::HTTP_OK);
            }else{
                $this->response(['No data'], REST_Controller::HTTP_BAD_REQUEST);
            }
        }  
    } 
     
    /*
        index method for get request
        This method will manage the 'PUT' HTTP request in this REST endpoint
        This method will acomplishment the UPDATE database operations
    */
    public function index_put($id)
    {
        $input = $this->put();
        if($input != null && count($input, true)>0){
            $this->db->update('usuario', $input, array('id_usuario'=>$id));
            $this->response(['Usuario actualizado.'], REST_Controller::HTTP_OK);
        }else{
            $this->response(['No data'], REST_Controller::HTTP_BAD_REQUEST);
        }  
    }
     
    /*
        index method for get request
        This method will manage the 'DELETE' HTTP request in this REST endpoint
        This method will acomplishment the DELETE database operations
    */
    public function index_delete($id)
    {
        $this->db->delete('usuario', array('id_usuario'=>$id));
        $this->response(['Usuario eliminado.'], REST_Controller::HTTP_OK);
    }
            
}
        
?>
        
                            