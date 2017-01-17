<?php

namespace App;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class Book extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'author',
        'publish_date',
        'resume',
        'format',
        'page_count',
        'isbn',
        'cover_path',
    ];

    public $nullableFields = [
        'page_count',
    ];

    const FORMAT_A4 = 'A4';
    const FORMAT_A3 = 'A3';

    /**
     * Create new book
     *
     * @param array $attributes
     * @return Book
     */
    public static function createNew(array $attributes): Book
    {
        if (empty($attributes['format'])) {
            $attributes['format'] = self::FORMAT_A4;
        }

        return self::create($attributes);
    }

    /**
     * @return Collection
     */
    public static function getAll(): Collection
    {
        return Book::all();
    }

    /**
     * @param $count
     * @return LengthAwarePaginator
     */
    public static function getItemsToPaginate($count): LengthAwarePaginator
    {
        return Book::orderBy('created_at', 'desc')->paginate($count);
    }

    /**
     * @return array
     */
    public static function getFormatTypes(): Array
    {
        return [self::FORMAT_A4, self::FORMAT_A3];
    }
}
