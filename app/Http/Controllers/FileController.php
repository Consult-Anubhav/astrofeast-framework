<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function addFile($destination_folder, $file)
    {
        $size = $file->getSize();
        $extension = $file->getClientOriginalExtension();
        $name = str_replace(' ', '_', Carbon::now()->format('Y-m-d_g-i_A_s.u') . '.' . $extension);
        $file_path = (isset($destination_folder) ? ($destination_folder . '/') : null) . $name;

        Storage::disk('public_upload')->put($file_path, file_get_contents($file));

        $new_path = '/public/uploads/' . $file_path;

        $attachment = new Attachment();

        $attachment->filename = $name;
        $attachment->size = isset($size) ? $size : 0;
        $attachment->extension = $extension;
        $attachment->path = $new_path;
        $attachment->save();

        return $attachment;
    }

    public static function deleteFile($destination_folder, $attachment_id)
    {
        $attachment = Attachment::where('id', '=', $attachment_id)->first();

        if ($attachment != null)
        {
            $file_path = public_path('uploads/' . (isset($destination_folder) ? ($destination_folder . '/') : null) . $attachment->filename);

            File::delete($file_path);

            $attachment->forceDelete();
        }
    }

    public static function format_size($size)
    {
        $mod = 1024;
        $units = explode(' ', 'Bytes KB MB GB TB');

        for ($i = 0; $size > $mod; $i++)
            $size /= $mod;

        return round($size, 2) . ' ' . $units[$i];
    }

    public static function uploadFile($request, $key, $max_size, $destination, $extensions = null)
    {
        $validator = Validator::make($request->all(), [
            $key => 'required|' . (($extensions == null) ? '' : ($extensions . '|')) . 'max:' . $max_size,
        ], [
            ($key . '.max') => 'The ' . str_replace("_", " ", $key) . ' maximum size allowed is ' . self::format_size($max_size * 1024) . '.',
        ]);

        if ($validator->fails())
        {
            $errors = [];

            foreach ($validator->messages()->all() as $error)
            {
                array_push($errors, $error);
            }

            //return validation errors
            $response['errors'] = response()->json([
                'errors' => $errors,
                'status' => 400
            ], 400);

            return $response;
        }

        $file = $request->file($key);
        //return file path
        $response['attachment'] = self::addFile($destination, $file);

        return $response;
    }
}
