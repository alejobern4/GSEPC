@php
    $position = env('HF_WIDGET_POSITION', 'bottom-right'); // bottom-right, bottom-left, bottom-center
@endphp

<div id="hf-chatbot" class="hf-chatbot hf-pos-{{ $position }}">
    <button id="hf-open-btn" class="hf-open-btn">💬</button>

    <div id="hf-widget" class="hf-widget" style="display:none;">
        <div class="hf-header">
            <span>Asistente</span>
            <button id="hf-close-btn" class="hf-close-btn">✕</button>
        </div>
        <div id="hf-messages" class="hf-messages"></div>
        <form id="hf-form" class="hf-form">
            <input id="hf-input" type="text" placeholder="Escribe un mensaje..." autocomplete="off" required />
            <button type="submit">Enviar</button>
        </form>
    </div>

    @vite('resources/js/chatbot.js')

    <style>
        /* Minimal styles for the widget */
        .hf-chatbot { position: fixed; z-index: 2000; }
        .hf-pos-bottom-right { right: 24px; bottom: 24px; }
        .hf-pos-bottom-left { left: 24px; bottom: 24px; }
        .hf-pos-bottom-center { left: 50%; transform: translateX(-50%); bottom: 24px; }
        .hf-open-btn {
            width: 56px; height: 56px; border-radius: 50%; background:#1abc6c; color:white; border:none; font-size:22px; cursor:pointer; box-shadow:0 4px 12px rgba(0,0,0,.2);
        }
        .hf-widget { width: 320px; max-height: 480px; background: #fff; border-radius:10px; box-shadow:0 8px 30px rgba(0,0,0,.2); overflow:hidden; display:flex; flex-direction:column; }
        .hf-header { background:#1abc6c; color:#fff; padding:10px 12px; display:flex; justify-content:space-between; align-items:center; font-weight:600; }
        .hf-messages { padding:12px; overflow:auto; flex:1 1 auto; background:#f7f7f7; }
        .hf-message { margin-bottom:8px; }
        .hf-message.user { text-align:right; }
        .hf-message .bubble { display:inline-block; padding:8px 12px; border-radius:14px; max-width:80%; }
        .hf-message.user .bubble { background:#1abc6c; color:#fff; }
        .hf-message.bot .bubble { background:#e9ecef; color:#333; }
        .hf-form { display:flex; gap:8px; padding:8px; border-top:1px solid #eee; }
        .hf-form input { flex:1 1 auto; padding:8px 10px; border:1px solid #ddd; border-radius:6px; }
        .hf-form button { background:#1abc6c; color:#fff; border:none; padding:8px 12px; border-radius:6px; cursor:pointer; }
    </style>
</div>
