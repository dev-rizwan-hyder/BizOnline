<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function show()
    {
        return view('welcome');
    }

    public function test(Request $request){
        return view('test');
    }
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email',
            'phone'      => 'nullable|string|max:20',
            'message'    => 'required|string|max:1000',
        ]);

        Contact::create($validated);

        return redirect()->back()->with('success', 'Your message has been sent!');
    }
}
