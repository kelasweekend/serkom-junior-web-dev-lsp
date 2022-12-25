<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $bus = Transaksi::select(DB::raw("COUNT(*) as count"), DB::raw("DAYNAME(created_at) as day_name"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("day_name"))
            ->pluck('count', 'day_name');

        $labels = $bus->keys();
        $data = $bus->values();
        return view('admin.index', compact('labels', 'data'));
    }
}
