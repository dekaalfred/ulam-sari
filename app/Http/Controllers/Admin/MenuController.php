<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function toggleStatus($id)
    {
        $menu = Menu::findOrFail($id);

        $menu->status = $menu->status === 'tersedia'
            ? 'habis'
            : 'tersedia';

        $menu->save();

        return response()->json([
            'success' => true,
            'status' => $menu->status
        ]);
    }
}