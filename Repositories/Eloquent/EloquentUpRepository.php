<?php

namespace Modules\Iad\Repositories\Eloquent;

use Modules\Core\Icrud\Repositories\Eloquent\EloquentCrudRepository;
use Modules\Iad\Repositories\UpRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Icommerce\Events\CreateProductable;
use Modules\Icommerce\Events\UpdateProductable;
use Modules\Icommerce\Events\DeleteProductable;

class EloquentUpRepository extends EloquentCrudRepository implements UpRepository
{
    /**
     * Filter names to replace
     *
     * @var array
     */
    protected $replaceFilters = [];

    /**
     * Relation names to replace
     *
     * @var array
     */
    protected $replaceSyncModelRelations = [];

    /**
     * Filter query
     *
     * @return mixed
     */
    public function filterQuery($query, $filter, $params)
    {
        //add filter by search
        if (isset($filter->search)) {
            //find search in columns
            $query->where(function ($query) use ($filter) {
                $query->where('id', 'like', '%'.$filter->search.'%')
                  ->orWhere('updated_at', 'like', '%'.$filter->search.'%')
                  ->orWhere('created_at', 'like', '%'.$filter->search.'%');
            });
        }
        //Response
        return $query;
    }

    /**
     * Method to sync Model Relations
     *
     * @param $model ,$data
     * @return $model
     */
    public function syncModelRelations($model, $data)
    {
        //Get model relations data from attribute of model
        $modelRelationsData = ($model->modelRelations ?? []);

        /**
         * Note: Add relation name to replaceSyncModelRelations attribute before replace it
         *
         * Example to sync relations
         * if (array_key_exists(<relationName>, $data)){
         *    $model->setRelation(<relationName>, $model-><relationName>()->sync($data[<relationName>]));
         * }
         */

        //Response
        return $model;
    }
}
