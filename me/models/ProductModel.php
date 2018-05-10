<?php

class ProductModel {
    public function __construct() {
        $this->w = new Wawa();
    }
    
    public function getAll($limit=10, $offset=0) {
        // PDO 有 BUG，不能参数化使用 limit 和 offset
        // https://stackoverflow.com/questions/2269840/how-to-apply-bindvalue-method-in-limit-clause
        return $this->w->fetch('SELECT * from products limit '. intval($limit) . ' offset '. intval($offset));
    }
    
    public function getCount() {
         $rows = $this->w->fetch('SELECT count(*) cnt from products');
         return intval($rows[0]['cnt']);
    }
    
    public function get($id) {
        $rows = $this->w->fetch(
            'SELECT * from products where id = ?', 
            [$id]
        );
        return empty($rows) ? false : $rows[0];
    }    
    
    public function insert($category_id, $name, $description) {
        $sql = 'INSERT INTO `products` (`category_id`, `name`, description, created_at) VALUES (?, ?, ?, ?)';
        $this->w->execute($sql, [$category_id, $name, $description, date('Y-m-d H:i:s')]);
    }

    public function remove($id) {
        $this->w->execute('delete from products where id = ?', [$id]);
    }
    
    public function update($id, $category_id, $name, $description) {        
        $this->w->execute('update products set category_id = ?, name = ?, description=? where id = ?', [$category_id, $name, $description, $id]);
    }
}    