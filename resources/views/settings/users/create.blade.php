@extends('layouts.master')

@section('page-title')
    Users | Create
@endsection

@section('content')
    <div class="c-toolbar u-mb-medium">
        <button class="c-sidebar-toggle u-mr-small">
            <span class="c-sidebar-toggle__bar"></span>
            <span class="c-sidebar-toggle__bar"></span>
            <span class="c-sidebar-toggle__bar"></span>
        </button>

        <h3 class="c-toolbar__title">Users</h3>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="c-tabs">
                    <ul class="c-tabs__list nav nav-tabs" id="myTab" role="tablist">
                        <li class="c-tabs__item">
                            <a class="c-tabs__link active show" id="nav-home-tab" data-toggle="tab"
                               href="#nav-home" role="tab"
                               aria-controls="nav-home"
                               aria-selected="true"
                            >
                                User Details
                            </a>
                        </li>
                    </ul>

                    <div class="c-tabs__content tab-content" id="nav-tabContent">
                        <div class="c-tabs__pane active show" id="nav-home" role="tabpanel"
                             aria-labelledby="nav-home-tab">
                            {!! Form::open(['route' => 'settings.users.store', 'method' => 'post']) !!}

                            @include('settings.users._forms.user-details')

                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="submit" class="c-btn c-btn--blue pull-right">
                                        Save
                                    </button>
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#first_name, #last_name').focusout(function () {
                let firstname = $('#first_name').val()

                let lastname = $('#last_name').val()

                $('#username').val(firstname + lastname)
            })
        })
    </script>
@endsection