@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <div class="card col-8 p-0 mb-3">
            <div class="card-header d-flex flex-row justify-content-between align-items-center">
                <span>{{ $ticket->title }}</span>
                @if($ticket->isClosed())
                    <span class="btn btn-light">Closed</span>
                @else
                    <a href="{{ route('ticket.close', $ticket) }}" class="btn btn-danger">Close</a>
                @endif
            </div>
            <div class="card-body">
                <div class="card-text">{{ $ticket->text }}</div>
                @if($ticket->hasFile())
                    <a class="mt-3" href="{{ $ticket->file() }}">Download Attachment</a>
                @endif
            </div>
            <div class="card-footer">
                {{ $ticket->created_at->diffForHumans() }} By {{ $ticket->user->name }}
            </div>
        </div>
        @foreach($ticket->replies as $reply)
            <div class="col-8 card mb-3 p-0">
                <div class="card-body">
                    <p class="card-text">{{ $reply->text }}</p>
                </div>
                <div class="card-footer text-muted">
                    {{ $reply->created_at->diffForHumans() }} By {{ $reply->repliable->name }}
                </div>
            </div>
        @endforeach
        @if(!$ticket->isClosed())
            <form method="post" class="col-8 p-0" action="{{ route('reply.create', $ticket) }}">
                <div class="form-group p-0">
                    @csrf
                    <textarea class="form-control w-100" placeholder="Enter Your Reply Text Here" aria-label="text"
                              name="text"
                              id="text"
                              rows="10"></textarea>

                </div>
                <button type="submit" class="btn btn-primary">Reply</button>
            </form>
        @endif

    </div>

@endsection
