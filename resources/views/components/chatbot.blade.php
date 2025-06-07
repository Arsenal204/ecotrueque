<style>
    #chatbot {
        position: fixed;
        right: 20px;
        bottom: 20px;
        width: 320px;
        background-color: #f4e1c1;
        border: 3px solid #8a4b2a;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        padding: 15px;
        display: none;
        font-size: 14px;
        z-index: 9999;
        height: 90%;
    }

    #chatbot h5 {
        font-size: 1.4em;
        text-align: center;
        color: #8a4b2a;
        font-weight: bold;
        margin-bottom: 15px;
    }

    #chatbot .form-group {
        margin-bottom: 15px;
    }

    #chatbot button {
        width: 100%;
        background-color: #8a4b2a;
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
        font-weight: bold;
    }

    #chatbot button:hover {
        background-color: #6f3e1f;
    }

    #response {
        margin-top: 15px;
        padding: 10px;
        min-height: 50px;
        height: 450px;
        overflow-y: auto;
        background-color: #fff8e1;
        border: 2px solid #8a4b2a;
        border-radius: 8px;
    }

    #chatbot-toggle {
        position: fixed;
        right: 20px;
        bottom: 20px;
        background-color: #8a4b2a;
        color: white;
        padding: 15px 20px;
        border-radius: 50%;
        font-size: 30px;
        cursor: pointer;
        z-index: 9999;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    }

    #chatbot-toggle:hover {
        background-color: #6f3e1f;
    }
</style>

<div id="chatbot">
    <h5>🌿 Ekoala 🐨</h5>
    <div class="form-group">
        <input type="text" class="form-control" id="userInput" placeholder="¿Cómo puedo ayudar al planeta hoy?" />
        <p class="text-xs mt-2 text-gray-600">
            Ejemplos: "¿Cómo reducir el plástico?", "¿Qué es el reciclaje?", "Consejos ecológicos para casa"
        </p>
    </div>
    <button onclick="sendMessage()">Preguntar</button>
    <div id="response">Ekoala está listo para ayudarte con consejos ecológicos 🌱</div>
</div>

<button id="chatbot-toggle" onclick="toggleChatbot()">🗨️</button>

<script>
    function toggleChatbot() {
        const chatbot = document.getElementById('chatbot');
        chatbot.style.display = chatbot.style.display === 'block' ? 'none' : 'block';
    }

    async function sendMessage() {
        const input = document.getElementById('userInput').value;
        const responseDiv = document.getElementById('response');

        if (!input) {
            responseDiv.innerHTML = 'Haz tu pregunta a Ekoala 🐨.';
            return;
        }

        responseDiv.innerHTML = '🌱 Pensando ecológicamente...';

        try {
            const response = await fetch('{{ route('ekoala.preguntar') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    mensaje: input
                })
            });

            const data = await response.json();
            const content = data.choices?.[0]?.message?.content || 'Ekoala no ha encontrado respuesta.';
            responseDiv.innerHTML = content.replace(/\n/g, "<br>");
        } catch (error) {
            responseDiv.innerHTML = 'Error ecológico: ' + error.message;
        }
    }
</script>
