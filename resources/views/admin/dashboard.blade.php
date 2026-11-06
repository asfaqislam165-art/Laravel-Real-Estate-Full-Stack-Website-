<x-app-layout>
@php
    $propertyCount   = $propertyCount ?? 0;
    $inquiryCount    = $inquiryCount ?? 0;
    $categoryCount   = $categoryCount ?? 0;
    $userCount       = $userCount ?? 0;
    $recentInquiries = $recentInquiries ?? collect();

    $inquiryTrend = $inquiryTrend ?? [
        '6m' => [
            'labels' => ['Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov'],
            'values' => [12, 18, 15, 24, 28, 33],
        ],
        '12m' => [
            'labels' => ['Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov'],
            'values' => [6, 9, 8, 11, 10, 14, 12, 18, 15, 24, 28, 33],
        ],
    ];

    $statusBreakdown = $statusBreakdown ?? [
        'labels' => ['New', 'Contacted', 'Closed'],
        'values' => [45, 35, 20],
    ];

    $menu = [
        ['Overview',   'admin.dashboard',        'admin.dashboard'],
        ['Properties', 'admin.properties.index', 'admin.properties.*'],
        ['Categories', 'admin.categories.index', 'admin.categories.*'],
        ['Inquiries',  'admin.inquiries.index',  'admin.inquiries.*'],
        ['Reviews',    'admin.reviews.index',    'admin.reviews.*'],
        ['Settings',   'admin.settings.edit',    'admin.settings.*'],
    ];

    $links = collect($menu)->map(function ($item) {
        return [
            'label'  => $item[0],
            'url'    => \Illuminate\Support\Facades\Route::has($item[1]) ? route($item[1]) : '#',
            'active' => request()->routeIs($item[2]),
        ];
    });

    $adminName  = auth()->user()->name ?? 'Admin';
    $adminEmail = auth()->user()->email ?? '';
@endphp

