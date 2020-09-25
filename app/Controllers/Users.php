<?php

namespace App\Controllers;

class Users extends BaseController
{
  protected $userModel;
  public function __construct()
  {
    // helper('form');
    $this->val       = \Config\Services::validation();
    $this->userModel = new \App\Models\UserModel();
  }
  //----------------------------------------------- CRUD MODULE -----------------------------------------------//
  public function index()
  {
    $data = [
      'pageTitle' => 'Data User',
      'users'     => $this->userModel->getUser(),
      'levels'    => $this->userModel->getLevel()
    ];
    return view('user', $data);
    // dd($data);
  }
  public function getUser()
  {
    return json_encode($this->userModel->getUser($this->request->getPost('id')));
  }
  
  public function addUser()
  {
    $post    = $this->request->getPost();
    unset($post['csrf_test_name']);
    $respond = $this->userModel->saveUser($post);
    // var_dump($respond);
    //format flash data (base color | fontawesome icon | flashdata message)
    ($respond > 0) ? session()->setFlashdata('msg', 'success|check|Data user berhasil ditambahkan') :
    session()->setFlashdata('msg', 'danger|ban|Data user gagal ditambahkan');
    
    return redirect()->to(base_url().'/users');
  }

  public function editUser($id)
  {
    //formval
    $old = $this->userModel->getUser($id);
    // dd($old[0]->name);
    $rules = ($old[0]->username == $this->request->getPost('username')) ? 'required' : 'required|is_unique[user.username]';

    if (!$this->validate([
      'username' => [
        'rules' => $rules,
        'errors' => [
          'is_unique' => 'Username sudah terdaftar'
        ]
      ]
    ])) {
      return redirect()->to(base_url() . '/users')->withInput()->with('validation', $this->val);
    }

    $post       = $this->request->getPost();
    $post['id'] = $id;
    unset($post['csrf_test_name']);
    $respond = $this->userModel->editUser($id, $post);
    ($respond > 0) ? session()->setFlashdata('msg', 'success|check|Data user berhasil diubah') :
    session()->setFlashdata('msg', 'danger|ban|Data user gagal diubah');

    return redirect()->to(base_url() . '/users');
  }

  public function delUser()
  {
    $post    = $this->request->getPost();
    unset($post['csrf_test_name']);
    $respond = $this->userModel->delUser($post);
    ($respond > 0) ? session()->setFlashdata('msg', 'danger|ban|Data user gagal dihapus') :
    session()->setFlashdata('msg', 'success|check|Data user berhasil dihapus');
    return redirect()->to(base_url() . '/users');
  }

  public function level()
  {
    session();
    $data = [
      'pageTitle'  => 'Data Level User',
      'levels'     => $this->userModel->getLevel(),
      'validation' => \Config\Services::validation()
    ];
    return view('user_level', $data);
  }

  public function getLevel()
  {
    return json_encode($this->userModel->getLevel($this->request->getPost('id')));
  }

  public function addUserLevel()
  {
    //formval
    if (!$this->validate([
      'name' => [
        'rules'  => 'required|is_unique[user_level.name]',
        'errors' => [
          'is_unique' => 'Nama level sudah terdaftar'
        ]
      ]
    ])) {
      return redirect()->to(base_url() . '/users/level')->withInput()->with('validation', $this->val);
    }

    $post    = $this->request->getPost();
    unset($post['csrf_test_name']);
    $respond = $this->userModel->saveLevel($post);
    // var_dump($respond);
    //format flash data (base color | fontawesome icon | flashdata message)
    ($respond > 0) ? session()->setFlashdata('msg', 'success|check|Data level user berhasil ditambahkan') :
      session()->setFlashdata('msg', 'danger|ban|Data level user gagal ditambahkan');

    return redirect()->to(base_url() . '/users/level');
  }

  public function editUserLevel($id)
  {
    //formval
    $old = $this->userModel->getLevel($id);
    // dd($old[0]->name);
    $rules = ($old[0]->name == $this->request->getPost('name'))? 'required' : 'required|is_unique[user_level.name]' ;
    
    if (!$this->validate([
      'name' => [
        'rules'  => $rules,
        'errors' => [
          'is_unique' => 'Nama level sudah terdaftar'
        ]
      ]
    ])) {
      return redirect()->to(base_url() . '/users/level')->withInput()->with('validation', $this->val);
    }

    $post       = $this->request->getPost();
    $post['id'] = $id;
    unset($post['csrf_test_name']);
    $respond = $this->userModel->editLevel($id,$post);
    ($respond > 0) ? session()->setFlashdata('msg', 'success|check|Data level user berhasil diubah') :
    session()->setFlashdata('msg', 'danger|ban|Data level user gagal diubah');

    return redirect()->to(base_url() . '/users/level');
  }

  public function delUserLevel()
  {
    $post = $this->request->getPost();
    unset($post['csrf_test_name']);
    // dd($post);
    $respond = $this->userModel->delLevel($post);
    ($respond > 0) ? session()->setFlashdata('msg', 'danger|ban|Data level user gagal dihapus') :
    session()->setFlashdata('msg', 'success|check|Data level user berhasil dihapus');
    return redirect()->to(base_url() . '/users/level');
  }
  //----------------------------------------------- ADDITIONAL MODULE -----------------------------------------------//
  public function cekUsername()
  {
    if (is_numeric($this->request->getPost('id'))) {
      $old = $this->userModel->cekUName($this->request->getPost('username'), $this->request->getPost('id'));
      if ($old > 0) {
        return 'OK';
      } else {
        $uName = $this->userModel->cekUName($this->request->getPost('username'));
        if ($uName > 0) {
          return 'ERROR';
        }
        return 'OK';
      }
    } else {
      $uName = $this->userModel->cekUName($this->request->getPost('username'));
      // return var_dump($uName);
      if ($uName > 0) {
        return 'ERROR';
      }
      return 'OK';
    }
  }
}
