<?php

namespace App\Http\Controllers;

use App\Models\{Property, Category, Inquiry, User};

class AdminController extends Controller
{
    public function dashboard()
    {
        $propertyCount   = Property::count();
        $inquiryCount    = Inquiry::count();
        $categoryCount   = Category::count();
        $userCount       = User::where('usertype', 'user')->count();
        $recentInquiries = Inquiry::with('property')->latest()->take(5)->get();

        // Last 12 mash er inquiry count (chart er jonno)
        $months = collect(range(11, 0))->map(fn ($i) => now()->subMonths($i)->startOfMonth());

        $perMonth = Inquiry::where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->get(['created_at'])
            ->groupBy(fn ($row) => $row->created_at->format('Y-m'))
            ->map->count();

        $labels = $months->map(fn ($m) => $m->format('M'))->all();
        $values = $months->map(fn ($m) => $perMonth->get($m->format('Y-m'), 0))->all();

        $inquiryTrend = [
            '6m'  => [
                'labels' => array_slice($labels, -6),
                'values' => array_slice($values, -6),
            ],
            '12m' => [
                'labels' => $labels,
                'values' => $values,
            ],
        ];

        // Status onujayi inquiry count (donut chart er jonno)
        $statusCounts = Inquiry::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $statusBreakdown = [
            'labels' => $statusCounts->keys()->map(fn ($s) => ucfirst((string) $s))->values()->all() ?: ['No data'],
            'values' => $statusCounts->values()->all() ?: [0],
        ];

        return view('admin.dashboard', compact(
            'propertyCount',
            'inquiryCount',
            'categoryCount',
            'userCount',
            'recentInquiries',
            'inquiryTrend',
            'statusBreakdown'
        ));
    }
}