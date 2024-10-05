<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

/**
 * Class Faq
 *
 * @version September 21, 2021, 12:51 pm UTC
 *
 * @property int $id
 * @property string $question
 * @property string $answer
 * @property int $is_default
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Database\Factories\FaqFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq query()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereUpdatedAt($value)
 *
 * @mixin Model
 */
class Faq extends Model
{
    use HasFactory;

    public $table = 'faqs';

    public $fillable = [
        'question',
        'answer',
        'is_default',
    ];

    protected $casts = [
        'question' => 'string',
        'answer' => 'string',
        'is_default' => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'question' => 'required',
        'answer' => 'required|max:1000',
    ];
}
