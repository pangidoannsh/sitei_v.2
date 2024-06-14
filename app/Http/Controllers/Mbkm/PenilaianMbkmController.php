<?php

namespace App\Http\Controllers\Mbkm;

use App\Http\Controllers\Controller;
use App\Models\Mbkm\PenilaianMbkm;
use Illuminate\Http\Request;

class PenilaianMbkmController extends Controller
{
    public function delete($id)
    {
        PenilaianMbkm::find($id)->delete();
        return redirect()->back();
    }
}
