<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\ContantUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    //
    public function index()
    {
        $contacts = ContactUs::get();
        return view('dashboard.contact_us.index', compact('contacts'));
    }
    public function create()
    {
        return view('dashboard.contact_us.create');
    }
    public function store(Request $request)
    {
       
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'link' => 'required',
            'image' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $imageName = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $ext = $image->getClientOriginalExtension();
                $imageName = "contact-" . uniqid() . ".$ext";
                $image->move(public_path('contact_us'), $imageName);
            }
            ContactUs::create([
                'title_ar'=>$request->title_ar,
                'title_en'=>$request->title_en,
                'link'=>$request->link,
                'image' => $imageName,
            ]);

           
            DB::commit();

            return redirect()->route('contact.index')->with('success', 'contact_us created successfully.');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('contact.index')->with(['error' => 'Error occurred. Please try again']);
        }
    }



    public function edit($id)
    {
        $contact = ContactUs::findOrFail($id); // Fetching the contact to edit
        return view('dashboard.contact_us.edit', compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'link' => 'required',
            'image' => 'nullable', // Validate image only if provided
        ]);

        DB::beginTransaction();

        try {
            $contact = ContactUs::find($id);

            if (!$contact) {
                return redirect()->route('contact.index')->with(['error' => 'Contact not found']);
            }

            // Default to the existing image if no new image is uploaded
            $imageName = $contact->image;

            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($contact->image) {
                    Storage::delete('public/contact_us/' . $contact->image);
                }

                // Store the new image and generate a new filename
                $image = $request->file('image');
                $ext = $image->getClientOriginalExtension();
                $imageName = "contact-" . uniqid() . ".$ext";
                $image->move(public_path('contact_us'), $imageName);
            }

            // Update the contact details with the new image or the old one
            $contact->update([
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'link' => $request->link,
                'image' => $imageName, // Store the image name (new or old)
            ]);

            DB::commit();

            return redirect()->route('contact.index')->with('success', 'Contact updated successfully.');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('contact.index')->with(['error' => 'Error occurred. Please try again']);
        }
    }

    public function destroy($id)
    {
        $contact = ContactUs::where('id', $id)->delete();

        return redirect()->route('contact.index')->with('success', 'Contact_Us deleted successfully.');
    }
}
