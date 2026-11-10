<x-mail::message>
# New Registration Received

A new registration has been submitted for APSN Forum 2026.

- **Name:** {{ $registration->full_name }}
@if ($registration->is_invited)
- **Type:** Invited guest
@else
- **Economy:** {{ $registration->economy }}
@endif
- **Organization:** {{ $registration->organization }}
- **Email:** {{ $registration->email }}
- **Submitted:** {{ $registration->created_at?->format('d M Y, H:i') }}

<x-mail::button :url="route('admin.registrations.show', $registration)">
View Registration
</x-mail::button>

Thanks,<br>
APSN Registration System
</x-mail::message>
