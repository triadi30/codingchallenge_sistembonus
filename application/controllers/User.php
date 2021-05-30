<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        if ($data['user']['role_id'] != 1 && $data['user']['role_id'] != 2) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Anda Harus Login Dulu ! </div>');
            redirect('');
        }
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        if ($data['user']['role_id'] == 1) {
            $this->_admin();
            // redirect('User');
        } elseif ($data['user']['role_id'] == 2) {
            $this->_member();
            // redirect('User/member');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Anda Harus Login Dulu ! </div>');
            redirect('');
        }
        //echo "Selamat datang " . $data['user']['name'];
    }

    private function _admin()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        $bonus = $this->db->get_where('data', ['id' => 1])->row_array();
        $buruh = $this->db->get_where('buruh', ['is_active' => 1])->result_array();

        $data['pembayaran'] = $bonus['pembayaran'];
        $data['buruh'] = $buruh;
        $data['nama_user'] = $data['user']['name'];
        $data['title'] = 'Admin Page';
        $this->load->view('templates/user_header', $data);
        $this->load->view('user/admin');
        $this->load->view('templates/user_footer');
    }

    private function _member()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        $bonus = $this->db->get_where('data', ['id' => 1])->row_array();
        $buruh = $this->db->get_where('buruh', ['is_active' => 1])->result_array();

        $data['pembayaran'] = $bonus['pembayaran'];
        $data['buruh'] = $buruh;
        $data['nama_user'] = $data['user']['name'];
        $data['title'] = 'Member Page';
        $this->load->view('templates/member_header', $data);
        $this->load->view('user/member');
        $this->load->view('templates/user_footer');
    }

    public function update_pembayaran()
    {
        $pembayaran = $this->input->post('pembayaran');

        $this->db->like('is_active', 1);
        $this->db->from('buruh');
        $jumlah_buruh =  $this->db->count_all_results();
        $data_buruh = $this->db->get_where('buruh', ['is_active' => 1])->result_array();
        $total = 0;

        for ($i = 0; $i < $jumlah_buruh; $i++) {
            $id_buruh = $data_buruh[$i]['id'];
            $buruh = $this->input->post($id_buruh);
            $total += $buruh;
        }

        if ($total != 100) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Proporsi Pembagian harus berjumlah 100 % !</div>');
            redirect('User');
        } else {
            $data = [
                'pembayaran' => htmlspecialchars($pembayaran)
            ];
            $this->db->update('data', $data);

            $this->db->like('is_active', 1);
            $this->db->from('buruh');
            $jumlah_buruh =  $this->db->count_all_results();
            $data_buruh = $this->db->get_where('buruh', ['is_active' => 1])->result_array();

            for ($i = 0; $i < $jumlah_buruh; $i++) {
                $id_buruh = $data_buruh[$i]['id'];
                $buruh = $this->input->post($id_buruh);
                $data = [
                    'bonus' => htmlspecialchars($buruh)
                ];

                $this->db->where('id', $id_buruh);
                $this->db->update('buruh', $data);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Berhasil</strong> memperbarui data bonus
            </div>');
            redirect('User');
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
            redirect('User/regis_page');
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
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        $userr = $this->db->get_where('user', ['id' => $id])->row_array();

        if ($data['user']['email'] == $userr['email']) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Gagal</strong> menghapus data user. Anda sedang login dengan akun tersebut !
                </div>');
            redirect('user/list_user');
        } else {
            $this->db->where('id', $id);
            $this->db->delete('user');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Berhasil</strong> menghapus data user
        </div>');
            redirect('user/list_user');
        }
    }

    public function deleteburuh($id)
    {
        $buruh = $this->db->get_where('buruh', ['id' => $id])->row_array();
        if ($buruh['bonus'] != 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Gagal</strong> menghapus data buruh. Data Bonus Buruh haru 0% dulu !
                </div>');
            redirect('user/list_buruh');
        } else {
            $this->db->where('id', $id);
            $this->db->delete('buruh');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Berhasil</strong> menghapus data buruh
                </div>');
            redirect('user/list_buruh');
        }
    }

    public function regisburuh()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'posisi' => htmlspecialchars($this->input->post('posisi', true)),
            'bonus' => 0,
            'is_active' => 1
        ];

        $this->db->insert('buruh', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Berhasil</strong> menambahkan data buruh
        </div>');
        redirect('user/list_buruh');
    }

    public function updateburuh($id)
    {
        $data = [
            'id' => htmlspecialchars($this->input->post('id', true)),
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'posisi' => htmlspecialchars($this->input->post('posisi', true)),
            'bonus' => htmlspecialchars($this->input->post('bonus', true)),
            'is_active' => 1
        ];

        $this->db->where('id', $id);
        $this->db->update('buruh', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Berhasil</strong> memperbarui data buruh
        </div>');
        redirect('user/list_buruh');
    }
}
