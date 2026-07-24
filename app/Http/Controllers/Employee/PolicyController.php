<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HrPolicy;

class PolicyController extends Controller
{
    public function index(Request $request)
    {
        $query = HrPolicy::where('is_active', true)->latest();

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

        $policyTypes = HrPolicy::where('is_active', true)
            ->select('category')
            ->distinct()
            ->pluck('category')
            ->toArray();

        return view('employee.policies', compact('policies', 'policyTypes'));
    }
}
