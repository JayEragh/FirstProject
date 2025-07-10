@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <h4>Welcome to DOCmag - Document Management System</h4>
                    
                    <!-- Document Statistics Section -->
                    <div class="row mt-4 mb-4">
                        <div class="col-md-4">
                            <div class="card text-center bg-primary text-white">
                                <div class="card-body">
                                    <i class="fas fa-file-alt fa-3x mb-3"></i>
                                    <h3 class="card-title">{{ Auth::user()->documents->count() }}</h3>
                                    <p class="card-text">Total Documents</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card text-center bg-success text-white">
                                <div class="card-body">
                                    <i class="fas fa-calendar-check fa-3x mb-3"></i>
                                    <h3 class="card-title">{{ Auth::user()->documents->where('created_at', '>=', now()->subDays(7))->count() }}</h3>
                                    <p class="card-text">Recent (7 days)</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card text-center bg-info text-white">
                                <div class="card-body">
                                    <i class="fas fa-download fa-3x mb-3"></i>
                                    <h3 class="card-title">{{ Auth::user()->documents->where('created_at', '>=', now()->subDays(30))->count() }}</h3>
                                    <p class="card-text">This Month</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">📄 Document Management</h5>
                                    <p class="card-text">Manage your personal document library.</p>
                                    <a href="{{ route('documents.index') }}" class="btn btn-primary">View Documents</a>
                                    @if(Auth::user()->email === 'admin@docmag.com')
                                        <a href="{{ route('documents.create') }}" class="btn btn-success">Upload Document</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">👤 Profile</h5>
                                    <p class="card-text">Update your profile information.</p>
                                    <a href="{{ route('profile') }}" class="btn btn-info">Edit Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(in_array(auth()->user()->email, ['admin@docmag.com']))
                    <!-- Admin System Statistics -->
                    <div class="row mt-4 mb-4">
                        <div class="col-12">
                            <h5 class="text-muted mb-3">📊 System Statistics</h5>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center bg-warning text-dark">
                                <div class="card-body">
                                    <i class="fas fa-users fa-2x mb-2"></i>
                                    <h4 class="card-title">{{ \App\Models\User::count() }}</h4>
                                    <p class="card-text">Total Users</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="card text-center bg-secondary text-white">
                                <div class="card-body">
                                    <i class="fas fa-file-alt fa-2x mb-2"></i>
                                    <h4 class="card-title">{{ \App\Models\Document::count() }}</h4>
                                    <p class="card-text">Total Documents</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="card text-center bg-danger text-white">
                                <div class="card-body">
                                    <i class="fas fa-clock fa-2x mb-2"></i>
                                    <h4 class="card-title">{{ \App\Models\Document::where('created_at', '>=', now()->subDays(7))->count() }}</h4>
                                    <p class="card-text">Recent Uploads</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="card text-center bg-dark text-white">
                                <div class="card-body">
                                    <i class="fas fa-calendar fa-2x mb-2"></i>
                                    <h4 class="card-title">{{ \App\Models\User::where('created_at', '>=', now()->subDays(30))->count() }}</h4>
                                    <p class="card-text">New Users</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">👥 User Management</h5>
                                    <p class="card-text">Manage all users in the system.</p>
                                    <a href="{{ route('users.index') }}" class="btn btn-warning">Manage Users</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">📧 Email System</h5>
                                    <p class="card-text">Send recent documents to users.</p>
                                    <a href="{{ route('emails.index') }}" class="btn btn-secondary">Email Dashboard</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Document Upload Chart Section -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-chart-line"></i> My Document Uploads
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="documentChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                        
                        @if(Auth::user()->email === 'admin@docmag.com' && isset($adminChartData))
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-chart-bar"></i> System-wide Uploads
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="adminChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get chart data from PHP
    const chartData = @json($chartData ?? []);
    const adminChartData = @json($adminChartData ?? null);
    
    // User's document chart
    const ctx = document.getElementById('documentChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartData.labels || [],
            datasets: [{
                label: 'My Documents',
                data: chartData.data || [],
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.1,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'My Document Uploads (Last 30 Days)'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
    
    // Admin system-wide chart
    if (adminChartData) {
        const adminCtx = document.getElementById('adminChart').getContext('2d');
        new Chart(adminCtx, {
            type: 'bar',
            data: {
                labels: adminChartData.labels || [],
                datasets: [{
                    label: 'System Documents',
                    data: adminChartData.data || [],
                    backgroundColor: 'rgba(255, 99, 132, 0.8)',
                    borderColor: 'rgb(255, 99, 132)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'System-wide Uploads (Last 30 Days)'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    }
});
</script>
@endsection
