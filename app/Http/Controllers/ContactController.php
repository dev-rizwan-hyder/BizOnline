<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function test(Request $request){
        return view('test');
    }
    public function submit(Request $request)
    {
        if (!$request->filled('first_name') && $request->filled('name')) {
            $nameParts = preg_split('/\s+/', trim($request->input('name')), 2);
            $request->merge([
                'first_name' => $nameParts[0] ?? $request->input('name'),
                'last_name' => $nameParts[1] ?? '-',
            ]);
        }

        if (!$request->filled('last_name')) {
            $request->merge(['last_name' => '-']);
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email',
            'phone'      => 'nullable|string|max:20',
            'message'    => 'required|string|max:1000',
        ]);

        $context = collect([
            'Business' => $request->input('business_name'),
            'Service' => $request->input('service'),
        ])->filter();

        if ($context->isNotEmpty()) {
            $validated['message'] = $context->map(fn ($value, $label) => "{$label}: {$value}")->implode("\n") . "\n\n" . $validated['message'];
        }

        Contact::create($validated);

        Mail::to(config('mail.from.address'))->send(new ContactFormMail($validated));

        return redirect()->back()->with('success', 'Your message has been sent!');
    }
}
