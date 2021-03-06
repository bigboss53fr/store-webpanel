<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->model('items_model');
        $this->load->model('tools_model');

        if (!$this->ion_auth->logged_in() && $this->config->item('storewebpanel_enable_loginsystem') == 1)
        {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['page'] = 'dashboard';
        $data['version'] = $this->tools_model->get_installed_version();

        $data['top_users'] = $this->users_model->get_users(0, 'credits desc', 5);
        $data['top_items'] = $this->items_model->get_top_items(5);

        $this->load->view('parts/header', $data);
        $this->load->view('pages/dashboard/dashboard', $data);
        $this->load->view('parts/footer');
    }

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */