<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\FileShare;
use Carbon\Carbon;
use ConvertApi\ConvertApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
    }

    public function share_by_link($id)
    {
        $share = FileShare::find($id);
        $expiration = $share->expires_at ? true : false;

        $expire = $expiration ? Carbon::parse($share->expires_at)->diffInMinutes(now()) : -1;

        if ($share->count() && ($expire <= 0) && $share->by_link) {
            // dd('ok');
            $file = File::find($share->file_id);

            // dd($file->createdBy->email);
            return view('share.by_link', compact('share', 'file'));

            // $file = storage_path('app/public/uploads/' . $file->id . '/') . "" . $file->name . "";
            // return response()->file($file);
        } else {
            return view('error.404');
        }
    }

    public function download($id)
    {
        $share = FileShare::find($id);

        if ($share) {
            $expiration = $share->expires_at ? true : false;
            $expire = $expiration ? Carbon::parse($share->expires_at)->diffInMinutes(now()) : -1;

            if ($share->count() && ($expire <= 0)) {
                $file = File::find($share->file_id);

                $file = storage_path('app/public/uploads/' . $file->id . '/') . "" . $file->name . "";
                return response()->file($file);
            } else {
                return view('error.404');
            }
        } else {
            $file = File::find($id);

            $file = storage_path('app/public/uploads/' . $file->id . '/') . "" . $file->name . "";
            return response()->file($file);
            // return view('error.404');
        }
    }

    public function preview($id)
    {
        $share = FileShare::find($id);
        $expiration = $share->expires_at ? true : false;
        $expire = $expiration ? Carbon::parse($share->expires_at)->diffInMinutes(now()) : -1;

        if ($share->count() && ($expire <= 0)) {
            $file = File::find($share->file_id);

            $file = storage_path('app/public/uploads/' . $file->id . '/') . "" . $file->name . "";
            return response()->file($file); // harusnya view only pake third party
        } else {
            return view('error.404');
        }
    }

    public function preview_admin($id)
    {
        $file = File::find($id);

        $path = storage_path('app/public/' . $file->attachment->file);
        return response()->file($path);
        // $link = Storage::url('app/public/' . $file->attachment->file);
        // return $link;
    }

    public function convertJPG($id)
    {
        $file = File::find($id);
        $path = storage_path('app/public/');
        dd($file);

        ConvertApi::setApiCredentials('secret_6QN4WQBvAUZrCAfO');
        $result = ConvertApi::convert(
            'jpg',
            [
                'File' => $path . $file->attachment->file,
            ],
            $file->attachment->file_type
        );
        $result->saveFiles($path . $file->attachment->path . 'jpg/');

        dd($result);
    }

    public function tmp_preview($file)
    {
        // return response()->file('/Users/user/Herd/document-sys/storage/app/livewire-tmp/' . $file); // local/dev
        return response()->file('/home/dms.std.web.id/public_html/storage/app/livewire-tmp/' . $file); // online
    }

    public function file_preview($id) // for api call
    {
        $file = File::find($id);
        $file = storage_path('app/public/uploads/' . $file->id . '/' . $file->attachment->name);
        return response()->file($file);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
