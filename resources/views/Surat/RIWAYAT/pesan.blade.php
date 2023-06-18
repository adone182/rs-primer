@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Pesan') }}</div>

                    <div class="card-body">
                        <ul class="list-group">
                            @if($notifikasi)
                                @foreach($notifikasi as $notif)
                                    {{-- @if(isset($notif->data['message'])) --}}
                                        <div class="notification" style="padding: 0 20px">
                                            <li>{{ $notif->message }}</li>
                                            <span class="timestamp">{{ $notif->created_at->diffForHumans() }}</span>
                                        </div>
                                    {{-- @endif --}}
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


{{-- @php
    use Pusher\Pusher;
@endphp

@section('footer') --}}
    {{-- <!-- Inisialisasi koneksi Pusher -->
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    
    <script>
       // Buat instance Pusher dengan menggunakan informasi kredensial Pusher Anda
        function loadUnreadCount() {
            fetch('/unread-notifications-count')
                .then(response => response.json())
                .then(data => {
                const unreadCount = data.unreadCount;
                const badge = document.getElementById('unreadCountBadge');
                const bellIcon = document.querySelector('.bi-bell');

                if (unreadCount > 0) {
                    badge.textContent = unreadCount;
                    badge.style.display = 'inline';
                    bellIcon.classList.add('unread');
                } else {
                    badge.style.display = 'none';
                    bellIcon.classList.remove('unread');
                }
                })
                .catch(error => {
                console.error('Error:', error);
                });
        }

        const pusher = new Pusher('PUSHER_KEY', {
        cluster: 'PUSHER_CLUSTER',
        encrypted: true
        });

        // Subscribe ke channel notifikasi pengguna
        const channel = pusher.subscribe('notifikasi-channel');

        // Tangani event 'NotifikasiDiterima' yang diterima dari Pusher
        channel.bind('NotifikasiDiterima', data => {
        // Perbarui jumlah notifikasi yang belum dibaca di tampilan
        const unreadCount = data.unreadCount;
        const badge = document.getElementById('unreadCountBadge');

        if (unreadCount > 0) {
            badge.textContent = unreadCount;
            badge.style.display = 'inline';
        } else {
            badge.style.display = 'none';
        }
        });

    </script> --}}
{{-- @endsection --}}
