<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        if ($data['user']['role_id'] == 1) {
            redirect('User/admin');
        } elseif ($data['user']['role_id'] == 2) {
            redirect('User/member');
        }
        //echo "Selamat datang " . $data['user']['name'];
    }

    public function admin()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        $bonus = $this->db->get_where('data', ['id' => 1])->row_array();
        $buruh = $this->db->get_where('buruh', ['is_active' => 1])->result_array();

        //untuk data bonus
        $data['pembayaran'] = $bonus['pembayaran'];
        $data['buruhA'] = $buruh[0]['bonus'];
        $data['buruhB'] = $buruh[1]['bonus'];
        $data['buruhC'] = $buruh[2]['bonus'];

        //untuk identitas buruh
        $data['buruh1'] = $buruh[0];
        $data['buruh2'] = $buruh[1];
        $data['buruh3'] = $buruh[2];

        //untuk proporsi bonus buruh
        $data['bonus1'] = ($data['buruhA'] / 100) * $data['pembayaran'];
        $data['bonus2'] = ($data['buruhB'] / 100) * $data['pembayaran'];
        $data['bonus3'] = ($data['buruhC'] / 100) * $data['pembayaran'];

        $data['nama_user'] = $data['user']['name'];
        $data['title'] = 'Admin Page';
        $this->load->view('templates/user_header', $data);
        $this->load->view('user/admin');
        $this->load->view('templates/user_footer');
    }

    public function member()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        $bonus = $this->db->get_where('data', ['id' => 1])->row_array();
        $buruh = $this->db->get_where('buruh', ['is_active' => 1])->result_array();

        //untuk data bonus
        $data['pembayaran'] = $bonus['pembayaran'];
        $data['buruhA'] = $buruh[0]['bonus'];
        $data['buruhB'] = $buruh[1]['bonus'];
        $data['buruhC'] = $buruh[2]['bonus'];

        //untuk identitas buruh
        $data['buruh1'] = $buruh[0];
        $data['buruh2'] = $buruh[1];
        $data['buruh3'] = $buruh[2];

        //untuk proporsi bonus buruh
        $data['bonus1'] = ($data['buruhA'] / 100) * $data['pembayaran'];
        $data['bonus2'] = ($data['buruhB'] / 100) * $data['pembayaran'];
        $data['bonus3'] = ($data['buruhC'] / 100) * $data['pembayaran'];

        $data['nama_user'] = $data['user']['name'];
        $data['title'] = 'Member Page';
        $this->load->view('templates/member_header', $data);
        $this->load->view('user/member');
        $this->load->view('templates/user_footer');
    }

    public function update_pembayaran()
    {
        $pembayaran = $this->input->post('pembayaran');
        $buruhA = $this->input->post('buruhA');
        $buruhB = $this->input->post('buruhB');
        $buruhC = $this->input->post('buruhC');

        $total = $buruhA + $buruhB + $buruhC;
        if ($total != 100) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Proporsi Pembagian Bonus Salah! Semua harus berjumlah 100 </div>');
            redirect('User/admin');
        } else {
            $data = [
                'pembayaran' => htmlspecialchars($pembayaran)
            ];

            $data1 = [
                'bonus' => htmlspecialchars($buruhA)
            ];

            $data2 = [
                'bonus' => htmlspecialchars($buruhB)
            ];

            $data3 = [
                'bonus' => htmlspecialchars($buruhC)
            ];


            $this->db->update('data', $data);

            $this->db->where('id', 1);
            $this->db->update('buruh', $data1);

            $this->db->where('id', 2);
            $this->db->update('buruh', $data2);

            $this->db->where('id', 3);
            $this->db->update('buruh', $data3);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Berhasil memperbarui data bonus</div>');
            redirect('User/admin');
        }
    }

    public function registration()
    {
        //form validasi
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]|matches[password2]', [
            'matches' => 'password not match!',
            'min_length' => 'password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
            'matches' => 'password not match!'
        ]);

        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        if ($this->form_validation->run() == false && $data['user']['role_id'] != 1) {
            $data['nama_user'] = $data['user']['name'];
            $data['title'] = 'Admin Page';
            $this->load->view('templates/user_header', $data);
            $this->load->view('user/newuser');
            $this->load->view('templates/user_footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Berhasil mendaftarkan user!</div>');
            redirect('user/admin');
        }
    }

    public function regis_page()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $data['nama_user'] = $data['user']['name'];
        $data['title'] = 'Admin Page';
        $this->load->view('templates/user_header', $data);
        $this->load->view('user/newuser');
        $this->load->view('templates/user_footer');
    }

    public function list_user()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $data['nama_user'] = $data['user']['name'];

        $data['userlist'] =
            $this->db->get_where('user', ['is_active' => 1])->result_array();

        $data['title'] = 'List user';
        $this->load->view('templates/user_header', $data);
        $this->load->view('user/listuser');
        $this->load->view('templates/user_footer');
    }

    public function list_buruh()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $data['buruhlist'] =
            $this->db->get_where('buruh', ['is_active' => 1])->result_array();
        $data['nama_user'] = $data['user']['name'];
        $data['title'] = 'List buruh';
        $this->load->view('templates/user_header', $data);
        $this->load->view('user/listburuh');
        $this->load->view('templates/user_footer');
    }

    public function deleteuser($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');
        redirect('user/list_user');
    }

    public function deleteburuh($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('buruh');
        redirect('user/list_buruh');
    }
}
