<?php

namespace Wovosoft\BdAcademicComponents\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Wovosoft\BdAcademicComponents\Models\AcademicBoard
 *
 * @property int $id
 * @property string $name
 * @property string|null $bn_name
 * @property string|null $url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicBoard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicBoard newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicBoard query()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicBoard whereBnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicBoard whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicBoard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicBoard whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicBoard whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicBoard whereUrl($value)
 * @mixin \Eloquent
 */
class AcademicBoard extends Model
{
    use HasFactory;
}
