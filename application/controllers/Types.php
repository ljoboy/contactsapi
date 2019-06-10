<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Types extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Types_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'types/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'types/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'types/index.html';
            $config['first_url'] = base_url() . 'types/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Types_model->total_rows($q);
        $types = $this->Types_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'types_data' => $types,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('types/types_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Types_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idType' => $row->idType,
		'nomType' => $row->nomType,
		'detailsType' => $row->detailsType,
		'idContact' => $row->idContact,
	    );
            $this->load->view('types/types_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('types'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('types/create_action'),
	    'idType' => set_value('idType'),
	    'nomType' => set_value('nomType'),
	    'detailsType' => set_value('detailsType'),
	    'idContact' => set_value('idContact'),
	);
        $this->load->view('types/types_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nomType' => $this->input->post('nomType',TRUE),
		'detailsType' => $this->input->post('detailsType',TRUE),
		'idContact' => $this->input->post('idContact',TRUE),
	    );

            $this->Types_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('types'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Types_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('types/update_action'),
		'idType' => set_value('idType', $row->idType),
		'nomType' => set_value('nomType', $row->nomType),
		'detailsType' => set_value('detailsType', $row->detailsType),
		'idContact' => set_value('idContact', $row->idContact),
	    );
            $this->load->view('types/types_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('types'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idType', TRUE));
        } else {
            $data = array(
		'nomType' => $this->input->post('nomType',TRUE),
		'detailsType' => $this->input->post('detailsType',TRUE),
		'idContact' => $this->input->post('idContact',TRUE),
	    );

            $this->Types_model->update($this->input->post('idType', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('types'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Types_model->get_by_id($id);

        if ($row) {
            $this->Types_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('types'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('types'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nomType', 'nomtype', 'trim|required');
	$this->form_validation->set_rules('detailsType', 'detailstype', 'trim|required');
	$this->form_validation->set_rules('idContact', 'idcontact', 'trim|required');

	$this->form_validation->set_rules('idType', 'idType', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Types.php */
/* Location: ./application/controllers/Types.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-06-10 21:15:44 */
/* http://harviacode.com */