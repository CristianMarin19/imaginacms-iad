<?php

namespace Modules\Iad\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

use Modules\Core\Icrud\Transformers\CrudResource;

class AdUpTransformer extends CrudResource
{
  
  /**
   * Method to merge values with response
   *
   * @return array
   */
  public function modelAttributes($request)
  {
    return [
      'rangeMinutes' => $this->range_minutes,
      'nextUpload' => $this->next_upload,
    ];
  }
}
