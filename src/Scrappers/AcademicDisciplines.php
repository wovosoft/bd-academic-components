<?php

namespace Wovosoft\BdAcademicComponents\Scrappers;

use Wovosoft\BdAcademicComponents\Models\AcademicDiscipline;

use Illuminate\Support\Facades\File;


class AcademicDisciplines
{

    /**
     * @throws \Throwable
     */
    public function run(): bool
    {
        AcademicDiscipline::query()->insert(
            json_decode(File::get(base_path("static/files/discipline_parsed.json")),true)
        );
        return true;
    }
}
