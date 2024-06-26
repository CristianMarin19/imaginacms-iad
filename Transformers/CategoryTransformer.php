<?php

namespace Modules\Iad\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Core\Icrud\Transformers\CrudResource;
use Modules\Isite\Transformers\RevisionTransformer;

class CategoryTransformer extends CrudResource
{
  /**
   * Method to merge values with response
   *
   * @return array
   */
  public function modelAttributes($request)
  {
    return [
      'url' => $this->url,
    ];
  }

}
