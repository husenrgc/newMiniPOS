<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
  protected $table         = 'user';
  protected $useTimestamps = true;
  protected $allowedFields = ['username', 'password', 'name', 'level', 'active'];
  protected $db;

  public function __construct()
  {
    $this->db  = \Config\Database::connect();
    $this->run = $this->db->table($this->table);
  }

  public function getUser($id = null)
  {
    if ($id) {
      return $this->db->table('v_user')->getWhere(['id' => $id])->getResult();
    }
    return $this->db->table('v_user')->get()->getResult();
  }

  public function saveUser($post)
  {
    unset($post['csrf_test_name']);
    $post['password'] = md5('#c!Kst3cH'.$post['password'].'d3vTe@m');
    $post['active']   = 1;
    $this->run->insert($post);
    return $this->db->affectedRows();
  }

  public function editUser($post)
  {
    $this->run->insert($post);
    return $this->run->affectedRows();
  }

  public function delUser($post)
  {
    $this->run->insert($post);
    return $this->run->affectedRows();
  }

  public function getLevel($id = null)
  {
    if ($id) {
      return $this->db->table('user_level')->getWhere(['id' => $id])->getResult();
    }
    return $this->db->table('user_level')->get()->getResult();
  }

  public function saveLevel($post)
  {
    unset($post['csrf_test_name']);
    $post['active'] = 1;
    $this->db->table('user_level')->insert($post);
    return $this->db->affectedRows();
  }

  public function editLevel($id = null)
  {
    if ($id) {
      return $this->db->table('user_level')->getWhere(['id' => $id])->getResult();
    }
    return $this->db->table('user_level')->get()->getResult();
  }

  public function delLevel($id = null)
  {
    if ($id) {
      return $this->db->table('user_level')->getWhere(['id' => $id])->getResult();
    }
    return $this->db->table('user_level')->get()->getResult();
  
  }
  public function cekUName($uname)
  {
    $res = $this->run->where('username', $uname)->get()->resultID;
    return $res->num_rows;
  }
}
