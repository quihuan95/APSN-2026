<?php

namespace App\Exports;

use App\Models\Registration;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RegistrationsExport extends StringValueBinder implements FromQuery, ShouldAutoSize, WithCustomValueBinder, WithEvents, WithHeadings, WithMapping, WithStyles
{
    public function __construct()
    {
        $this->setNumericConversion(false);
    }

    /** @return Builder<Registration> */
    public function query(): Builder
    {
        return Registration::query()->orderBy('id');
    }

    /** @return array<int, string> */
    public function headings(): array
    {
        return [
            'ID', 'Submitted At', 'Full Name', 'Title', 'Gender', 'Date of Birth',
            'APEC Economy', 'Organization', 'Position', 'Attending As', 'Economy',
            'Passport Type', 'Passport Number', 'Passport Expiry', 'Passport Copy',
            'Visa Status', 'Visa Email', 'Sessions', 'Arrival', 'Arrival Flight',
            'Departure', 'Departure Flight', 'Hotel', 'Contact Email', 'Phone',
            'Dietary', 'Accessibility',
        ];
    }

    /**
     * @param  Registration  $registration
     * @return array<int, mixed>
     */
    public function map(mixed $registration): array
    {
        return [
            $registration->id,
            $registration->created_at?->format('Y-m-d H:i:s'),
            $registration->full_name,
            $registration->title === 'other' ? $registration->title_other : $registration->title,
            $registration->gender,
            $registration->date_of_birth?->format('Y-m-d'),
            $registration->economy,
            $registration->organization,
            $registration->position,
            $registration->attending_as,
            $registration->nationality,
            $registration->passport_type,
            $registration->passport_number,
            $registration->passport_expiry?->format('Y-m-d'),
            $registration->passport_copy_path
                ? rtrim((string) config('app.url'), '/').route(
                    'admin.registrations.passport',
                    $registration,
                    absolute: false,
                )
                : null,
            $registration->visa_status,
            $registration->visa_email,
            implode('; ', array_keys(array_filter(
                $registration->sessions,
                fn (string $value): bool => $value === 'Yes',
            ))),
            $registration->arrival_at?->format('Y-m-d H:i:s'),
            $registration->arrival_flight,
            $registration->departure_at?->format('Y-m-d H:i:s'),
            $registration->departure_flight,
            $registration->hotel_name,
            $registration->email,
            $registration->phone,
            $registration->dietary === 'other' ? $registration->dietary_other : $registration->dietary,
            $registration->accessibility,
        ];
    }

    /** @return array<int|string, array<string, mixed>> */
    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '1F4E78'],
                ],
            ],
        ];
    }

    /** @return array<string, callable> */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event): void {
                $sheet = $event->sheet->getDelegate();
                $sheet->freezePane('A2');
                $sheet->setAutoFilter($sheet->calculateWorksheetDimension());

                for ($row = 2; $row <= $sheet->getHighestRow(); $row++) {
                    $passportCell = $sheet->getCell("O{$row}");
                    $passportUrl = $passportCell->getValue();

                    if (! is_string($passportUrl) || $passportUrl === '') {
                        continue;
                    }

                    $passportCell->setValue('Open Passport');
                    $passportCell->getHyperlink()->setUrl($passportUrl);
                    $passportCell->getStyle()->getFont()
                        ->setColor(new Color('0563C1'))
                        ->setUnderline(true);
                }
            },
        ];
    }
}