<div class="relative flex min-h-screen bg-[#F7F5EF]">

    {{-- Mobile sidebar toggle --}}
    <input type="checkbox" id="sidebar-toggle" class="peer sr-only" />

    <label for="sidebar-toggle" aria-hidden="true"
        class="fixed inset-0 z-30 hidden bg-gray-900/50 peer-checked:block lg:hidden"></label>

    {{-- Sidebar --}}
    <aside id="dashboard-sidebar"
        class="fixed inset-y-0 left-0 z-40 flex w-72 max-w-[85vw] -translate-x-full transform flex-col justify-between overflow-y-auto border-r border-gray-200 bg-white transition-transform duration-300 peer-checked:translate-x-0 lg:static lg:w-64 lg:translate-x-0">

        <div class="p-4 sm:p-5">
            <span class="grid h-12 w-full max-w-[12rem] place-content-center rounded-lg bg-[#173F35] font-serif text-sm font-semibold tracking-wide text-[#C5A46D]">
                Executive Admin
            </span>

            <nav aria-label="Dashboard" class="mt-6">
                <ul class="space-y-1">
                    @foreach ($links as $link)
                        <li>
                            <a href="{{ $link['url'] }}"
                                class="block rounded-lg border-l-4 px-4 py-2.5 text-sm font-medium transition-colors {{ $link['active'] ? 'border-[#C5A46D] bg-[#F7F5EF] text-[#173F35]' : 'border-transparent text-gray-600 hover:bg-[#F7F5EF] hover:text-[#173F35]' }}">
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>

        <div class="sticky bottom-0 border-t border-gray-200 bg-white">
            <div class="flex items-center gap-3 p-4">
                <span class="grid h-10 w-10 shrink-0 place-content-center rounded-full bg-[#173F35] font-serif text-sm font-bold text-[#C5A46D]">
                    {{ strtoupper(substr($adminName, 0, 1)) }}
                </span>

                <p class="min-w-0 text-xs text-gray-900">
                    <strong class="block truncate font-medium">{{ $adminName }}</strong>
                    <span class="block truncate text-gray-500">{{ $adminEmail }}</span>
                </p>
            </div>
        </div>
    </aside>

    {{-- Main area --}}
    <div class="flex min-w-0 flex-1 flex-col">

        <header class="sticky top-0 z-20 flex flex-col gap-3 border-b border-gray-200 bg-white px-4 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">
            <div class="flex min-w-0 items-center gap-3">
                <label for="sidebar-toggle"
                    class="cursor-pointer rounded-md p-2 text-gray-600 transition-colors hover:bg-[#F7F5EF] lg:hidden">
                    <span class="sr-only">Toggle menu</span>
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </label>

                <h1 class="truncate font-serif text-xl font-semibold text-[#173F35] sm:text-2xl">
                    Executive Admin Dashboard
                </h1>
            </div>

            <a href="{{ route('admin.properties.create') }}"
                class="inline-flex w-full items-center justify-center rounded-md bg-[#173F35] px-4 py-2.5 text-sm font-medium text-white transition hover:bg-[#0f2c25] sm:w-auto">
                Add property
            </a>
        </header>

        <main class="flex-1 space-y-5 p-4 sm:space-y-6 sm:p-6">

            {{-- Stat cards --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <article class="flex flex-col gap-2 rounded-lg border-l-4 border-[#C5A46D] bg-white p-5 shadow-sm sm:p-6">
                    <strong class="text-sm font-medium text-gray-500">Total Properties</strong>
                    <span class="font-serif text-3xl font-bold text-[#173F35] sm:text-4xl">{{ $propertyCount }}</span>
                </article>

                <article class="flex flex-col gap-2 rounded-lg border-l-4 border-[#173F35] bg-white p-5 shadow-sm sm:p-6">
                    <strong class="text-sm font-medium text-gray-500">Customer Inquiries</strong>
                    <span class="font-serif text-3xl font-bold text-[#173F35] sm:text-4xl">{{ $inquiryCount }}</span>

                    <div class="h-10">
                        <canvas id="inquiry-sparkline" role="img" aria-label="Sparkline of recent inquiries"></canvas>
                    </div>
                </article>

                <article class="flex flex-col gap-2 rounded-lg border-l-4 border-[#C5A46D] bg-white p-5 shadow-sm sm:p-6">
                    <strong class="text-sm font-medium text-gray-500">Property Categories</strong>
                    <span class="font-serif text-3xl font-bold text-[#173F35] sm:text-4xl">{{ $categoryCount }}</span>
                </article>

                <article class="flex flex-col gap-2 rounded-lg border-l-4 border-[#173F35] bg-white p-5 shadow-sm sm:p-6">
                    <strong class="text-sm font-medium text-gray-500">Registered Users</strong>
                    <span class="font-serif text-3xl font-bold text-[#173F35] sm:text-4xl">{{ $userCount }}</span>
                </article>
            </div>

            {{-- Charts --}}
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                <div class="rounded-lg bg-white p-5 shadow-sm sm:p-6 lg:col-span-2">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <h2 class="font-serif text-lg font-bold text-[#173F35]">Inquiries trend</h2>

                        <div class="inline-flex w-fit rounded-md border border-gray-200 p-0.5 text-xs font-medium">
                            <button type="button" data-range="6m"
                                class="rounded-sm bg-[#F7F5EF] px-3 py-1.5 text-[#173F35]">6M</button>
                            <button type="button" data-range="12m"
                                class="rounded-sm px-3 py-1.5 text-gray-600">12M</button>
                        </div>
                    </div>

                    <div class="mt-4 h-56 sm:h-64">
                        <canvas id="inquiry-line-chart" role="img" aria-label="Line chart of customer inquiries per month"></canvas>
                    </div>
                </div>

                <div class="rounded-lg bg-white p-5 shadow-sm sm:p-6">
                    <h2 class="font-serif text-lg font-bold text-[#173F35]">Inquiries by status</h2>

                    <div class="mt-4 h-56 sm:h-64">
                        <canvas id="inquiry-status-donut" role="img" aria-label="Donut chart of inquiries by status"></canvas>
                    </div>
                </div>
            </div>

            {{-- Recent inquiries --}}
            <div class="rounded-lg bg-white p-5 shadow-sm sm:p-6">
                <h2 class="mb-4 font-serif text-lg font-bold text-[#173F35]">
                    Recent Customer Inquiries
                </h2>

                @forelse ($recentInquiries as $inq)
                    @php
                        $status = strtolower($inq->status ?? '');

                        $badge = match ($status) {
                            'new', 'pending' => 'bg-amber-100 text-amber-800',
                            'contacted'      => 'bg-[#C5A46D]/20 text-[#8a6b2f]',
                            'closed', 'done' => 'bg-[#173F35]/10 text-[#173F35]',
                            default          => 'bg-gray-100 text-gray-700',
                        };
                    @endphp

                    {{-- Mobile card --}}
                    <div class="rounded-lg border border-gray-200 p-4 md:hidden">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <p class="truncate font-semibold text-gray-900">{{ $inq->name }}</p>
                                <p class="mt-1 break-all text-xs text-gray-600">
                                    {{ $inq->phone }}<br>{{ $inq->email }}
                                </p>
                            </div>

                            <span class="shrink-0 rounded-full px-2.5 py-1 text-xs font-semibold {{ $badge }}">
                                {{ $inq->status }}
                            </span>
                        </div>

                        <p class="mt-3 text-sm font-semibold text-[#173F35]">
                            {{ $inq->property->title ?? 'General Inquiry' }}
                        </p>
                    </div>
                @empty
                    <p class="rounded-lg border border-dashed border-gray-300 p-6 text-center text-sm text-gray-500">
                        No inquiries yet.
                    </p>
                @endforelse

                {{-- Desktop table --}}
                <div class="hidden overflow-x-auto md:block">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-[#F7F5EF]">
                            <tr>
                                <th class="whitespace-nowrap px-4 py-3 text-left font-semibold text-[#173F35]">Client</th>
                                <th class="whitespace-nowrap px-4 py-3 text-left font-semibold text-[#173F35]">Phone / Email</th>
                                <th class="whitespace-nowrap px-4 py-3 text-left font-semibold text-[#173F35]">Property</th>
                                <th class="whitespace-nowrap px-4 py-3 text-left font-semibold text-[#173F35]">Status</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse ($recentInquiries as $inq)
                                @php
                                    $status = strtolower($inq->status ?? '');

                                    $badge = match ($status) {
                                        'new', 'pending' => 'bg-amber-100 text-amber-800',
                                        'contacted'      => 'bg-[#C5A46D]/20 text-[#8a6b2f]',
                                        'closed', 'done' => 'bg-[#173F35]/10 text-[#173F35]',
                                        default          => 'bg-gray-100 text-gray-700',
                                    };
                                @endphp

                                <tr>
                                    <td class="whitespace-nowrap px-4 py-3 font-medium text-gray-900">{{ $inq->name }}</td>
                                    <td class="whitespace-nowrap px-4 py-3 text-gray-600">
                                        {{ $inq->phone }}<br>{{ $inq->email }}
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3 font-semibold text-[#173F35]">
                                        {{ $inq->property->title ?? 'General Inquiry' }}
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3">
                                        <span class="rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $badge }}">
                                            {{ $inq->status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                        No inquiries yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var GREEN = '#173F35';
        var GOLD  = '#C5A46D';

        var inquiryTrend    = {!! json_encode($inquiryTrend) !!};
        var statusBreakdown = {!! json_encode($statusBreakdown) !!};

        new Chart(document.getElementById('inquiry-sparkline'), {
            type: 'line',
            data: {
                labels: inquiryTrend['6m'].labels,
                datasets: [{
                    data: inquiryTrend['6m'].values,
                    borderColor: GOLD,
                    borderWidth: 2,
                    pointRadius: 0,
                    tension: 0.35,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: false }
                },
                scales: {
                    x: { display: false },
                    y: { display: false }
                }
            }
        });

        var lineCanvas = document.getElementById('inquiry-line-chart');
        var gradient = lineCanvas.getContext('2d').createLinearGradient(0, 0, 0, 256);

        gradient.addColorStop(0, 'rgba(23, 63, 53, 0.25)');
        gradient.addColorStop(1, 'rgba(23, 63, 53, 0)');

        var lineChart = new Chart(lineCanvas, {
            type: 'line',
            data: {
                labels: inquiryTrend['6m'].labels,
                datasets: [{
                    label: 'Inquiries',
                    data: inquiryTrend['6m'].values,
                    borderColor: GREEN,
                    backgroundColor: gradient,
                    borderWidth: 2,
                    pointRadius: 0,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: GOLD,
                    pointHoverBorderColor: '#ffffff',
                    pointHoverBorderWidth: 2,
                    tension: 0.35,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: { legend: { display: false } },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: {
                            color: '#4b5563',
                            maxRotation: 0,
                            autoSkip: true
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: '#e5e7eb' },
                        ticks: { color: '#4b5563', precision: 0 }
                    }
                }
            }
        });

        var rangeButtons = document.querySelectorAll('[data-range]');

        rangeButtons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var range = btn.getAttribute('data-range');

                rangeButtons.forEach(function (b) {
                    var on = b === btn;

                    b.classList.toggle('bg-[#F7F5EF]', on);
                    b.classList.toggle('text-[#173F35]', on);
                    b.classList.toggle('text-gray-600', !on);
                });

                lineChart.data.labels = inquiryTrend[range].labels;
                lineChart.data.datasets[0].data = inquiryTrend[range].values;
                lineChart.update();
            });
        });

        new Chart(document.getElementById('inquiry-status-donut'), {
            type: 'doughnut',
            data: {
                labels: statusBreakdown.labels,
                datasets: [{
                    data: statusBreakdown.values,
                    backgroundColor: [GREEN, GOLD, '#d6d3c9'],
                    borderColor: '#ffffff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { color: '#4b5563', boxWidth: 12 }
                    }
                }
            }
        });
    });
</script>
</x-app-layout>