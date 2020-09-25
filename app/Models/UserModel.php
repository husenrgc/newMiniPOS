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
    $post['password'] = md5('#c!Kst3cH'.$post['password'].'d3vTe@m');
    $post['active']   = 1;
    $this->run->insert($post);
    return $this->db->affectedRows();
  }

  public function editUser($id, $post)
  {
    if ($post['password']) {
      $post['password'] = md5('#c!Kst3cH' . $post['password'] . 'd3vTe@m');
    } else {
      unset($post['password']);
    }
    $post['updated_at'] = date('Y-m-d H:i:s');
    $this->run->update($post, array('id' => $id));
    return $this->db->affectedRows();
  }

  public function delUser($id)
  {
    $this->run->delete($id);
    return count($this->getUser($id));
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
    $post['active'] = 1;
    $this->db->table('user_level')->insert($post);
    return $this->db->affectedRows();
  }

  public function editLevel($id, $post)
  {
    $post['updated_at'] = date('Y-m-d H:i:s');
    $this->db->table('user_level')->update($post, array('id' => $id));
    return $this->db->affectedRows();
  }

  public function delLevel($id)
  {
    $this->db->table('user_level')->delete($id);
    return count($this->getLevel($id));
  }
  public function cekUName($uname, $oldId = null)
  {
    if ($oldId) {
      $res = $this->run->where(['username' => $uname, 'id' => $oldId])->get()->resultID;
      return $res->num_rows;
    } else {
      $res = $this->run->where('username', $uname)->get()->resultID;
      return $res->num_rows;
    }
  }
}
