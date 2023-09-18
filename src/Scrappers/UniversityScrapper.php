<?php

namespace Wovosoft\BdAcademicComponents\Scrappers;

use DOMDocument;
use Illuminate\Support\Facades\Http;
use Wovosoft\BdAcademicComponents\Enums\InstitutionManagementType;
use Wovosoft\BdAcademicComponents\Enums\InstitutionType;
use Wovosoft\BdAcademicComponents\Enums\StudyType;

class UniversityScrapper
{
    const PUBLIC_URL = "http://www.ugc-universities.gov.bd/public-universities";
    const PRIVATE_URL = "http://www.ugc-universities.gov.bd/private-universities";
    const INTERNATIONAL_URL = "http://www.ugc-universities.gov.bd/international-universities";

    public function scrap()
    {
        $universities = collect();
        $dir = __DIR__ . "/../../static/";

        $old = collect(json_decode(\File::get($dir . 'universities_bengali.json')));

        collect([self::PUBLIC_URL, self::PRIVATE_URL, self::INTERNATIONAL_URL])->each(function (string $url) use ($old, $universities) {
            $content = Http::get($url);
            $dom = new DOMDocument(version: 1.0, encoding: 'utf-8');
            @$dom->loadHTML($content->body());
            $dom->preserveWhiteSpace = true;
            $table = $dom->getElementsByTagName("table");

            $rows = $table->item(0)?->getElementsByTagName('tbody')?->item(0)?->getElementsByTagName('tr');

            foreach ($rows as $row) {
                $cols = $row->getElementsByTagName('td');
                $name = str($cols->item(1)?->getElementsByTagName('a')?->item(0)->nodeValue)->trim()->value();

                $website = str($cols->item(2)->nodeValue)->trim();
                $code = strtoupper($website->explode(".")?->get(1));
                $existing = $old->where('code', '=', $code)->first();


                $universities->add([
                    "name"        => $name,
                    "bn_name"     => $existing?->bn_name,
                    "district_id" => null,
                    "upazila_id"  => null,
                    "post_office" => null,
                    "phone"       => null,
                    "type"        => InstitutionType::UNIVERSITY,
                    "management"  => match ($url) {
                        self::PUBLIC_URL => InstitutionManagementType::PUBLIC,
                        self::PRIVATE_URL => InstitutionManagementType::PRIVATE,
                        self::INTERNATIONAL_URL => InstitutionManagementType::INTERNATIONAL,
                        default => null
                    },
                    "level"       => null,
                    "code"        => $code ?: null,
                    "study_type"  => StudyType::CO_EDUCATION_JOINT,
                    "area"        => null,
                    "geography"   => null,
                    "logo"        => null,
                    "website"     => $website->value(),
                    "details"     => null
                ]);
            }
        });
        \File::put($dir . "universities.json", $universities->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}
