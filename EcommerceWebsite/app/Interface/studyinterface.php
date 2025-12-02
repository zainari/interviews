<?php

namespace App\Interface;

interface studyinterface
{
    public function all();
    public function find($id);
    public function create(array $data);
}
