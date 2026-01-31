<?php

namespace App\Http\Controllers;

use App\Enums\AcademicRank;
use App\Enums\Education;
use App\Enums\Title;
use App\Models\EducationFiled;
use Illuminate\Http\Request;

class FrontController extends Controller
{
   public function index(){
       return view('front.index');
   }
   public function login(){
       return view('front.login');
   }
   public function register(){
       return view('front.register', [
           'titles' => Title::cases(),
           'educations' => Education::cases(),
           'academicRanks' => AcademicRank::cases(),
           'educationFields' => EducationFiled::all(),
       ]);
   }
}
