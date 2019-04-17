<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mobile\MobileLead;
use App\Models\Prospect\Prospect;
use App\Models\Prospect\Review;
use App\Rules\MaximumReviews;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function store(Request $request, Prospect $prospect)
    {
        $data = $request->validate([
            'existing_networks'                   => 'nullable',
            'number_of_handsets'                  => 'nullable|numeric',
            'tablets_or_sim_devices'              => 'nullable',
            'handsets_working'                    => 'nullable',
            'network_or_third_party'              => 'nullable',
            'customer_service_satisfaction'       => 'nullable',
            'customer_service_improvement'        => 'nullable',
            'customer_service_improvement_detail' => 'nullable',
            'signal_and_service'                  => 'nullable',
            'monthly_bill'                        => 'nullable|numeric',
            'bill_fluctuation'                    => 'nullable',
            'bill_format'                         => 'nullable',
            'receives_bill_analysis'              => 'nullable',
            'overseas_calls'                      => 'nullable',
            'contract_end_date'                   => 'nullable|date',
            'add_numbers_after_contact_start'     => 'nullable',
            'hot_transfer'                        => 'nullable',
            'hot_transfer_user_id'                => 'required_if:hot_transfer,1',
            'prospect'                            => [
                new MaximumReviews(),
            ],
        ]);

        $lead = MobileLead::create($request->only([
            'existing_networks',
            'number_of_handsets',
            'tablets_or_sim_devices',
            'handsets_working',
            'network_or_third_party',
            'customer_service_satisfaction',
            'customer_service_improvement',
            'customer_service_improvement_detail',
            'signal_and_service',
            'monthly_bill',
            'bill_fluctuation',
            'bill_format',
            'receives_bill_analysis',
            'overseas_calls',
            'contract_end_date',
            'add_numbers_after_contact_start',
        ]));

        if ($request->has('document')) {
            $lead->addDocument($request->only('document'));
        }

        $review = auth()->user()->reviews()
                        ->create([
                            'prospect_id'          => $prospect->id,
                            'reviewable_type'      => get_class($lead),
                            'reviewable_id'        => $lead->id,
                            'hot_transfer'         => $request->get('hot_transfer'),
                            'hot_transfer_user_id' => $request->get('hot_transfer_user_id'),
                        ]);

        $review->isComplete()
            ? $review->CompleteReview()
            : $review->partialReview();

        return $review->load([
            'user',
            'completer',
            'reviewable.user',
        ]);
    }

    public function update(Request $request, Prospect $prospect, Review $review)
    {
        $request->validate([
            'existing_networks'                   => 'nullable',
            'number_of_handsets'                  => 'nullable|numeric',
            'tablets_or_sim_devices'              => 'nullable',
            'handsets_working'                    => 'nullable',
            'network_or_third_party'              => 'nullable',
            'customer_service_satisfaction'       => 'nullable',
            'customer_service_improvement'        => 'nullable',
            'customer_service_improvement_detail' => 'nullable',
            'signal_and_service'                  => 'nullable',
            'monthly_bill'                        => 'nullable|numeric',
            'bill_fluctuation'                    => 'nullable',
            'bill_format'                         => 'nullable',
            'receives_bill_analysis'              => 'nullable',
            'overseas_calls'                      => 'nullable',
            'contract_end_date'                   => 'nullable|date',
            'add_numbers_after_contact_start'     => 'nullable',
            'hot_transfer'                        => 'required',
            'hot_transfer_user_id'                => 'requiredIf:hot_transfer,1',
        ]);

        $review->update([
            'hot_transfer'         => $request->get('hot_transfer'),
            'hot_transfer_user_id' => $request->get('hot_transfer_user_id'),
        ]);

        $review->reviewable->update($request->only([
            'existing_networks',
            'number_of_handsets',
            'tablets_or_sim_devices',
            'handsets_working',
            'network_or_third_party',
            'customer_service_satisfaction',
            'customer_service_improvement',
            'customer_service_improvement_detail',
            'signal_and_service',
            'monthly_bill',
            'bill_fluctuation',
            'bill_format',
            'receives_bill_analysis',
            'overseas_calls',
            'contract_end_date',
            'add_numbers_after_contact_start',
        ]));

        if ($request->has('document')) {
            $review->reviewable->addDocument($request->only('document'));
        }

        return $review->isComplete()
            ? $review->CompleteReview()
            : $review->partialReview();
    }
}
