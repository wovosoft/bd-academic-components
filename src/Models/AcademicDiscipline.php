<?php

namespace Wovosoft\BdAcademicComponents\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Wovosoft\BkbHrmsCore\Models\Employee;

/**
 * Wovosoft\BdAcademicComponents\Models\AcademicDiscipline
 *
 * @property int $id
 * @property string $name
 * @property string|null $bn_name
 * @property string|null $category
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDiscipline newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDiscipline newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDiscipline query()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDiscipline whereBnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDiscipline whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDiscipline whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDiscipline whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDiscipline whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDiscipline whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDiscipline whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AcademicDiscipline extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "bn_name",
        "category",
        "description"
    ];

//    public function employees(): HasManyThrough
//    {
//        return $this->hasManyThrough(
//            Employee::class,
//            AcademicInfo::class,
//            'profile_id',
//            'id',
//            'id',
//            'profile_id',
//
//        );
//    }
}
