<?php

namespace Wovosoft\BdAcademicComponents\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Route;
use Wovosoft\BdAcademicComponents\Http\Requests\StoreAcademicDisciplineRequest;
use Wovosoft\BdAcademicComponents\Models\AcademicDiscipline;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;
use Wovosoft\LaravelCommon\Helpers\Messages;

class AcademicDisciplineController extends Controller
{
    public static function routes()
    {
        Route::controller(static::class)
            ->prefix("academic-disciplines")
            ->name("academic-disciplines.")
            ->group(function () {
                Route::get("/", "index")->name("index");
                Route::put("/store", "store")->name("store");
                Route::post("/options", "options")->name("options");
                Route::delete("/destroy/{academicDiscipline}", "destroy")->name("destroy");
                Route::match(['get', 'post'], "/employees-of/{academicDiscipline}", "employeesOf")->name("employees-of");
            });
    }

    /**
     * @throws \Throwable
     */
    public function store(StoreAcademicDisciplineRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            AcademicDiscipline::query()
                ->findOrNew($request->integer('id'))
                ?->forceFill($request->validated())
                ->saveOrFail();
            DB::commit();
            return redirect()->back()->with("notification", Messages::success());
        } catch (\Throwable $exception) {
            DB::rollBack();
            return redirect()->back()->withErrors(Messages::failed($exception));
        }
    }

    public function index(Request $request): Response
    {
        $items = AcademicDiscipline::query()
            ->when($request->input('query'), function (Builder $builder, string $query) {
                $builder->where("name", "ilike", "%$query%")
                    ->orWhere("bn_name", "ilike", "%$query%");
            })
            ->paginate(
                perPage: $request->integer('per_page') ?: 15
            )
            ->appends($request->query());

        return Inertia::render("Basic/AcademicDisciplines", [
            "title"        => "Academic Disciplines",
            "items"        => $items,
            "store_url"    => route("basic.academic-disciplines.store"),
            "delete_route" => "basic.academic-disciplines.destroy"
        ]);
    }

    /**
     * @throws \Throwable
     */
    public function destroy(Request $request, AcademicDiscipline $academicDiscipline): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $academicDiscipline->deleteOrFail();
            DB::commit();
            return redirect()->back()->with("notification", Messages::success());
        } catch (\Throwable $exception) {
            DB::rollBack();
            return redirect()->back()->withErrors(Messages::failed($exception));
        }
    }

    public function options(Request $request): array|Collection|\Illuminate\Support\Collection
    {
        return AcademicDiscipline::query()
            ->when($request->input("query"), function (Builder $builder, string $query) {
                $builder->where("name", "ilike", "%$query%")
                    ->orWhere("bn_name", "ilike", "%$query%");
            })
            ->limit($request->integer("limit") ?: 30)
            ->get();
    }

    public function employeesOf(AcademicDiscipline $academicDiscipline)
    {
        return $academicDiscipline->employees()->toSql();
    }
}
