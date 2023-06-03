<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        // Get all users except the currently logged-in admin user
        $users = User::where('id', '!=', auth()->user()->id)->get();
        return view('admin.dashboard',[
            "users" => $users
        ] );
    }

    //SEARCH BAR FOR ADMIN
    public function search(Request $request) {
        $query = $request->input('search');
        $results = User::where('id', '!=', auth()->user()->id)->filter($query)->paginate(5);

        return view('admin.dashboard', [
            "users" => $results
        ]);
    }


    public function deleteUser(User $user) {
        $user->delete();
        
        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
    }

    // public function deactivateUser(User $user) {
    //     $user->update(['status' => User::INACTIVE_USER]);

    //     return redirect()->route('admin.dashboard')->with('success', 'User deactivated successfully.');
    // }

    // public function activateUser(User $user) {
    //     $user->update(['status' => User::ACTIVE_USER]);

    //     return redirect()->route('admin.dashboard')->with('success', 'User activated successfully.');
    // }

    public function deactivateUser(User $user) {
        if ($user->status !== User::INACTIVE_USER) {
            $user->update(['status' => User::INACTIVE_USER]);
            session()->flash('status', 'User account has been disabled.');
        }
        
        return redirect()->route('admin.dashboard')->with('success', 'User deactivated successfully.');
    }
    
    public function activateUser(User $user) {
        if ($user->status !== User::ACTIVE_USER) {
            $user->update(['status' => User::ACTIVE_USER]);
            session()->flash('status', 'User account has been activated.');
        }
        
        return redirect()->route('admin.dashboard')->with('success', 'User activated successfully.');
    }
    
}
