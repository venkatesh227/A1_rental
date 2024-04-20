<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientsController extends Controller
{
    public function index()
    {
        $users = Client::all();
        return view('admin.client.view', compact('users'));
    }

    public function update_status($userId,$currentStatus)
    {
        $user = Client::find($userId);
        $user->status = $currentStatus;

        $user->update();
    
        $updatedUser = Client::find($userId);

        return response()->json(['status' => 'success', 'user' => $updatedUser]);
       
    }
}
