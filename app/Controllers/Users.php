<?php

namespace App\Controllers;

class Users extends BaseController
{
  protected $userModel;
  public function __construct()
  {
    helper('form');
    $this->form_validation = \Config\Services::validation();
    $this->userModel       = new \App\Models\UserModel();
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
  
  public function addUser()
  {
    $post    = $this->request->getPost();
    $respond = $this->userModel->saveUser($post);
    // var_dump($respond);
    //format flash data (base color | fontawesome icon | flashdata message)
    ($respond > 0) ? session()->setFlashdata('msg', 'success|check|Data user berhasil ditambahkan') :
    session()->setFlashdata('msg', 'danger|ban|Data user gagal ditambahkan');
    
    return redirect()->to(base_url().'/users');
  }

  public function editUser()
  {
  }

  public function delUser()
  {
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
      $val = \Config\Services::validation();
      return redirect()->to(base_url() . '/users/level')->withInput()->with('validation', $val);
    }

    $post    = $this->request->getPost();
    $respond = $this->userModel->saveLevel($post);
    // var_dump($respond);
    //format flash data (base color | fontawesome icon | flashdata message)
    ($respond > 0) ? session()->setFlashdata('msg', 'success|check|Data level user berhasil ditambahkan') :
      session()->setFlashdata('msg', 'danger|ban|Data level user gagal ditambahkan');

    return redirect()->to(base_url() . '/users/level');
  }

  public function editUserLevel()
  {
  }

  public function delUserLevel()
  {
  }
  //----------------------------------------------- ADDITIONAL MODULE -----------------------------------------------//
  public function cekUsername()
  {
    $uName = $this->userModel->cekUName($this->request->getPost('username'));
    // return var_dump($uName);
    if ($uName>0) {
      if ($uName == session('username')) {
        return 'OK';
      }
      return 'ERROR';
    }
    return 'OK';
  }
}
