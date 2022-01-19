<?php

namespace Framework\Model;


class AbstractModel
{
    protected $connection;

    public function __construct()
    {
       $this->connection = \Framework\Database\Database::getConnection();
    }
}