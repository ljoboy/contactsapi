<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sf_config extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Sf_config_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'sf_config/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'sf_config/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'sf_config/index.html';
            $config['first_url'] = base_url() . 'sf_config/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Sf_config_model->total_rows($q);
        $sf_config = $this->Sf_config_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'sf_config_data' => $sf_config,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('sf_config/sf_config_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Sf_config_model->get_by_id($id);
        if ($row) {
            $data = array(
		'sf_id' => $row->sf_id,
		'sf_table' => $row->sf_table,
		'sf_field' => $row->sf_field,
		'sf_type' => $row->sf_type,
		'sf_related' => $row->sf_related,
		'sf_label' => $row->sf_label,
		'sf_desc' => $row->sf_desc,
		'sf_order' => $row->sf_order,
		'sf_hidden' => $row->sf_hidden,
	    );
            $this->load->view('sf_config/sf_config_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sf_config'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('sf_config/create_action'),
	    'sf_id' => set_value('sf_id'),
	    'sf_table' => set_value('sf_table'),
	    'sf_field' => set_value('sf_field'),
	    'sf_type' => set_value('sf_type'),
	    'sf_related' => set_value('sf_related'),
	    'sf_label' => set_value('sf_label'),
	    'sf_desc' => set_value('sf_desc'),
	    'sf_order' => set_value('sf_order'),
	    'sf_hidden' => set_value('sf_hidden'),
	);
        $this->load->view('sf_config/sf_config_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'sf_table' => $this->input->post('sf_table',TRUE),
		'sf_field' => $this->input->post('sf_field',TRUE),
		'sf_type' => $this->input->post('sf_type',TRUE),
		'sf_related' => $this->input->post('sf_related',TRUE),
		'sf_label' => $this->input->post('sf_label',TRUE),
		'sf_desc' => $this->input->post('sf_desc',TRUE),
		'sf_order' => $this->input->post('sf_order',TRUE),
		'sf_hidden' => $this->input->post('sf_hidden',TRUE),
	    );

            $this->Sf_config_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('sf_config'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Sf_config_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('sf_config/update_action'),
		'sf_id' => set_value('sf_id', $row->sf_id),
		'sf_table' => set_value('sf_table', $row->sf_table),
		'sf_field' => set_value('sf_field', $row->sf_field),
		'sf_type' => set_value('sf_type', $row->sf_type),
		'sf_related' => set_value('sf_related', $row->sf_related),
		'sf_label' => set_value('sf_label', $row->sf_label),
		'sf_desc' => set_value('sf_desc', $row->sf_desc),
		'sf_order' => set_value('sf_order', $row->sf_order),
		'sf_hidden' => set_value('sf_hidden', $row->sf_hidden),
	    );
            $this->load->view('sf_config/sf_config_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sf_config'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('sf_id', TRUE));
        } else {
            $data = array(
		'sf_table' => $this->input->post('sf_table',TRUE),
		'sf_field' => $this->input->post('sf_field',TRUE),
		'sf_type' => $this->input->post('sf_type',TRUE),
		'sf_related' => $this->input->post('sf_related',TRUE),
		'sf_label' => $this->input->post('sf_label',TRUE),
		'sf_desc' => $this->input->post('sf_desc',TRUE),
		'sf_order' => $this->input->post('sf_order',TRUE),
		'sf_hidden' => $this->input->post('sf_hidden',TRUE),
	    );

            $this->Sf_config_model->update($this->input->post('sf_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('sf_config'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Sf_config_model->get_by_id($id);

        if ($row) {
            $this->Sf_config_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('sf_config'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sf_config'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('sf_table', 'sf table', 'trim|required');
	$this->form_validation->set_rules('sf_field', 'sf field', 'trim|required');
	$this->form_validation->set_rules('sf_type', 'sf type', 'trim|required');
	$this->form_validation->set_rules('sf_related', 'sf related', 'trim|required');
	$this->form_validation->set_rules('sf_label', 'sf label', 'trim|required');
	$this->form_validation->set_rules('sf_desc', 'sf desc', 'trim|required');
	$this->form_validation->set_rules('sf_order', 'sf order', 'trim|required');
	$this->form_validation->set_rules('sf_hidden', 'sf hidden', 'trim|required');

	$this->form_validation->set_rules('sf_id', 'sf_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Sf_config.php */
/* Location: ./application/controllers/Sf_config.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-06-10 21:15:44 */
/* http://harviacode.com */