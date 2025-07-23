<?php
interface ICRUD {
    public function insertSeguro($tabla, $data);
    public function select($tabla, $columnas, $condicion);
    public function updateSeguro($tabla, $data, $condiciones);
}