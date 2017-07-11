<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    /*public function index(){
        return DB::table('questions')->get();
    }*/

    public function index(Request $request){
        //get ?search=search as request if exists, else empty string("")
        $search = $request->query()?$request->query()['search']:"";

        //return result like title or like description
        return DB::table('questions')
            ->where('title', 'like', $search.'%')
            ->orWhere('description', 'like', $search.'%')
            ->get();
    }

    public function show($id){
        $question = DB::table('questions')
            -> where('id', $id)
            -> first();

        return response()->json($question);
    }

    public function store(Request $request){
        $doc = $request->all();
        DB::table('questions')->insert($doc);
    }

    public function update(Request $request, $id){
        $doc = $request->all();
        DB::table('questions')
            ->where('id', $id)
            ->update($doc);

        return response()->json("success");
    }

    public function destroy($id){
        return response()->json("delete question with id = ".$id);
    }
}
