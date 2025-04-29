<?php

namespace Modules\Iad\Entities;

use Modules\Core\Icrud\Entities\CrudModel;

use Modules\Media\Support\Traits\MediaRelation;
use Modules\Notification\Traits\IsNotificable;

class Bid extends CrudModel
{

  use MediaRelation, isNotificable;

  protected $table = 'iad__bids';
  public $transformer = 'Modules\Iad\Transformers\BidTransformer';
  public $repository = 'Modules\Iad\Repositories\BidRepository';
  public $requestValidation = [
    'create' => 'Modules\Iad\Http\Requests\CreateBidRequest',
    'update' => 'Modules\Iad\Http\Requests\UpdateBidRequest',
  ];
  //Instance external/internal events to dispatch with extraData
  public $dispatchesEventsWithBindings = [
    //eg. ['path' => 'path/module/event', 'extraData' => [/*...optional*/]]
    'created' => [],
    'creating' => [],
    'updated' => [],
    'updating' => [],
    'deleting' => [],
    'deleted' => []
  ];

  protected $fillable = [
    'ad_id',
    'amount',
    'description',
    'currency',
    'delivery_days',
    'selected',
    'status_id',
    'options'
  ];

  protected $casts = ['options' => 'array'];

  protected $singleFlagName = 'selected';
  protected $singleFlaggableCombination = ['ad_id'];

  /**
   * Relations
   */
  public function ad()
  {
    return $this->belongsTo(Ad::class);
  }


  /**
   * Mutators
   */
  public function setOptionsAttribute($value)
  {
    $this->attributes['options'] = json_encode($value);
  }

  /*
  * Accesors
  */
  public function getStatusLabelAttribute()
  {
    return (new BidStatus())->get($this->status_id);
  }

  public function isNotificableParams($event)
  {
    $userToNotify = null;

    //Define email to notify
    if ($event == 'created') $userToNotify = $this->ad->user;
    else if ($event == 'updated') $userToNotify = $this->creator;
    if (!$userToNotify) return null;

    $userId = \Auth::id() ?? null;
    $source = "iad";

    //Notify to ad's user of a new bid
    $response = [
      'created' => [
        "title" => trans("iad::bids.newBidTitleEmail"),
        "message" => trans("iad::bids.newBidMessageEmail", ['title' => $this->ad->title]),
        "email" => $userToNotify->email,
        "broadcast" => $userToNotify->id,
        "userId" => $userId,
        "source" => $source
      ],
    ];

    //Notify bid selected
    if (in_array('selected', array_keys($this->getDirty())) && $this->selected) {
      $response['updated'] = [
        "title" => trans("iad::bids.selectedBidTitleEmail"),
        "message" => trans("iad::bids.selectedBidMessageEmail", ['title' => $this->ad->title]),
        "email" => $userToNotify->email,
        "broadcast" => $userToNotify->id,
        "userId" => $userId,
        "source" => $source
      ];
    }

    return $response;
  }
}
