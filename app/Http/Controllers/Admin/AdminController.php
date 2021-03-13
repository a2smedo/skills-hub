<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $superAdminRole = Role::where("name", "superAdmin")->first();
        $adminRole = Role::where("name", "admin")->first();
        $data['admins'] = User::whereIn("role_id", [$superAdminRole->id, $adminRole->id])
                            ->orderBy('id', 'Desc')
                            ->paginate(10);

        return view('admin.admins.index')->with($data);
    }


    public function create()
    {
        $data['roles'] = Role::select("id", "name")
                        ->whereIn("name", ["superAdmin", "admin"])
                        ->get();
        return view('admin.admins.create')->with($data);

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:5|max:255|confirmed',
            'role_id' => 'required|exists:roles,id',

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        //verifed manule
        event(new Registered($user));

        return redirect(url("/dashboard/admins"));
    }


    public function promot($id)
    {
        $admin = User::findOrfail($id);
        $admin->update([
            'role_id' => Role::select("id")->where("name", "superAdmin")->first()->id,
        ]);

        return back();
    }

    public function demot($id)
    {
        $superAdmin = User::findOrfail($id);
        $superAdmin->update([
            'role_id' => Role::select("id")->where("name", "admin")->first()->id,
        ]);

        return back();

    }
}
