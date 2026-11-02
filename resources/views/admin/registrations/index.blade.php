@extends('layouts.admin')

@section('title', 'Registrations')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">APSN Forum 2026</p>
            <h1>Registrations</h1>
            <p>Review delegate submissions and securely access their documents.</p>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card"><span>Total registrations</span><strong>{{ number_format($totalRegistrations) }}</strong></div>
        <div class="stat-card"><span>Received today</span><strong>{{ number_format($todayRegistrations) }}</strong></div>
    </div>

    <section class="panel">
        <form method="get" action="{{ route('admin.registrations.index') }}" class="search-form">
            <input type="search" name="search" value="{{ $search }}" placeholder="Search name, email, organization, or economy">
            <button type="submit" class="button button-primary">Search</button>
            @if($search !== '')
                <a href="{{ route('admin.registrations.index') }}" class="button">Clear</a>
            @endif
        </form>

        <div class="table-wrap">
            <table>
                <thead><tr><th>Delegate</th><th>Organization</th><th>Economy</th><th>Role</th><th>Submitted</th><th></th></tr></thead>
                <tbody>
                    @forelse($registrations as $registration)
                        <tr>
                            <td><strong>{{ $registration->full_name }}</strong><small>{{ $registration->email }}</small></td>
                            <td>{{ $registration->organization }}</td>
                            <td>{{ $registration->economy }}</td>
                            <td>{{ $registration->attending_as }}</td>
                            <td>{{ $registration->created_at?->format('d M Y, H:i') }}</td>
                            <td><a href="{{ route('admin.registrations.show', $registration) }}" class="text-link">View</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="empty-state">No registrations found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $registrations->links() }}
    </section>
@endsection
