<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        return view('dashboard.Users.index')->with('users', User::all());
    }

    public function create()
    {
        return view('dashboard.Users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|email|unique:users,email',
            'date_of_birth' => 'nullable',
            'image' => 'nullable',
        ]);

        DB::beginTransaction();
        $filename = "";
        if ($request->file('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension(); // Use getClientOriginalExtension for the file extension
            $filename = "user-" . uniqid() . ".$ext";
            $file->move(public_path('images/users'), $filename);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
            'password' => Hash::make($request->password),
            'image' => $filename,
        ]);

        DB::commit();
        return redirect(route('admin.users.index'))->with(['success' => 'User added successfully']);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.Users.edit')->with('user', $user);
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'date_of_birth' => 'nullable|date', // Ensure the date is in the correct format
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048', // Limit file types and size
        ]);

        // Find the user or fail
        $user = User::findOrFail($id);

        // Begin a database transaction
        DB::beginTransaction();
        try {
            // Update the user's fields
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'date_of_birth' => $request->date_of_birth, // Ensure date of birth is saved
            ]);

            // Check if an image file is uploaded
            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($user->image) {
                    Storage::delete($user->image);
                }

                // Store the new image and get the path
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension(); // Use getClientOriginalExtension for the file extension
                $filename = "user-" . uniqid() . ".$ext";
                $file->move(public_path('images/users'), $filename);
                // Update the user's image path
                $user->image = $filename;
                $user->save();
            }

            // Commit the transaction
            DB::commit();

            // Redirect with success message
            return redirect(route('admin.users.index'))->with(['success' => 'User updated successfully']);
        } catch (\Exception $e) {
            // Rollback the transaction if there's an error
            DB::rollback();
            return redirect()->back()->with(['error' => 'An error occurred while updating the user']);
        }
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect(route('admin.users.index'))->with(['success' => 'User deleted successfully']);
    }
}
