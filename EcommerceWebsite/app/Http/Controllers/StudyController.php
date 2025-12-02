<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\studyRepositry;

class StudyController extends Controller

{
    protected $studyRepository;
    
    public function __construct(studyRepositry $studyRepository)
    {
        $this->studyRepository = $studyRepository;
    }

    public function index()
    {
        $studies = $this->studyRepository->all();
        return view('studies.index', compact('studies'));
    }

    public function show($id)
    {
        $study = $this->studyRepository->find($id);
        return view('studies.show', compact('study'));
    }
}
