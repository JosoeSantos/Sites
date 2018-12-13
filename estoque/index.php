<?php
/**
 * Created by PhpStorm.
 * User: jssan
 * Date: 12/12/2018
 * Time: 15:04
 */

include '../database/model/Product.php';
include '../database/DAO/ProductDAO.php';

$dao = new ProductDAO();

if (isset($_POST)) {
    if ((isset($_POST["name"]) && !empty($_POST["name"])) &&
        (isset($_POST["desc"]) && !empty($_POST["desc"])) &&
        (isset($_POST["price"]) && !empty($_POST["price"]))
    ) {
        $mod = new Product($_POST["name"], $_POST["desc"], $_POST["price"]);
        $r = $dao->insert($mod);
        if (!$r) {
            $r = 500;
            json_encode(array("status" => $r));
        } else {
            echo json_encode(array("code" => $r->getCode(), "name" => $r->getName(), "desc" => $r->getDesc(), "price" => $r->getPrice()));
        }
    } else{
        echo json_encode(array("status" => "400"));

    }
}