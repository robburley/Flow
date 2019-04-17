<?php

namespace App\Http\Controllers\Api;

use App\Events\ProposalSaved;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProposalRequest;
use App\Models\Mobile\MobileOpportunity;
use App\Models\Mobile\Proposals\Proposal;

class ProposalsController extends Controller
{
    public function store(ProposalRequest $request, MobileOpportunity $opportunity)
    {
        $proposal = $opportunity->proposals()
                                ->create([
                                    'user_id'    => auth()->id(),
                                    'contact_id' => $request->get('contact_id'),
                                ]);

        collect(['airtime', 'hardware', 'credits', 'totals'])
            ->each(function ($relation) use ($request, $proposal) {
                collect($request->get($relation))
                    ->each(function ($data) use ($relation, $proposal) {
                        $proposal->{$relation}()
                                 ->create($data);
                    });
            });

        event(new ProposalSaved($proposal));

        return $proposal->load([
            'airtime',
            'hardware',
            'credits',
            'totals',
            'user',
            'document',
            'contact',
        ]);
    }

    public function update(ProposalRequest $request, MobileOpportunity $opportunity, Proposal $proposal)
    {
        $proposal->update([
            'contact_id' => $request->get('contact_id'),
        ]);

        collect(['airtime', 'hardware', 'credits', 'totals'])
            ->each(function ($relation) use ($request, $proposal) {
                $ids = collect($request->get($relation))->pluck('id');

                $ids->count() > 0 && $proposal->{$relation}()
                                              ->whereNotIn('id', $ids)
                                              ->delete();

                collect($request->get($relation))
                    ->each(function ($data) use ($relation, $proposal) {
                        if (array_key_exists('id', $data)) {
                            $item = $proposal->{$relation}()
                                             ->where('id', $data['id'])
                                             ->first();
                            if ($item) {
                                return $item->update($data);
                            }
                        }

                        return $proposal->{$relation}()
                                        ->create($data);
                    });
            });

        event(new ProposalSaved($proposal));

        return $proposal->load([
            'airtime',
            'hardware',
            'credits',
            'totals',
            'user',
            'document',
            'contact',
        ]);
    }
}
