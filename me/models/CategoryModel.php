<?php

class CategoryModel {
    public function __construct() {
        $this->w = new Wawa();
    }
    
    public function getAll() {
        return $this->w->fetch('SELECT a.id, a.name, a.pid, b.name parent_name from categories a left join categories b on a.pid = b.id');
    }
    
    public function get($id) {
        $rows = $this->w->fetch(
            'SELECT * from categories where id = ?', 
            [$id]
        );
        return empty($rows) ? false : $rows[0];
    }    
    
    public function insert($pid, $name) {
        $sql = 'INSERT INTO `categories` (`pid`, `name`) VALUES (?, ?)';            
        $this->w->execute($sql, [$pid, $name]);
    }

    public function remove($id) {
        $this->w->execute('delete from categories where id = ?', [$id]);
    }
    
    public function update($id, $pid, $name) {        
        $this->w->execute('update categories set pid = ?, name = ? where id = ?', [$pid, $name, $id]);
    }
}    