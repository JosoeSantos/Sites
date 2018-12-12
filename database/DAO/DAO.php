<?php
/**
 * Created by PhpStorm.
 * User: jssan
 * Date: 11/12/2018
 * Time: 21:00
 */

interface DAO {

    /**
     * Interface que define metodos obrigatorios de cada DAO
     * */

    function insert($MODEL);

    function delete($MODEL);

    function update($MODEL);

    function selectAll();

    function selectItem($ID);
}