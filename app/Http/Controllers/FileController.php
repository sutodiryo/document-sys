<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\FileShare;
use Carbon\Carbon;
use ConvertApi\ConvertApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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
        $file = storage_path('app/public/uploads/' . $file->id . '/' . $file->attachment->name . '.' . $file->attachment->file_type);
        // dd($file);


        // $response = Http::withHeaders([
        //     'Content-Type' => 'application/json',
        //     'x-api-key' => 'yoxgii@gmail.com_SdM3oNfwdBEG9dP3QxRYqkRNMzTbZ5f1B7gaPdWQFaWbjWwxu7QdsRTsgMBQbQfd'
        //     // eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpc3MiOiJodHRwczovL29hdXRoLmFpcnNsYXRlLmNvbS8iLCJhdWQiOiIyNDc5MzBiMC1hYzZiLTQ4YWMtYmUwZC01NzQ2NzJkZDk2ZmQiLCJqdGkiOiI0YzI4NmRmMzI4YjllMDI3NjZhZjExOTA3ODU2NzY3MzgxMmYzYzc0NDIyMDJhNjJhZmE1MDUxN2UwYjE2ZmUzODUwZTRlZTU2YjkwNWI0YSIsImlhdCI6MTczMjI0NTU2MS41Mjg4MzIsIm5iZiI6MTczMjI0NTU2MS41Mjg4MzQsImV4cCI6MTczMjQxODM2MS40OTg3Miwic3ViIjoiNmMyNjIwYjgtYjRlNC00MGMxLTk1NzUtMmQwOTMzNzg1MWM0Iiwic2NvcGVzIjpbIm9wZW5pZCIsImVtYWlsIiwicHJvZmlsZSJdfQ.kJOYZwvy3s2TGDxnE_R0zJII4cz5kDFgddHNH3vKge_VpbvZy4zm6dZD2JwPH9BDMVZCDt6sc9d7WYs89h2fmyP2xFiXQz5zP_gOo5C4mdbmhT9v45YZwbi16Xr2sufQGlLUP1lfCto50As8GSsh81rvhU5G41giPe1MAN5k-saKUvIL-6AyK5MTeFRi7xCl70g_ps96CDh0wWk-MJ70nGP-_BJjaak4ho3eVRVeSXuQCTXjguZjbhZ1chuTGX1H9Rpt_lGseTr_nJxNOIHe6YCkp37B5ZId-Re9vFYZUc-VZvUoo9Qjs0shkb2QkkFWPveKrTo-EYJVazLgvo9TB9C0B1iwfJzFHbHEzAlhbh-HcyL52wsj8TqInKrxSPq8lt0Z_aL-_W-wB_pKiHSKvMASLzwa31ksbgzINWZUdt8NZO46ng6j6AgR9J5enkFbjRYCBRQiJ92bLHZttj_PuFZijyd-qA0swV5nEfLY1hgb9cAUO1YhgztvdBM6s2xjbP-KhAHJw40xIa3Ree0HZ47pWhGDm0XeeYdIHSCdk478bYEpTbcx3DYtmJS0A7kySA9i7BgggmbCPEatXpU5SKSdkZjH_7KNdpyRaSrjjgYwIshdqFMhIXc5abuAc8hWMSk8UOwiYLRdtFncz8sNBumdwlYLSYC25sybtxjtIdw
        // ])->post('https://pdf.airslate.io/v1/documents/{{documentId}}/link', [
        //     'async' => false,
        //     'inline' => true,
        //     'name' => 'Signed_' . $this->file->name,
        //     'url' => route('public.ext.preview.files', $this->uuid),
        //     'images' => [
        //         [
        //             'url' => $this->esign_signature_file_url,
        //             'x' => $this->esign_x,
        //             'y' => $this->esign_y,
        //             'width' => 140,
        //             // 'height' => 40,
        //             'pages' => '0'
        //         ]
        //     ],
        // ]);


        return response()->file($file);
    }

    public function file_edit_airslate($id)
    {

        $file = File::find($id);
        $file = storage_path('app/public/uploads/' . $file->id . '/' . $file->attachment->name . '.' . $file->attachment->file_type);
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
