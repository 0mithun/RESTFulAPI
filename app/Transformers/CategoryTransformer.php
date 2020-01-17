<?php

namespace App\Transformers;

use App\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Category $category)
    {
        return [
            'identifier'    =>  (int) $category->id,
            'title'         =>  (string) $category->name,
            'detail'        =>  (string) $category->description,
            'create_date'   =>  (string)$category->created_at,
            'last_change'   =>  (string)$category->updated_at,
            'delete_date'   =>  isset($category->deleted_at) ? (string) $category->deleted_at: NULL,
            'links' =>[
                [
                    'rel'       =>  'self',
                    'href'      =>  route('categories.show', $category->id)
                ],
                [
                    'rel'       =>  'categories.buyers',
                    'href'      =>  route('categories.buyers.index', $category->id)
                ],
                [
                    'rel'       =>  'cateories.products',
                    'href'      =>  route('categories.products.index', $category->id)
                ],
                [
                    'rel'       =>  'categories.sellers',
                    'href'      =>  route('categories.sellers.index', $category->id)
                ],
                [
                    'rel'       =>  'categories.transactions',
                    'href'      =>  route('categories.transactions.index', $category->id)
                ],
            ]
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'identifier'    =>  'id',
            'title'         =>  'name',
            'detail'        =>  'description',
            'create_date'   =>  'created_at',
            'last_change'   =>  'updated_at',
            'delete_date'   =>  'deleted_at'
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
