<?php
/**
 * Created by PhpStorm.
 * User: jssan
 * Date: 11/12/2018
 * Time: 11:54
 */


include_once ("../model");
include_once ("../DatabaseManager.php");

class ProductDAO extends DatabaseManager {


    /**
     * ProductDAO constructor.
     */
    public function __construct() {
        parent::__construct();
    }

    function insert(Product $MODEL) {
        $stmt = $this->conn->prepare("INSERT INTO products(name, `desc`, price) VALUES (?,?,?)");
        $stmt->bind_param('ssd', $MODEL->getName(), $MODEL->getDesc(), $MODEL->getPrice());
        if ($stmt->execute()) {
            $MODEL->setCode($this->conn->insert_id);
            $stmt->close();
            return $MODEL;
        } else {
            $t = date("d/m/y h:m:s");
            self::log("INSERT ON PRODUCTS ({$t}):");
            self::log($this->conn->error);
            $stmt->close();
            return 0;
        }
    }

    function delete(Product $MODEL) {
        $id = $MODEL->getCode();
        $stmt = $this->conn->prepare("DELETE FROM products WHERE prodct_code=? ;");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $stmt->close();
            return $id;
        } else {
            $stmt->close();
            $t = date("d/m/y h:m:s");
            self::log("DELETE ON PRODUCTS ({$t}):");
            self::log($this->conn->error);
            return 0;
        }
    }

    function update(Product $MODEL) {
        $stmt = $this->conn->prepare("UPDATE products  SET `name`=? ,`desc`=?, price=? WHERE prodct_code=? ;");
        $stmt->bind_param('ssdi', $MODEL->getName(), $MODEL->getDesc(), $MODEL->getPrice(), $MODEL->getCode());
        if ($stmt->execute()) {
            $stmt->close();
            return $MODEL;
        } else {
            $t = date("d/m/y h:m:s");
            self::log("UPDATE ON PRODUCTS ({$t}):");
            self::log($this->conn->error);
            $stmt->close();
            return 0;
        }
    }

    function selectAll() {
        $r = $this->conn->query("SELECT * FROM products");
        if (!$r) {
            $t = date("d/m/y h:m:s");
            self::log("SELECT ON PRODUCTS ({$t}):");
            self::log($this->conn->error);
        }
        return $r;
    }

    function selectItem($id) {
        $r = "SELECT * FROM products WHERE prodct_code={$id}";
        if (!$r) {
            $t = date("d/m/y h:m:s");
            self::log("SELECT id ON PRODUCTS ({$t}):");
            self::log($this->conn->error);
        }
        return $r;
    }
}