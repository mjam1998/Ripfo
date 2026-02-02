<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class WriterController extends Controller
{
    public function index(){
        return view('panel.writer.index');
    }
    public function article(){
        $jurors = User::role('juror')
            ->where('id', '!=', auth()->id())
            ->get();
        return view('panel.writer.article', compact('jurors'));
    }
}
