<x-mail::message>
    Dear {{ $registration->full_name }},

    Your registration has been received. Please save this email for future reference.

    **Event:** The APEC Port Services Network (APSN) Forum 2026 and APSN Council Meeting 2026<br>
    **Date:** December 14th – 18th, 2026<br>
    **Venue:** Rex Hotel Saigon - Ho Chi Minh City, Viet Nam

    **Registration Details:**<br>
    **Registration ID.:** APSN-{{ str_pad((string) $registration->id, 4, '0', STR_PAD_LEFT) }}<br>
    **Full name:** {{ $registration->full_name }}<br>
    **Affiliation:** {{ $registration->organization }}<br>
    **Country:** {{ $registration->economy }}<br>
    **Email:** {{ $registration->email }}

    We look forward to seeing you in Ho Chi Minh City!

    Kind regards,<br>
    APSN 2026 Registration Team
</x-mail::message>
