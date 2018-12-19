<?php
/**
 * Created by PhpStorm.
 * User: jssan
 * Date: 12/12/2018
 * Time: 15:04
 */

include '../database/model/Product.php';
include '../database/DAO/ProductDAO.php';

$method = $_SERVER['REQUEST_METHOD'];


$dao = new ProductDAO();

if (isset($_POST) && !empty($_POST)) {
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
    } else {
        echo json_encode(array("status" => "400"));

    }
} else if (isset($_GET) && !empty($_GET)) {
    if (
    (isset($_GET["code"]) && !empty($_GET["code"]))) {
        $rows = $dao->selectItem($_GET["code"]);
        if ($rows) {
            $r = $rows->fetch_assoc();
            echo json_encode($r);
        } else {
            echo json_encode(array("status" => 500));
        }
    } else {
        $rows = $dao->selectAll();
        $r = array();
        if ($rows) {
            while ($row = $rows->fetch_assoc()) {
                array_push($r, $row);
            }
            echo json_encode($r);
        } else {
            echo json_encode(array("status" => 500));
        }
    }
} else if ('PUT' === $method) {
    parse_str(file_get_contents('php://input'), $_PUT);
    if ((isset($_PUT["name"]) && !empty($_PUT["name"])) &&
        (isset($_PUT["code"]) && !empty($_PUT["code"])) &&
        (isset($_PUT["desc"]) && !empty($_PUT["desc"])) &&
        (isset($_PUT["price"]) && !empty($_PUT["price"]))
    ) {
        $r = $dao->insert(new Product($_PUT["name"], $_PUT["desc"], $_PUT["price"], $_PUT["code"]));
        if ($r) {
            echo json_encode(array("code" => $r->getCode(), "name" => $r->getName(), "desc" => $r->getDesc(), "price" => $r->getPrice()));
        } else {
            echo json_encode(array("status" => 500));
        }
    } else {
        echo json_encode(array("status" => 400));
    }
} else {
    echo json_encode(array("status" => 400));
}