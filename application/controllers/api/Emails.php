<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Emails extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Emails_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'emails/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'emails/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'emails/index.html';
            $config['first_url'] = base_url() . 'emails/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Emails_model->total_rows($q);
        $emails = $this->Emails_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'emails_data' => $emails,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('emails/emails_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Emails_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idEmail' => $row->idEmail,
		'email' => $row->email,
		'idContact' => $row->idContact,
	    );
            $this->load->view('emails/emails_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('emails'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('emails/create_action'),
	    'idEmail' => set_value('idEmail'),
	    'email' => set_value('email'),
	    'idContact' => set_value('idContact'),
	);
        $this->load->view('emails/emails_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'email' => $this->input->post('email',TRUE),
		'idContact' => $this->input->post('idContact',TRUE),
	    );

            $this->Emails_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('emails'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Emails_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('emails/update_action'),
		'idEmail' => set_value('idEmail', $row->idEmail),
		'email' => set_value('email', $row->email),
		'idContact' => set_value('idContact', $row->idContact),
	    );
            $this->load->view('emails/emails_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('emails'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idEmail', TRUE));
        } else {
            $data = array(
		'email' => $this->input->post('email',TRUE),
		'idContact' => $this->input->post('idContact',TRUE),
	    );

            $this->Emails_model->update($this->input->post('idEmail', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('emails'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Emails_model->get_by_id($id);

        if ($row) {
            $this->Emails_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('emails'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('emails'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('idContact', 'idcontact', 'trim|required');

	$this->form_validation->set_rules('idEmail', 'idEmail', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Emails.php */
/* Location: ./application/controllers/Emails.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-06-10 21:15:44 */
/* http://harviacode.com */