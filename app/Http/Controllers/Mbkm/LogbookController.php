<?php

namespace App\Http\Controllers\Mbkm;

use App\Http\Controllers\Controller;
use App\Models\Mbkm\Logbook;
use App\Models\Mbkm\Mbkm;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LogbookController extends Controller
{
    public function index($mbkmId)
    {
        $mbkm = Mbkm::findOrFail($mbkmId);
        $logbooks = Logbook::where("mbkm_id", $mbkmId)->orderBy("input_date")->get();
        return view("mbkm.logbook", compact("logbooks", "mbkm"));
    }

    public function store(Request $request, $id)
    {
        $logbook = Logbook::findOrFail($id);
        $file = $request->file('file');
        $logbook->file = str_replace('public/', '', $file->store('public/logbook'));
        $logbook->update();

        return redirect()->back();
    }
}
