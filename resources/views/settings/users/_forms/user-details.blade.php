<div class="row">
    <div class="c-field u-mb-small col-lg-6">
        <label class="c-field__label" for="first_name">Name</label>

        {!! Form::text('name', null, ['class' => 'c-input', 'placeholder' => 'Jason Bourne', 'id' => 'name']) !!}

        @if ($errors->has('name'))
            <small class="c-field__message u-color-danger">
                <i class="fa fa-times-circle"></i> {{ $errors->first('name') }}
            </small>
        @endif
    </div>

    <div class="c-field u-mb-small col-lg-6">
        <label class="c-field__label" for="username">Username</label>

        {!! Form::text('username', null, ['class' => 'c-input', 'placeholder' => 'jasonbourne', 'id' => 'username']) !!}

        @if ($errors->has('username'))
            <small class="c-field__message u-color-danger">
                <i class="fa fa-times-circle"></i> {{ $errors->first('username') }}
            </small>
        @endif
    </div>

    <div class="c-field u-mb-small col-lg-6">
        <label class="c-field__label" for="email">E-mail Address</label>

        {!! Form::email('email', null, ['class' => 'c-input', 'placeholder' => 'user@example.org']) !!}

        @if ($errors->has('email'))
            <small class="c-field__message u-color-danger">
                <i class="fa fa-times-circle"></i> {{ $errors->first('email') }}
            </small>
        @endif
    </div>

</div>

<div class="row">

    <div class="c-field u-mb-small col-lg-6">
        <label class="c-field__label" for="password">Password</label>

        {!! Form::password('password', ['class' => 'c-input']) !!}

        @if ($errors->has('password'))
            <small class="c-field__message u-color-danger">
                <i class="fa fa-times-circle"></i> {{ $errors->first('password') }}
            </small>
        @endif
    </div>

    <div class="c-field u-mb-small col-lg-6">
        <label class="c-field__label" for="password_confirmed">Password
            Confirmed</label>

        {!! Form::password('password_confirmation', ['class' => 'c-input']) !!}

        @if ($errors->has('password_confirmation'))
            <small class="c-field__message u-color-danger">
                <i class="fa fa-times-circle"></i> {{ $errors->first('password_confirmation') }}
            </small>
        @endif
    </div>

    <div class="c-field u-mb-small col-lg-6">
        <label class="c-field__label" for="active">Active</label>

        {!! Form::select('active', FormPopulator::yesNo() , null , ['class' => 'c-select select2-hidden-accessible']) !!}

        @if ($errors->has('active'))
            <small class="c-field__message u-color-danger">
                <i class="fa fa-times-circle"></i> {{ $errors->first('active') }}
            </small>
        @endif
    </div>

    <div class="c-field u-mb-small col-lg-12">
        <label class="c-field__label" for="active">Roles</label>

        <div class="row">
            @foreach(FormPopulator::roles() as $role)
                <div class="col-12 col-md-4 col-xl-3">
                    <div class="c-choice c-choice--checkbox">
                        {!! Form::checkbox('roles[]', $role, isset($user) ? $user->hasRole($role) : null,  ['class' => 'c-choice__input', 'id' => 'roles-' . $role]) !!}

                        <label class="c-choice__label" for="roles-{{ $role }}">{{ $role }}</label>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($errors->has('roles'))
            <small class="c-field__message u-color-danger">
                <i class="fa fa-times-circle"></i> {{ $errors->first('roles') }}
            </small>
        @endif
    </div>
</div>