<?php
/**
 * Created by PhpStorm.
 * User: jssan
 * Date: 11/12/2018
 * Time: 11:52
 */
class Product {
    private $code;
    private $name;
    private $desc;
    private $price;

    /**
     * Product constructor.
     * @param $code
     * @param $name
     * @param $desc
     * @param $price
     */
    public function __construct( $name, $desc, $price, $code = NULL) {
        $this->code = $code;
        $this->name = $name;
        $this->desc = $desc;
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getCode() {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code) {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDesc() {
        return $this->desc;
    }

    /**
     * @param mixed $desc
     */
    public function setDesc($desc) {
        $this->desc = $desc;
    }

    /**
     * @return mixed
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price) {
        $this->price = $price;
    }


}