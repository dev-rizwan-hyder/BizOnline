<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HrPolicy;

class PolicyController extends Controller
{
    public function index(Request $request)
    {
        $query = HrPolicy::latest();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $policies = $query->paginate(12);

        // Fetch all unique policy categories/types for filter pills & select dropdown
        $policyTypes = HrPolicy::select('category')
            ->distinct()
            ->whereNotNull('category')
            ->pluck('category')
            ->toArray();

        // Default categories if empty
        if (empty($policyTypes)) {
            $policyTypes = ['Attendance', 'Leave & Time Off', 'Code of Conduct', 'IT & Security', 'Performance & Review'];
        }

        return view('admin.policies.index', compact('policies', 'policyTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'custom_category' => 'nullable|string|max:255',
            'effective_date' => 'nullable|date',
            'summary' => 'nullable|string',
            'content' => 'required|string',
            'is_active' => 'nullable|boolean',
        ]);

        // If custom category typed in, use custom_category
        if (!empty($validated['custom_category'])) {
            $validated['category'] = trim($validated['custom_category']);
        }

        $validated['is_active'] = $request->has('is_active') ? true : true;

        HrPolicy::create($validated);

        return redirect()->route('admin.policies.index')->with('success', 'HR Policy published successfully.');
    }

    public function update(Request $request, HrPolicy $policy)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'effective_date' => 'nullable|date',
            'summary' => 'nullable|string',
            'content' => 'required|string',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $policy->update($validated);

        return redirect()->route('admin.policies.index')->with('success', 'HR Policy updated successfully.');
    }

    public function destroy(HrPolicy $policy)
    {
        $policy->delete();
        return redirect()->route('admin.policies.index')->with('success', 'HR Policy deleted successfully.');
    }
}
