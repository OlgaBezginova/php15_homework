<?php

interface ObjectManagerInterface
{
    public function get(string $type, array $data = []);

    public function create(string $type, array $data = []);
}