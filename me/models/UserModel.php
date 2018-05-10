<?php
// 用户数据操作
class UserModel {
    public function __construct() {
        $this->w = new Wawa();
    }
    
    // 获取所有用户
    public function getAll() {
        return $this->w->fetch('SELECT * from users');
    }
    
    // 根据用户 ID 获取一个用户
    public function get($id) {
        $rows = $this->w->fetch(
            'SELECT * from users where id = ?', 
            [$id]
        );
        return empty($rows) ? false : $rows[0];
    }
    
    // 插入一条用户数据
    public function insert($username, $nickname, $password) {
        $sql = 'INSERT INTO `users` ' . 
            '(`username`, `nickname`, `password`, `created_at`) '.
            'VALUES (?, ?, ?, ?)';
            
        $this->w->execute($sql, [
            $username,
            $nickname,
            $password,
            date('Y-m-d H:i:s')
        ]);
    }
    
    // 根据用户 ID 修改一个用户
    public function update($id, $nickname, $password) {
        $this->w->execute(
            'update users set nickname=?, password=? where id = ?', 
            [$nickname, $password, $id]
        );
    }
    
    // 根据用户 ID 删除一个用户
    public function remove($id) {
        $this->w->execute('delete from users where id = ?', [$id]);
    }
}