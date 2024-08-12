<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        $recentOrders = Order::where('user_id', auth()->id())->limit(5)->get();
        return view('frontend.user.dashboard', compact('recentOrders'));
    }
    public function orders()
    {
        $data = Order::where('user_id', auth()->id())->latest()->paginate(10);
        return view('frontend.user.order_history', compact('data'));
    }
    public function profile()
    {
        $data = User::findOrFail(auth()->id());
        return view('frontend.user.profile', compact('data'));
    }
    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'address' => 'nullable|string|max:255',
        ]);

        $data = User::findOrFail(auth()->id())->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
        ]);
        if ($data) {
            $notification = array(
                'message' => 'Data is updated successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
    }
    public function passwordUpdate()
    {
        return view('frontend.user.password_change');
    }
    public function passwordUpdateStore(Request $request)
    {
        // Validate the input
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        // Get the current user
        $user = Auth::user();

        // Check if the old password matches
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'The provided password does not match our records.']);
        }

        // Update the password
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('status', 'Password updated successfully.');
    }
}
