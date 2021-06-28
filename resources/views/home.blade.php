@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" id="ticket-title">{{ __('ticket.title') }}</div>

                <div class="card-body">
                    @if(isset($type))
                        <div class="alert alert-{{ $type }}">{{ $message }}
                            @foreach($errors as $key => $error)
                                @foreach($error as $key => $item)
                                    <p> * {{ $item }} </p>
                                @endforeach
                            @endforeach
                        </div>
                    @endif

                {{--    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}
                    --}}
                    <form action="/home" method="post" >
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <label for="subject-control">{{ __('ticket.subject') }}:</label>
                            <input type="text" id="subject-control" class="form-control" name="subject" value="{{ old('subject') }}" aria-describedby="subject-help" required/>
                            <div id="subject-help" class="form-text">{{ __('ticket.subject-help') }}</div>
                        </div>
                        <div class="mb-3">
                            <label for="username-control">{{ __('ticket.username') }}:</label>
                            <input type="text" id="username-control" class="form-control" name="user_name" value="{{ old('user_name') }}" aria-describedby="username-help" required/>
                            <div id="username-help" class="form-text">{{ __('ticket.username-help') }}</div>
                        </div>
                        <div class="mb-3">
                            <label for="email-control">{{ __('ticket.email') }}:</label>
                            <input type="email" id="email-control" class="form-control" name="user_email" value="{{ old('user_email') }}" aria-describedby="email-help" required/>
                            <div id="email-help" class="form-text">{{ __('ticket.email-help') }}</div>
                        </div>
                        <div class="mb-3">
                            <label for="content-control">{{ __('ticket.content') }}:</label>
                            <textarea id="content-control" class="form-control" name="content" value="{{ old('content') }}" aria-describedby="content-help" required></textarea>
                            <div id="content-help" class="form-text">{{ __('ticket.content-help') }}</div>
                        </div>
                        <div class="mb-3">
                            <label>{{ __('ticket.attached-credentials') }}</label><br/>
                            <credentials-manager></credentials-manager>
                        </div>
                        <button type="submit" id="credentials-from-submit"  class="btn-primary btn">{{ __('ticket.complete') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
