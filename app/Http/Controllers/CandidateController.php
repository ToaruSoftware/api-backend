<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use App\Models\Candidate;

class CandidateController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {

        if (Cache::has('candidates')){
            $candidates = Cache::get('candidates');
        }else{

            if (Auth::user()->role != 'manager'){
                $candidates = Candidate::all()->where('owner', Auth::user()->id);
            }else{
                $candidates = Candidate::all();
            }
            Cache::put('candidates', $candidates, 60);

        }

        return $candidates;
    }

    public function store(Request $request)
    {

        if (Auth::user()->role == 'agent'){
            return response()->json(['meta' => [
                'success' => false,
                'errors' => [
                    'Token expired'
                ]
            ]], 401);
        }

        $candidate = new Candidate();
        $candidate->name = $request->name;
        $candidate->source = $request->source;
        $candidate->owner = $request->owner;
        $candidate->created_by = Auth::user()->id;
        $candidate->save();

        return response()->json(
            [
            'meta' => [
                'success' => true,
                'errors' => []
            ],
            'data' => $candidate
        ], 201);
    }

    public function show($id)
    {

        $candidate = Candidate::find($id);

        if (!$candidate){
            return response()->json(['meta' => [
                'success' => false,
                'errors' => [
                    'No lead found'
                ]
            ]], 401);
        }

        return $candidate;
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
