<x-mail::message>
# Registration Confirmed

Dear {{ $registration->full_name }},

Thank you for registering for the **APSN Forum 2026 and APSN Council Meeting 2026** in Ho Chi Minh City, Viet Nam.

**Registration details**

- APEC Economy: {{ $registration->economy }}
- Organization: {{ $registration->organization }}
- Contact email: {{ $registration->email }}

The Secretariat will contact you with further event information. Please keep this email for your records.

Thanks,<br>
APSN Forum 2026 Secretariat
</x-mail::message>
