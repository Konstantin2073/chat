@extends('layouts.app')

@section('content')
<meta name="user-id" content="{{ auth()->id() }}">
<style>
.messages{
  background-color: white;
}
.active {
  background-color: lightgrey;
}
.new-message{
  background-color: lightblue;
}
</style>
<div class="container">
    <h1>Chat</h1>

    <div style="display:flex;">
        <div style="width:200px; border-right:1px solid #ccc; padding-right:10px;">
            <h3>Users</h3>
            <div style="display:flex;flex-direction: column;flex-wrap: nowrap;">
            @foreach($users as $user)
                <div id="{{ $user->id }}" class="selected-user-id" style="cursor: pointer;padding: 5px;border-bottom: 1px solid;">{{ $user->name }}</div>
            @endforeach
            </div>
        </div>

        <div style="flex:1; padding-left:10px;flex-direction: column;flex-wrap: nowrap;;">
            @foreach($users as $user)
                <div id="user-messages-{{ $user->id }}" class="user-messages-block">
                    <h4>Chat with {{ $user->name }}</h4>
                    <div class="messages" id="messages-{{ $user->id }}" style="min-height: 60vh; max-height: 60vh;overflow-y: auto;">
                        @if(isset($messages[$user->id]))
                            @foreach($messages[$user->id] as $msg)
                                <p>
                                    <strong>{{ $msg->sender->id === Auth::id() ? 'You' : $msg->sender->name }}:</strong>
                                    {{ $msg->message }}
                                </p>
                            @endforeach
                        @else
                            <p>No messages yet.</p>
                        @endif
                    </div>

                    <form method="POST" action="{{ route('chat.store') }}" class="chat-form" data-user="{{ $user->id }}">
                        @csrf
                        <input type="hidden" name="recipient_id" value="{{ $user->id }}">
                        <textarea name="message" required class="form-control" rows="3"></textarea>
                        <button type="submit" class="btn btn-primary mt-2">Send</button>
                    </form>
                <hr>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>

  window.userId = "{{ auth()->id() }}"; 
  window.userKey = "{{ auth()->id() }}"; 

document.addEventListener('DOMContentLoaded', function(){

    let users = document.querySelectorAll('.selected-user-id');
    let messages = document.querySelectorAll('.user-messages-block');

    function hideAllMessages(){
        messages.forEach(function(msg){ msg.style.display='none' });
    }

    users.forEach(function(user){
        user.addEventListener('click', function(){
            hideAllMessages();
            let msgBlock = document.getElementById('user-messages-' + this.id);
            if (msgBlock){
                msgBlock.style.display='block';
                block = document.getElementById('messages-' + this.id);
                block.scrollTop = block.scrollHeight
            }
            users.forEach(u => u.classList.remove('active'));
            this.classList.add('active');
            this.classList.remove('new-message');
            
        })
    })

    if(users.length>0){
	hideAllMessages()
        let firstMsg = document.getElementById('user-messages-' + users[0].id);
        if(firstMsg) firstMsg.style.display='block';
        if (users.length) users[0].classList.add('active');
    }

})
</script>

@vite('resources/js/echo.js')

@endsection
