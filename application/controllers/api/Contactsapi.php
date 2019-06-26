<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contactsapi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Contacts_model');
        $this->load->model('Websites_model');
        $this->load->model('Telephones_model');
        $this->load->model('Emails_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $size = intval($this->input->get('size'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'api/contactsapi/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'api/contactsapi/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'api/contactsapi/index.html';
            $config['first_url'] = base_url() . 'api/contactsapi/index.html';
        }

        $config['per_page'] = ($size != 0) ? $size : 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Contacts_model->total_rows($q);
        $contacts = $this->Contacts_model->get_limit_data_array($config['per_page'], $start, $q);
		for ($i = 0; $i < count($contacts); $i++){
			$contacts[$i]['numeros'] = $this->Telephones_model->get_by_idContact($contacts[$i]['idContact']);
			$contacts[$i]['emails'] = $this->Emails_model->get_by_idContact($contacts[$i]['idContact']);
			$contacts[$i]['websites'] = $this->Websites_model->get_by_idContact($contacts[$i]['idContact']);
		}
		header('Content-Type: application/json');
        echo json_encode($contacts);
    }

    public function read($id) 
    {
        $row = $this->Contacts_model->get_by_id($id);
		header('Content-Type: application/json');
        if ($row) {
            $data = array(
				'idContact' => $row->idContact,
				'nom' => $row->nom,
				'postnom' => $row->postnom,
				'prenom' => $row->prenom,
				'cree_le' => $row->cree_le,
				'etat' => $row->etat,
				'genre' => $row->genre,
				'img_url' => $row->img_url,
			);
        } else {
        	header("HTTP/1.1 404 Not Found");
           $data = [];
        }
		echo json_encode($data);
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('contacts/create_action'),
			'idContact' => set_value('idContact'),
			'nom' => set_value('nom'),
			'postnom' => set_value('postnom'),
			'prenom' => set_value('prenom'),
			'cree_le' => set_value('cree_le'),
			'etat' => set_value('etat'),
			'genre' => set_value('genre'),
			'img_url' => set_value('img_url'),
		);

		header('Content-Type: application/json');
        echo json_encode($data);
    }
    
    public function create_action() 
    {
    	header('Content-Type: application/json');
    	try{
    		//$post = json_decode($_POST, $assoc = false, $depth = 512, $options = 0);
			var_dump($_POST);die();
    		$data = array(
				'nom' => $this->input->post('nom',TRUE),
				'postnom' => $this->input->post('postnom',TRUE),
				'prenom' => $this->input->post('prenom',TRUE),
				'cree_le' => date('Y-m-d H:i:s'),
				'etat' => 1,
				'genre' => $this->input->post('genre',TRUE),
				'img_url' => $this->input->post('img_url',TRUE),
			);
			$this->Contacts_model->insert($data);
			header("HTTP/1.1 201 Created");
			echo json_encode(['success' => true]);
		}catch (Exception $e){
    		header('HTTP/1.1 404 Not Found');
    		echo json_encode(['success' => false, 'error' => json_encode($e)]);
		}





    }
    
    public function update($id) 
    {
        $row = $this->Contacts_model->get_by_id($id);

		header('Content-Type: application/json');
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('contacts/update_action'),
				'idContact' => set_value('idContact', $row->idContact),
				'nom' => set_value('nom', $row->nom),
				'postnom' => set_value('postnom', $row->postnom),
				'prenom' => set_value('prenom', $row->prenom),
				'cree_le' => set_value('cree_le', $row->cree_le),
				'etat' => set_value('etat', $row->etat),
				'genre' => set_value('genre', $row->genre),
				'img_url' => set_value('img_url', $row->img_url),
			);
            echo json_encode($data);
        } else {
            header("HTTP/1.1 404 Not Found");
            echo json_encode([]);
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        $data = array(
			'nom' => $this->input->post('nom',TRUE),
			'postnom' => $this->input->post('postnom',TRUE),
			'prenom' => $this->input->post('prenom',TRUE),
			'cree_le' => $this->input->post('cree_le',TRUE),
			'etat' => $this->input->post('etat',TRUE),
			'genre' => $this->input->post('genre',TRUE),
			'img_url' => $this->input->post('img_url',TRUE),
	    );

		$this->Contacts_model->update($this->input->post('idContact', TRUE), $data);
		header('Content-Type: application/json');
		header("HTTP/1.1  201 Created");
		echo json_encode(['success' => true]);
    }
    
    public function delete($id) 
    {
        $row = $this->Contacts_model->get_by_id($id);

		header('Content-Type: application/json');
        if ($row) {
            $this->Contacts_model->delete($id);
            echo json_encode(['success' => true]);
        } else {
            header('HTTP/1.1 404 Not Found');
            echo json_encode(['error' => false]);
        }
    }

    public function _rules() 
    {
		$this->form_validation->set_rules('nom', 'nom', 'trim|required');
		$this->form_validation->set_rules('postnom', 'postnom', 'trim|required');
		$this->form_validation->set_rules('prenom', 'prenom', 'trim|required');
//		$this->form_validation->set_rules('cree_le', 'cree le', 'trim|required');
//		$this->form_validation->set_rules('etat', 'etat', 'trim|required');
		$this->form_validation->set_rules('genre', 'genre', 'trim|required');
		$this->form_validation->set_rules('img_url', 'img url', 'trim|required');

//		$this->form_validation->set_rules('idContact', 'idContact', 'trim');
//		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
