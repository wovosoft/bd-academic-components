<?php

namespace Wovosoft\BdAcademicComponents\Scrappers;

use App\Helpers\Util;
use Symfony\Component\Console\Output\ConsoleOutput;
use Wovosoft\BdAcademicComponents\Enums\InstitutionArea;
use Wovosoft\BdAcademicComponents\Enums\InstitutionGeography;
use Wovosoft\BdAcademicComponents\Enums\InstitutionLevel;
use Wovosoft\BdAcademicComponents\Enums\InstitutionManagementType;
use Wovosoft\BdAcademicComponents\Enums\InstitutionType;
use Wovosoft\BdAcademicComponents\Enums\StudyType;
use Wovosoft\BdAcademicComponents\Models\University;
use Wovosoft\BdGeocode\Models\District;
use Wovosoft\BdGeocode\Models\Division;
use Wovosoft\BdGeocode\Models\Union;
use Wovosoft\BdGeocode\Models\Upazila;
use Symfony\Component\Console\Helper\ProgressBar;

class SchoolAndCollegeConverter
{
    public function run(): void
    {
        $files = [
            "college.csv",
            "school.csv",
            "school_and_college.csv"
        ];

        foreach ($files as $file) {
            $this->convert($file);
        }
    }

    public function convert(string $file): void
    {
        echo "Importing $file \n";
        $dir = __DIR__ . "/../../static/";
        $schools = Util::csvToCollection($dir . $file);
        $output = new ConsoleOutput();
        $progressBar = new ProgressBar(output: $output, max: $schools->count());
//        $missing = [];
        $schools->each(function (array $item) use ($progressBar) {
            $progressBar->advance();
            $district = match ($item['DISTRICT']) {
                'Jhalokati' => 'Jhalakathi',
                'Brahamanbaria' => 'Brahmanbaria',
                'Coxs Bazar' => 'Coxsbazar',
                'Norail' => 'Narail',
                'Netrakona' => 'Netrokona',
                'Nawabganj' => 'Chapainawabganj',
                'Maulvibazar' => 'Moulvibazar',
                default => $item['DISTRICT']
            };

            $upazila = match (trim($item['UPAZILA/THANA'])) {
                'Jhalokati' => 'Jhalakathi',
                'Brahamanbaria' => 'Brahmanbaria',
                'Coxs Bazar' => 'Coxsbazar',
                'Norail' => 'Narail',
                'Netrakona' => 'Netrokona',
                'Nawabganj' => 'Chapainawabganj',
                'Maulvibazar' => 'Moulvibazar',
                'Patharghata' => 'Pathorghata',
                'Banari Para' => 'Banaripara',
                'Gaurnadi' => 'Gournadi',
                'Barisal Sadar (Kotwali)' => 'Barisal Sadar',
                'Burhanuddin' => 'Borhan Sddin',
                'Char Fasson' => 'Charfesson',
                'Daulat Khan' => 'Doulatkhan',
                'Manpura' => 'Monpura',
                'Jhalokati Sadar' => 'Jhalakathi Sadar',
                'Kanthalia' => 'Kathalia',
                'Dumki Upazila' => 'Dumki',
                'Kala Para' => 'Kalapara',
                'Mirzaganj Upazila' => 'Mirzaganj',
                'Nazirpur Upazila' => 'Nazirpur',
                'Nesarabad (Swarupkati)' => 'Nesarabad',
                'Banchharampur' => 'Bancharampur',
                'Faridganj' => 'Faridgonj',
                'Haim Char' => 'Haimchar',
                'Matlab Dakshin' => 'Matlab South',
                'Matlab Uttar' => 'Matlab North',
                'Anowara' => 'Anwara',
                default => trim($item['UPAZILA/THANA'])
            };

//            if (is_null($this->getAddressId(Upazila::class, $upazila))) {
//                if (!in_array($upazila, $missing)) {
//                    $missing[] = $upazila;
//                }
//            }

            $school = new University();
            $school->forceFill([
                "district_id" => $this->getAddressId(District::class, $district),
                "upazila_id"  => $this->getAddressId(Upazila::class, $upazila),
                "type"        => InstitutionType::fromRaw($item['INSTITUTE TYPE']),
                "level"       => InstitutionLevel::fromRaw($item['INSTITUTE LEVEL']),
                "code"        => $item['EIIN'],
                "name"        => $item['INSTITUTE NAME'],
                "bn_name"     => $item['INSTITUTE NAME'],
                "address"     => $item['ADDRESS'],
                "post_office" => $item['POST'],
                "phone"       => $item['MOBAILE'],
                "management"  => InstitutionManagementType::fromRaw($item['MANAGEMENT']),
                "study_type"  => StudyType::fromRaw($item['STUDY TYPE']),
                "area"        => InstitutionArea::fromRaw($item['AREA']),
                "geography"   => InstitutionGeography::fromRaw($item['GEOGRPY']),
            ]);
//                dd($item, $school->toArray());
            return $school->saveQuietly();
        });
        $progressBar->finish();
//        print implode(", ", $missing);
        echo "\nDone";
    }

    /**
     * @param class-string<District|Division|Upazila|Union> $class
     * @param string|null                                   $value
     * @return int|null
     */
    private function getAddressId(string $class, ?string $value): ?int
    {
        return $class::query()->select('id')->where('name', '=', $value)->first()?->id;
    }
}
