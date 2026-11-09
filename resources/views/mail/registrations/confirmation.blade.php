<x-mail::message>
# Registration Confirmation

Dear {{ $registration->full_name }},

Your registration has been received. Please save this email for future reference.

## Event Information

**Event:** The APEC Port Services Network (APSN) Forum 2026 and APSN Council Meeting 2026

**Date:** December 14th – 18th, 2026

**Venue:** Rex Hotel Saigon — Ho Chi Minh City, Viet Nam

## Registration Details

**Registration ID:** APSN-{{ str_pad((string) $registration->id, 4, '0', STR_PAD_LEFT) }}

**Full name:** {{ $registration->full_name }}

**Affiliation:** {{ $registration->organization }}

**Economy:** {{ $registration->economy }}

**Email:** {{ $registration->email }}

We look forward to seeing you in Ho Chi Minh City!

Kind regards,

APSN 2026 Registration Team
</x-mail::message>
