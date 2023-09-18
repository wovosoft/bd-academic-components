<?php

namespace Wovosoft\BdAcademicComponents\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Route;
use Wovosoft\BdAcademicComponents\Models\University;
use Wovosoft\BdAcademicComponents\Http\Requests\StoreUniversityRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;
use Wovosoft\LaravelCommon\Helpers\Messages;

class UniversityController extends Controller
{
    public static function routes(){
        Route::controller(static::class)
            ->prefix("universities")
            ->name("universities.")
            ->group(function () {
                Route::get("/", "index")->name("index");
                Route::put("/store", "store")->name("store");
                Route::post("/options", "options")->name("options");
                Route::delete("/destroy/{university}", "destroy")->name("destroy");
            });
    }
    /**
     * @throws \Throwable
     */
    public function store(StoreUniversityRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            University::query()
                ->findOrFail($request->integer('id'))
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
        $items = University::query()
            ->when($request->input('query'), function (Builder $builder, string $query) {
                $builder->where("name", "ilike", "%$query%")
                    ->orWhere("bn_name", "ilike", "%$query%")
                    ->orWhere("code", "ilike", "%$query%");
            })
            ->paginate(
                perPage: $request->integer('per_page') ?: 15
            )
            ->appends($request->query());

        return Inertia::render("Basic/Universities", [
            "title" => "Universities",
            "items" => $items,
            "store_url" => route("basic.universities.store"),
            "delete_route" => "basic.universities.destroy"
        ]);
    }

    /**
     * @throws \Throwable
     */
    public function destroy(Request $request, University $university): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $university->deleteOrFail();
            DB::commit();
            return redirect()->back()->with("notification", Messages::success());
        } catch (\Throwable $exception) {
            DB::rollBack();
            return redirect()->back()->withErrors(Messages::failed($exception));
        }
    }

    public function options(Request $request): array|Collection|\Illuminate\Support\Collection
    {
        return University::query()
            ->when($request->input("query"), function (Builder $builder, string $query) {
                $builder->where("name", "ilike", "%$query%")
                    ->orWhere("bn_name", "ilike", "%$query%");
            })
            ->limit($request->integer("limit") ?: 30)
            ->get();
    }
}
