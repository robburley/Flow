<proposals
        :opportunity="{{ $opportunity }}"
        :proposals="{{ $opportunity->proposals->load(['user', 'airtime', 'hardware', 'credits', 'totals', 'document', 'contact']) }}"
></proposals>