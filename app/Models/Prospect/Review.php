<?php

namespace App\Models\Prospect;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Review extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
        'completed_at',
        'invalidated_at',
        'validated_at',
    ];

    protected $fillable = [
        'user_id',
        'prospect_id',
        'reviewable_type',
        'reviewable_id',
        'completed_at',
        'completed_by',
        'created_at',
        'validated_at',
        'invalidated_at',
        'validated_by',
        'hot_transfer',
        'hot_transfer_user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }

    public function completer()
    {
        return $this->belongsTo(User::class, 'completed_by');
    }

    public function prospect()
    {
        return $this->belongsTo(Prospect::class);
    }

    public function reviewable()
    {
        return $this->morphTo();
    }

    public function isComplete()
    {
        $validator = Validator::make($this->reviewable->toArray(), [
            'existing_networks'               => 'required',
            'number_of_handsets'              => 'required|numeric',
            'tablets_or_sim_devices'          => 'required',
            'handsets_working'                => 'required',
            'network_or_third_party'          => 'required',
            'customer_service_satisfaction'   => 'required',
            'customer_service_improvement'    => 'required',
            'signal_and_service'              => 'required',
            'monthly_bill'                    => 'required|numeric',
            'bill_fluctuation'                => 'required',
            'bill_format'                     => 'required',
            'receives_bill_analysis'          => 'required',
            'overseas_calls'                  => 'required',
            'contract_end_date'               => 'required|date',
            'add_numbers_after_contact_start' => 'required',
        ]);

        return $validator->passes();
    }

    public function CompleteReview()
    {
        $this->update([
            'completed_at' => Carbon::now(),
            'completed_by' => auth()->id(),
        ]);

        $this->completeCallbacks();

        if (!$this->hot_transfer || !$this->hot_transfer_user_id) {
            $this->reviewable()
                 ->update([
                     'status' => 1,
                 ]);

            return $this;
        }

        $this->update([
            'validated_at' => Carbon::now(),
            'validated_by' => $this->created_by,
        ]);

        $this->reviewable()
             ->update([
                 'status'  => 2,
                 'user_id' => $this->hot_transfer_user_id,
             ]);

        return $this->load([
            'user',
            'completer',
            'reviewable.user',
        ]);
    }

    public function partialReview()
    {
        $callback = auth()->user()->callbacks()
                          ->create([
                              'date_time'         => Carbon::now(),
                              'callbackable_type' => get_class($this->prospect),
                              'callbackable_id'   => $this->prospect->id,
                          ]);

        $this->completeCallbacks($callback);

        return $this->load([
            'user',
            'completer',
            'reviewable.user',
        ]);
    }

    public function completeCallbacks($callback = null)
    {
        $this->prospect->callbacks
            ->each(function ($item) use ($callback) {
                if (!$callback || $item->id != $callback->id) {
                    $item->update([
                        'completed_at' => Carbon::now(),
                    ]);
                }
            });
    }
}
