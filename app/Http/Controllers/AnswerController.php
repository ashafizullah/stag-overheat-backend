<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnswerController extends Controller
{
    //Get all answer base on questionId (one to many)
    public function index(Request $Request, $questionId){
    	//return result answer where questionId from parameter
    	return DB::table('answer')
    		->where('questionId', $questionId)
    		->get();
    }

    //post
    public function store(Request $request, $questionId){
    	$doc = $request->all(); //data from from obj state
    	$doc['questionId'] = (int)$questionId; //cast string param to integer
    	DB::table('answer')->insert($doc);
    	return response()->json('success');
    }
}
