<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use App\Models\HrDocument;
use App\Models\HrPolicy;
use App\Models\Task;
use Carbon\Carbon;

class ProjectModuleController extends Controller
{
    public function index(Request $request)
    {
        $activeTab = $request->get('module', 'overview'); // overview, attendance, breaks, documents, policies, performance

        $employees = User::where('role', '!=', 'admin')->get();
        $recentAttendances = Attendance::with('user')->latest()->take(10)->get();
        $documents = HrDocument::with(['uploader', 'employee'])->latest()->get();
        $policies = HrPolicy::latest()->get();

        return view('admin.projects.index', compact(
            'activeTab',
            'employees',
            'recentAttendances',
            'documents',
            'policies'
        ));
    }

    public function storeDocument(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $validated['uploaded_by'] = auth()->id();
        HrDocument::create($validated);

        return redirect()->route('admin.projects.index', ['module' => 'documents'])->with('success', 'Document record added successfully.');
    }

    public function storePolicy(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'summary' => 'nullable|string',
            'content' => 'required|string',
        ]);

        $validated['is_active'] = true;
        HrPolicy::create($validated);

        return redirect()->route('admin.projects.index', ['module' => 'policies'])->with('success', 'HR Policy created successfully.');
    }
}
