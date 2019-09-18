<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Usuario extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    
	public function index_get($id = 0){
        if(!empty($id)){
            $data = $this->db->get_where("usuario", ['id_usuario' => $id])->row_array();
        }else{
            $data = $this->db->get("usuario")->result();
        }
        $this->response($data, REST_Controller::HTTP_OK);
	}
    
    
    public function index_post()
    {
        $input = $this->input->post();
        var_dump($input);
        $this->db->insert('usuario',$input);

        $this->response(['Usuario credo con exito'], REST_Controller::HTTP_OK);
    } 
     
    
    public function index_put($id)
    {
        $input = $this->put();
        $this->db->update('usuario', $input, array('id_usuario'=>$id));
     
        $this->response(['Usuario actualizado.'], REST_Controller::HTTP_OK);
    }
     
    
    public function index_delete($id)
    {
        $this->db->delete('usuario', array('id_usuario'=>$id));
       
        $this->response(['Usuario eliminado.'], REST_Controller::HTTP_OK);
    }
            
}
        
?>
        
                            