<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - CSM SmartSchool</title>

    <link rel="stylesheet" href="../css/style1.css">
    <link rel="icon" href="../../img/books.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>

        body{
            background:#f4f6f9;
        }

        .chat-wrapper{
            max-width:1000px;
            margin:auto;
            padding:20px;
        }

        /* CARD PRINCIPAL (ALTURA REDUZIDA) */
        .chat-card{
            background:#fff;
            border-radius:18px;
            overflow:hidden;
            box-shadow:0 8px 30px rgba(0,0,0,.08);

            height:68vh;
            min-height:520px;

            display:flex;
            flex-direction:column;
        }

        /* HEADER */
        .chat-header{
            background:linear-gradient(135deg,#2563eb,#1e40af);
            color:white;

            display:flex;
            justify-content:space-between;
            align-items:center;

            padding:18px 25px;
        }

        .chat-user{
            display:flex;
            align-items:center;
            gap:15px;
        }

        .chat-user img{
            width:48px;
            height:48px;
            border-radius:50%;
            object-fit:cover;
            border:3px solid rgba(255,255,255,.4);
        }

        .chat-user h3{
            margin:0;
            font-size:18px;
        }

        .chat-user small{
            opacity:.9;
        }

        /* MENSAGENS */
        .chat-box{
            flex:1;
            overflow-y:auto;
            padding:20px;

            display:flex;
            flex-direction:column;
            gap:12px;

            background:#f8fafc;
            scroll-behavior:smooth;
        }

        .msg{
            max-width:75%;
            padding:12px 16px;
            border-radius:16px;
            font-size:14px;
            line-height:1.5;
            word-wrap:break-word;
        }

        .mine{
            align-self:flex-end;
            background:#2563eb;
            color:white;
            border-bottom-right-radius:5px;
        }

        .theirs{
            align-self:flex-start;
            background:#ffffff;
            color:#111827;
            border:1px solid #e5e7eb;
            border-bottom-left-radius:5px;
        }

        .meta{
            font-size:11px;
            margin-top:5px;
            opacity:.75;
        }

        /* INPUT */
        .chat-input{
            display:flex;
            gap:10px;
            padding:14px;
            border-top:1px solid #e5e7eb;
            background:white;
        }

        .chat-input input{
            flex:1;
            padding:12px 16px;
            border:1px solid #d1d5db;
            border-radius:25px;
            outline:none;
        }

        .chat-input input:focus{
            border-color:#2563eb;
            box-shadow:0 0 0 3px rgba(37,99,235,.15);
        }

        .chat-input button{
            width:45px;
            height:45px;
            border:none;
            border-radius:50%;
            background:#2563eb;
            color:white;
            cursor:pointer;
            transition:.2s;
        }

        .chat-input button:hover{
            background:#1e40af;
            transform:scale(1.05);
        }

        /* EMPTY */
        .empty-chat{
            margin:auto;
            text-align:center;
            color:#9ca3af;
        }

        /* SCROLLBAR */
        .chat-box::-webkit-scrollbar{
            width:6px;
        }

        .chat-box::-webkit-scrollbar-thumb{
            background:#cbd5e1;
            border-radius:10px;
        }

        /* RESPONSIVO */
        @media(max-width:768px){

            .chat-wrapper{
                padding:10px;
            }

            .chat-card{
                height:72vh;
                min-height:480px;
            }

            .msg{
                max-width:90%;
            }

        }

    </style>
</head>

<body>

    <!-- NAVBAR -->
    <div class="navbar">
        <div class="menu-toggle" onclick="toggleMenu()">☰</div>

        <div class="logo">
            <img src="../../img/logo.png">
        </div>

        <div class="search">
            <input type="text" placeholder="Pesquisar...">
        </div>
    </div>

    @include('partials.sidebargestchat')

    <div class="main-content">

        <div class="chat-wrapper">

            <div class="chat-card">

                <!-- HEADER -->
                <div class="chat-header">

                    <div class="chat-user">

                        <img src="{{ $user->photo ?? '../../img/default-user.png' }}">

                        <div>
                            <h3>
                                {{ $user->firstname }} {{ $user->lastname }}
                            </h3>
                            <small>
                                {{ $messages->count() }} mensagens
                            </small>
                        </div>

                    </div>

                    <i class="fas fa-comments fa-lg"></i>

                </div>

                <!-- CHAT -->
                <div class="chat-box" id="chatBox">

                    @forelse($messages as $message)

                        @php
                            $isMine = $message->sender_id === auth()->id();
                        @endphp

                        <div class="msg {{ $isMine ? 'mine' : 'theirs' }}">

                            <div>{{ $message->content }}</div>

                            <div class="meta">
                                {{ $isMine ? 'Você' : $message->sender->firstname }}
                                • {{ $message->created_at->format('d/m/Y H:i') }}
                            </div>

                        </div>

                    @empty

                        <div class="empty-chat">
                            <i class="fas fa-comments fa-3x"></i>
                            <p>Nenhuma mensagem ainda</p>
                        </div>

                    @endforelse

                </div>

                <!-- INPUT -->
                <form method="POST" action="{{ route('chat.send',$user->id) }}" class="chat-input">
                    @csrf

                    <input type="text" name="content" placeholder="Escreva uma mensagem..." required>

                    <button type="submit">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>

            </div>

        </div>

    </div>

<script>

    const box = document.getElementById("chatBox");
    if(box) box.scrollTop = box.scrollHeight;

    function toggleMenu(){
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("overlay");

        if(sidebar) sidebar.classList.toggle("open");
        if(overlay) overlay.classList.toggle("active");
    }

</script>

</body>
</html>