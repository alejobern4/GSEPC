// Simple chat widget JS (direct Hugging Face fetch)

document.addEventListener('DOMContentLoaded', function () {
    const openBtn = document.getElementById('hf-open-btn');
    const closeBtn = document.getElementById('hf-close-btn');
    const widget = document.getElementById('hf-widget');
    const form = document.getElementById('hf-form');
    const input = document.getElementById('hf-input');
    const messages = document.getElementById('hf-messages');

    function appendMessage(text, who = 'bot') {
        const el = document.createElement('div');
        el.className = 'hf-message ' + (who === 'user' ? 'user' : 'bot');
        const bubble = document.createElement('div');
        bubble.className = 'bubble';
        bubble.textContent = text;
        el.appendChild(bubble);
        messages.appendChild(el);
        messages.scrollTop = messages.scrollHeight;
    }

    openBtn?.addEventListener('click', function () {
        widget.style.display = 'flex';
        openBtn.style.display = 'none';
        input.focus();
    });

    closeBtn?.addEventListener('click', function () {
        widget.style.display = 'none';
        openBtn.style.display = 'inline-block';
    });

    form?.addEventListener('submit', function (e) {
        e.preventDefault();
        const text = input.value.trim();
        if (!text) return;

        appendMessage(text, 'user');
        input.value = '';
        appendMessage('Escribiendo...', 'bot');

        // Petición directa a Hugging Face
        fetch('/chat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ mensaje: text })
        })

        .then(async (res) => {
            // eliminar "Escribiendo..."
            const placeholders = messages.querySelectorAll('.hf-message.bot .bubble');
            if (placeholders.length) {
                const last = placeholders[placeholders.length - 1];
                if (last && last.textContent === 'Escribiendo...') {
                    last.textContent = '';
                    last.parentElement.remove();
                }
            }

            if (!res.ok) {
                appendMessage('Error al conectarse al chatbot.', 'bot');
                return;
            }

            const data = await res.json();

            // Ajusta según el modelo Hugging Face que uses
            const reply = data?.generated_text || 'No tengo respuesta 😅';
            appendMessage(reply, 'bot');
        })
        .catch((err) => {
            appendMessage('Error en la petición: ' + err.message, 'bot');
        });
    });
});
