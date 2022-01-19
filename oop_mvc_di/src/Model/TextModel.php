<?php

namespace Model;


use Framework\Model\AbstractModel;

class TextModel extends AbstractModel
{
    /**
     * @return string
     */
    public function getText() : string
    {
        $query = "SELECT text FROM textdata";

        $data = mysqli_query($this->connection, $query);

        $data = mysqli_fetch_assoc($data);

        return $data['text'];

    }
}