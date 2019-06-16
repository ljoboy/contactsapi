<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contacts extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Contacts_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
		$size = intval($this->input->get('size'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'contacts/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'contacts/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'contacts/index.html';
            $config['first_url'] = base_url() . 'contacts/index.html';
        }

        $config['per_page'] = ($size != 0) ? $size : 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Contacts_model->total_rows($q);
        $contacts = $this->Contacts_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'contacts_data' => $contacts,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('contacts/contacts_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Contacts_model->get_by_id($id);
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
            $this->load->view('contacts/contacts_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('contacts'));
        }
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
        $this->load->view('contacts/contacts_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nom' => $this->input->post('nom',TRUE),
		'postnom' => $this->input->post('postnom',TRUE),
		'prenom' => $this->input->post('prenom',TRUE),
		'cree_le' => $this->input->post('cree_le',TRUE),
		'etat' => $this->input->post('etat',TRUE),
		'genre' => $this->input->post('genre',TRUE),
		'img_url' => $this->input->post('img_url',TRUE),
	    );

            $this->Contacts_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('contacts'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Contacts_model->get_by_id($id);

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
            $this->load->view('contacts/contacts_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('contacts'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idContact', TRUE));
        } else {
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
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('contacts'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Contacts_model->get_by_id($id);

        if ($row) {
            $this->Contacts_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('contacts'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('contacts'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nom', 'nom', 'trim|required');
	$this->form_validation->set_rules('postnom', 'postnom', 'trim|required');
	$this->form_validation->set_rules('prenom', 'prenom', 'trim|required');
	$this->form_validation->set_rules('cree_le', 'cree le', 'trim|required');
	$this->form_validation->set_rules('etat', 'etat', 'trim|required');
	$this->form_validation->set_rules('genre', 'genre', 'trim|required');
	$this->form_validation->set_rules('img_url', 'img url', 'trim|required');

	$this->form_validation->set_rules('idContact', 'idContact', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Contacts.php */
/* Location: ./application/controllers/Contacts.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-06-10 21:15:43 */
/* http://harviacode.com */
