<?php

namespace Wovosoft\BdAcademicComponents\Http\Controllers;

use App\Helpers\Util;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Wovosoft\BdAcademicComponents\Models\AcademicBoard;
use Wovosoft\BdAcademicComponents\Models\AcademicDiscipline;
use Wovosoft\BdAcademicComponents\Models\University;

class AcademicComponentsController extends Controller
{
    public static function routes()
    {
        Route::prefix("universities")
            ->name("universities.")
            ->controller(static::class)
            ->group(function () {
                Route::match(['get', 'post'], 'options', 'universityOptions')->name('options');
            });

        Route::prefix("academic-boards")
            ->name("academic-boards.")
            ->controller(static::class)
            ->group(function () {
                Route::match(['get', 'post'], 'options', 'academicBoardOptions')->name('options');
            });

        Route::prefix("academic-disciplines")
            ->name("academic-disciplines.")
            ->controller(static::class)
            ->group(function () {
                Route::match(['get', 'post'], 'options', 'academicDisciplineOptions')->name('options');
            });
    }

    public function universityOptions(Request $request)
    {
        return University::query()
            ->when($request->input('query'), function (Builder $builder, string $query) {
                $builder
                    ->where('name', Util::getLike(), "%$query%")
                    ->orWhere('bn_name', Util::getLike(), "%$query%");
            })
            ->select(['id', 'name', 'bn_name'])
            ->limit(30)
            ->get();
    }

    public function academicBoardOptions(Request $request)
    {
        return AcademicBoard::query()
            ->when($request->input('query'), function (Builder $builder, string $query) {
                $builder
                    ->where('name', Util::getLike(), "%$query%")
                    ->orWhere('bn_name', Util::getLike(), "%$query%");
            })
            ->select(['id', 'name', 'bn_name'])
            ->limit(30)
            ->get();
    }

    public function academicDisciplineOptions(Request $request)
    {
        return AcademicDiscipline::query()
            ->when($request->input('query'), function (Builder $builder, string $query) {
                $builder
                    ->where('name', Util::getLike(), "%$query%")
                    ->orWhere('bn_name', Util::getLike(), "%$query%");
            })
            ->select(['id', 'name', 'bn_name'])
            ->limit(30)
            ->get();
    }
}
