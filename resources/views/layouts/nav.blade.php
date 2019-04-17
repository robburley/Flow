<div class="o-page__sidebar js-page-sidebar">
    <div class="c-sidebar">
        <a class="c-sidebar__brand" href="{{ route('dashboard') }}">
            <img class="c-sidebar__brand-img" src="{{ url('img/sidebar-icon3.png') }}" alt="Logo">

            {{ config('app.name') }}
        </a>

        <h4 class="c-sidebar__title">Agent</h4>

        <ul class="c-sidebar__list">

            <new-prospect-icon></new-prospect-icon>

            @hasanyrole('Admin|Supervisor|Closer')
            <li class="c-sidebar__item has-submenu {{ request()->is("mobile/*") ? 'is-open' : '' }}">
                <a class="c-sidebar__link {{ request()->is("mobile/*") ? '' : 'collapsed' }}"
                   data-toggle="collapse"
                   href="#sidebar-submenu-mobile"
                   aria-expanded="true" aria-controls="sidebar-submenu"
                >
                    <i class="fa fa-fw fa-mobile-phone u-mr-xsmall"></i>

                    Mobile
                </a>

                <ul class="c-sidebar__submenu {{ request()->is("mobile/*") ? 'show' : 'collapse collapsed' }}"
                    id="sidebar-submenu-mobile"
                >
                    <li>
                        <a class="c-sidebar__link"
                           href="{{ route('mobile.leads.index', 'fresh') }}"
                        >
                            <i class="fa fa-fw  fa-chevron-right u-mr-xsmall u-ml-medium"></i>

                            Fresh

                            <span class="c-badge c-badge--info c-badge--xsmall u-ml-auto u-mr-small">
                                {{ NavPopulator::LeadsCount(2) }}
                            </span>
                        </a>
                    </li>

                    <li>
                        <a class="c-sidebar__link"
                           href="{{ route('mobile.leads.index', 'callback') }}"
                        >
                            <i class="fa fa-fw  fa-chevron-right u-mr-xsmall u-ml-medium"></i>

                            Callback

                            <span class="c-badge c-badge--info c-badge--xsmall u-ml-auto u-mr-small">
                                {{ NavPopulator::LeadsCount(3) }}
                            </span>
                        </a>
                    </li>

                    <li>
                        <a class="c-sidebar__link"

                           href="{{ route('mobile.opportunities.index', 'negotiation') }}"
                        >
                            <i class="fa fa-fw  fa-chevron-right u-mr-xsmall u-ml-medium"></i>

                            Negotiation

                            <span class="c-badge c-badge--warning c-badge--xsmall u-ml-auto u-mr-small">
                                {{ NavPopulator::OpportunitiesCount(0) }}
                            </span>
                        </a>
                    </li>

                    <li>
                        <a class="c-sidebar__link"

                           href="{{ route('mobile.opportunities.index', 'proposed') }}"
                        >
                            <i class="fa fa-fw  fa-chevron-right u-mr-xsmall u-ml-medium"></i>

                            Proposed

                            <span class="c-badge c-badge--warning c-badge--xsmall u-ml-auto u-mr-small">
                                {{ NavPopulator::OpportunitiesCount(1) }}
                            </span>
                        </a>
                    </li>

                    <li>
                        <a class="c-sidebar__link"

                           href="{{ route('mobile.opportunities.index', 'underwriting') }}"
                        >
                            <i class="fa fa-fw  fa-chevron-right u-mr-xsmall u-ml-medium"></i>

                            Underwriting

                            <span class="c-badge c-badge--warning c-badge--xsmall u-ml-auto u-mr-small">
                                {{ NavPopulator::OpportunitiesCount(2) }}
                            </span>
                        </a>
                    </li>

                    <li>
                        <a class="c-sidebar__link"

                           href="{{ route('mobile.opportunities.index', 'pending') }}"
                        >
                            <i class="fa fa-fw  fa-chevron-right u-mr-xsmall u-ml-medium"></i>

                            Pending

                            <span class="c-badge c-badge--success c-badge--xsmall u-ml-auto u-mr-small">
                                {{ NavPopulator::OpportunitiesCount(3) }}
                            </span>
                        </a>
                    </li>

                    <li>
                        <a class="c-sidebar__link"

                           href="{{ route('mobile.opportunities.index', 'signed') }}"
                        >
                            <i class="fa fa-fw  fa-chevron-right u-mr-xsmall u-ml-medium"></i>

                            Signed

                            <span class="c-badge c-badge--success c-badge--xsmall u-ml-auto u-mr-small">
                                {{ NavPopulator::OpportunitiesCount(4) }}
                            </span>
                        </a>
                    </li>

                    <li>
                        <a class="c-sidebar__link"

                           href="{{ route('mobile.opportunities.index', 'lost') }}"
                        >
                            <i class="fa fa-fw  fa-chevron-right u-mr-xsmall u-ml-medium"></i>

                            Lost

                            <span class="c-badge c-badge--danger c-badge--xsmall u-ml-auto u-mr-small">
                                {{ NavPopulator::OpportunitiesCount(5) }}
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            @endhasanyrole

            <li class="c-sidebar__item ">
                <a class="c-sidebar__link {{ request()->is("callbacks*") ? 'is-active' : '' }}"
                   href="{{ route('callbacks.index') }}"
                >
                    <i class="fa fa-fw fa-phone u-mr-xsmall"></i>

                    Callbacks

                    <span class="c-badge c-badge--info c-badge--xsmall u-ml-auto u-mr-small">
                        {{ NavPopulator::CallbackCount() }}
                    </span>
                </a>
            </li>
        </ul>

        @hasanyrole('Admin|Supervisor')
        <h4 class="c-sidebar__title">Supervisor</h4>

        <ul class="c-sidebar__list">
            <li class="c-sidebar__item ">
                <a class="c-sidebar__link {{ request()->is("validation*") ? 'is-active' : '' }}"
                   href="{{ route('validation.index') }}">
                    <i class="fa fa-fw fa-check-square-o u-mr-xsmall"></i>

                    Validation

                    <span class="c-badge c-badge--warning c-badge--xsmall u-ml-auto u-mr-small">
                        {{ NavPopulator::ValidationCount() }}
                    </span>
                </a>
            </li>

            <li class="c-sidebar__item">
                <a class="c-sidebar__link  {{ request()->is("assignment*") ? 'is-active' : '' }}"
                   href="{{ route('assignment.index') }}">
                    <i class="fa fa-fw fa-users u-mr-xsmall"></i>

                    Assignment

                    <span class="c-badge c-badge--info c-badge--xsmall u-ml-auto u-mr-small">
                        {{ NavPopulator::AssignmentCount() }}
                    </span>
                </a>
            </li>
        </ul>
        @endhasanyrole

        @hasanyrole('Admin')
        <h4 class="c-sidebar__title">Reports</h4>

        <ul class="c-sidebar__list">
            <li class="c-sidebar__item has-submenu {{ request()->is("reports/mobile/*") ? 'is-open' : '' }}">
                <a class="c-sidebar__link {{ request()->is("reports/mobile/*") ? '' : 'collapsed' }}"
                   data-toggle="collapse"
                   href="#sidebar-submenu-mobile-reports"
                   aria-expanded="true" aria-controls="sidebar-submenu"
                >
                    <i class="fa fa-fw fa-mobile-phone u-mr-xsmall"></i>

                    Mobile
                </a>

                <ul class="c-sidebar__submenu {{ request()->is("reports/mobile/*") ? 'show' : 'collapse collapsed' }}"
                    id="sidebar-submenu-mobile-reports"
                >
                    <li>
                        <a class="c-sidebar__link"
                           href="{{ route('reports.mobile.reviews.index') }}"
                        >
                            <i class="fa fa-fw  fa-chevron-right u-mr-xsmall u-ml-medium"></i>

                            Reviews
                        </a>
                    </li>

                    <li>
                        <a class="c-sidebar__link"
                           href="{{ route('reports.mobile.qualification.index') }}"
                        >
                            <i class="fa fa-fw  fa-chevron-right u-mr-xsmall u-ml-medium"></i>

                            Qualification
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        @endhasanyrole

        @hasanyrole('Admin')
        <h4 class="c-sidebar__title">Settings</h4>

        <ul class="c-sidebar__list">
            <li class="c-sidebar__item  {{ request()->is("settings/users*") ? 'is-active' : '' }}">
                <a class="c-sidebar__link"
                   href="{{ route('settings.users.index') }}"
                >
                    <i class="fa fa-fw fa-users u-mr-xsmall"></i>

                    Users
                </a>
            </li>
        </ul>
        @endhasanyrole

        <h4 class="c-sidebar__title">User Account</h4>

        <ul class="c-sidebar__list">
            <li class="c-sidebar__item">
                <a class="c-sidebar__link" href="{{ route('logout') }}">
                    <i class="fa fa-fw fa-sign-out u-mr-xsmall"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</div>