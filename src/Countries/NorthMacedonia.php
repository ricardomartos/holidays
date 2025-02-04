<?php

namespace Spatie\Holidays\Countries;

use Carbon\CarbonImmutable;

class NorthMacedonia extends Country
{
    public function countryCode(): string
    {
        return 'mk';
    }

    protected function allHolidays(int $year): array
    {
        return array_merge([
            'Нова година' => '01-01',
            'Божик, првиот ден на Божик според православниот календар' => '01-07',
            'Ден на трудот' => '05-01',
            'Св. Кирил и Методиј - Ден на сесловенските просветители' => '05-24',
            'Ден на Републиката' => '08-02',
            'Ден на независноста' => '09-08',
            'Ден на народното востание' => '10-11',
            'Ден на македонската револуционерна борба' => '10-23',
            'Св. Климент Охридски' => '12-08',
        ], $this->variableHolidays($year));
    }

    /** @return array<string, CarbonImmutable> */
    protected function variableHolidays(int $year): array
    {
        $easter = CarbonImmutable::createFromTimestamp($this->ortodoxEaster($year))
            ->setTimezone('Europe/Skopje');

        return [
            'Велигден, вториот ден на Велигден според православниот календар' => $easter->addDay(),
        ];
    }

    protected function ortodoxEaster(int $year): bool|int
    {
        $timestamp = easter_date($year, CAL_EASTER_ALWAYS_JULIAN);
        $daysDifference = (int) ($year / 100) - (int) ($year / 400) - 2;

        return strtotime("+$daysDifference days", $timestamp);
    }
}
