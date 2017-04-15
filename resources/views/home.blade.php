@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Vložiť miesto</div>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="panel-body">
                   {!! Form::open(['route' => 'store','files'=>'true']) !!}
                   {!!Form::label('name', 'označenie') !!}
                   {!! Form::text('name') !!}<br>
                   {!!Form::label('address', 'adresa') !!}
                   {!! Form::text('address') !!}<br>
                   {!!Form::label('type', 'type') !!}
                   {!! Form::select('type', array('restaurant' => 'ikona1', 'bar' => 'ikona2')) !!}<br>
                    <input type="hidden" name="size" value="small" />
                    <input type="checkbox" name="size" value="big" />
                    {!! Form::file('image') !!}<br>
                   {!! Form::submit('Vložiť') !!}
                   {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
