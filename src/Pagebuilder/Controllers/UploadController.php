<?php

namespace Flobbos\Pagebuilder\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Exception;

class UploadController extends Controller
{

    use \Flobbos\Pagebuilder\Uploads\Uploadable;
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if ($request->hasFile('photo')) {
                return response()->json([
                    'filename' => $this->handleUpload($request, 'photo'),
                    'column_id' => $request->get('column_id'),
                    'lang_id' => $request->get('lang_id')
                ], 200);
            }
            throw new Exception('No file uploaded');
        } catch (Exception $ex) {
            return response()->json(['success' => false, 'message' => $ex->getMessage()], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            if ($request->has('delete_photo')) {
                Storage::disk($request->get('storage'))->delete($request->get('delete_photo'));
            }
            return response()->json(['success' => true], 200);
        } catch (Exception $ex) {
            return response()->json(['success' => false, 'message' => $ex->getMessage()], 422);
        }
    }
}
