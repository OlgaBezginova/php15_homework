<?php


namespace Factory;


interface FactoryInterface
{
    public function create(string $type, array $arguments = []);
}