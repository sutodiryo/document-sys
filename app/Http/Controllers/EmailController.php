<?php

namespace App\Http\Controllers;

use App\Mail\ApprovalFileMail;
use App\Mail\ShareFileMail;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{

    public function SendShareFileEmail($id, Request $request)
    {
        $file = File::find($id);
        $data = [
            'subject' => 'Share File',
            'title' => 'Share File',
            'body' => 'Body',
            'file_id' => $file->id,
            'file_name' => $file->name,
            'file_name' => $file->name,
        ];

        Mail::to($request->email)->send(new ShareFileMail($data));

        return redirect($request->curent_link);
    }

    public function SendApprovalFileEmail($id, Request $request)
    {
        $file = File::find($id);
        $data = [
            'subject' => 'Share File',
            'title' => 'Approval File',
            'body' => 'Body',
            'file_id' => $file->id,
            'file_name' => $file->name,
            'file_name' => $file->name,
            'resolution' => $request->resolution,
        ];

        Mail::to($request->email)->send(new ApprovalFileMail($data));

        return redirect($request->curent_link);
    }
}
