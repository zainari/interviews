<?php 

namespace App\Repositories;
use App\Interface\studyinterface;
use App\Models\Study;

class studyRepositry implements studyinterface
{
    public function all()
    {
        // return Study::all();
    }

    public function find($id)
    {
        // return Study::find($id);
    }

    public function create(array $data)
    {
        // return Study::create($data);
    }
}