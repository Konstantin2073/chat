import Echo from 'laravel-echo';

import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT,
    wssPort: import.meta.env.VITE_REVERB_PORT,
    forceTLS: false,
    enabledTransports: ['ws','wss'],
    authEndpoint: '/broadcasting/auth',
    auth: {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    }
});


window.Echo.private(`chat.${window.userId}`)
    .listen('NewMessage', (e) => {
        console.log(e);
        const msgContainer = document.getElementById('messages-' + e.sender_id);
        let userBlock = document.getElementById(e.sender_id);
	userBlock.classList.add('new-message');
        if(msgContainer) {
            const p = document.createElement('p');
            p.innerHTML = `<strong>${e.sender_id == userId ? 'You' : e.sender_name}:</strong> ${e.message}`;
            msgContainer.appendChild(p);
        }
    });


document.querySelectorAll('.chat-form').forEach(form => {
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        const recipientId = this.dataset.user;
        const formData = new FormData(this);

        const response = await fetch(this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': formData.get('_token')
            },
            body: formData
        });

        if(response.ok) {
            const msgText = this.querySelector('textarea[name="message"]').value;
            const msgContainer = document.getElementById('messages-' + recipientId);
            const p = document.createElement('p');
            p.innerHTML = `<strong>You:</strong> ${msgText}`;
            msgContainer.appendChild(p);
            this.querySelector('textarea[name="message"]').value = '';
        }
    });
});
