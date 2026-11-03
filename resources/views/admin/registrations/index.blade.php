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
        <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 18px; flex-wrap: wrap;">
            <form method="get" action="{{ route('admin.registrations.index') }}" class="search-form" style="margin: 0;">
                <input type="search" name="search" value="{{ $search }}" placeholder="Search name, email, organization, or economy">
                <button type="submit" class="button button-primary">Search</button>
                @if($search !== '')
                    <a href="{{ route('admin.registrations.index') }}" class="button">Clear</a>
                @endif
            </form>

            <form id="bulk-delete-form" method="post" action="{{ route('admin.registrations.bulk-destroy') }}" style="display: inline; margin: 0;" onsubmit="return confirmBulkDelete();">
                @csrf
                @method('DELETE')
                <button type="submit" id="bulk-delete-btn" class="button button-danger" style="display: none;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="vertical-align: -2px; margin-right: 4px;"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                    Delete Selected (<span id="selected-count">0</span>)
                </button>
            </form>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th style="width: 38px; text-align: center;">
                            <input type="checkbox" id="select-all" title="Select all on this page" style="cursor: pointer;">
                        </th>
                        <th>Delegate</th>
                        <th>Organization</th>
                        <th>Economy</th>
                        <th>Role</th>
                        <th>Submitted</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($registrations as $registration)
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">
                                <input type="checkbox" name="ids[]" value="{{ $registration->id }}" form="bulk-delete-form" class="row-checkbox" style="cursor: pointer;">
                            </td>
                            <td><strong>{{ $registration->full_name }}</strong><small>{{ $registration->email }}</small></td>
                            <td>{{ $registration->organization }}</td>
                            <td>{{ $registration->economy }}</td>
                            <td>{{ $registration->attending_as }}</td>
                            <td>{{ $registration->created_at?->format('d M Y, H:i') }}</td>
                            <td style="text-align: right; vertical-align: middle; white-space: nowrap;">
                                <div style="display: inline-flex; gap: 6px; align-items: center;">
                                    <a href="{{ route('admin.registrations.show', $registration) }}" class="button button-sm">View</a>
                                    <form method="post" action="{{ route('admin.registrations.destroy', $registration) }}" style="display: inline; margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="button button-sm button-danger" onclick="return confirm('Delete registration of {{ addslashes($registration->full_name) }}? This cannot be undone.');" title="Delete registration">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="empty-state">No registrations found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $registrations->links() }}
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectAll = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('.row-checkbox');
            const bulkBtn = document.getElementById('bulk-delete-btn');
            const countSpan = document.getElementById('selected-count');

            function updateBulkState() {
                const checked = document.querySelectorAll('.row-checkbox:checked');
                const count = checked.length;
                if (countSpan) countSpan.textContent = count;
                if (bulkBtn) {
                    bulkBtn.style.display = count > 0 ? 'inline-flex' : 'none';
                }
                if (selectAll) {
                    selectAll.checked = checkboxes.length > 0 && checked.length === checkboxes.length;
                    selectAll.indeterminate = count > 0 && count < checkboxes.length;
                }
            }

            if (selectAll) {
                selectAll.addEventListener('change', function () {
                    checkboxes.forEach(cb => cb.checked = selectAll.checked);
                    updateBulkState();
                });
            }

            checkboxes.forEach(cb => {
                cb.addEventListener('change', updateBulkState);
            });

            window.confirmBulkDelete = function () {
                const checked = document.querySelectorAll('.row-checkbox:checked');
                if (checked.length === 0) {
                    alert('Please select at least one registration to delete.');
                    return false;
                }
                return confirm('Are you sure you want to delete ' + checked.length + ' selected registration(s)? This action cannot be undone.');
            };
        });
    </script>
@endsection
