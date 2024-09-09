<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class MenuController extends Controller
{
    use LivewireAlert;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function check_folder_name(Request $request)
    {
        $folder = Folder::where('name', $request->section_name)->count();

        if ($folder) {
            $response = Response::make('This name is already taken', 201);
        } else {
            $response = Response::make('OK', 200);
        }

        $response->header('Content-Type', 'text/plain');
        return $response;
    }

    public function section_store(Request $request)
    {
        // dd($request);
        try {
            $request->validate([
                'section_name' => 'required|unique:folders,name',
            ]);

            DB::beginTransaction();

            $root = new Folder();

            $root->name = $request->section_name;
            $root->status = 1;
            $root->created_by = Auth::user()->id;
            $root->save();

            $root->newActivity($root->id, $root->name);

            DB::commit();

            return redirect($request->curent_link);
        } catch (\Throwable $th) {
            return $errors = $th->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
