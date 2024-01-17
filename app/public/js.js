document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('chatForm');
    const messageInput = document.getElementById('messageInput');
    const responseContainer = document.getElementById('responseContainer');
    const sendButton = form.querySelector('button');

    form.onsubmit = function(e) {
        e.preventDefault();
    
        // Disable the button and show loading animation
        sendButton.disabled = true;
        sendButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...';
    
        const data = new FormData();
        const userMessage = messageInput.value;
        data.append('message', userMessage);
    
        fetch('./controllers/ConstructionAiController.php', {
            method: 'POST',
            body: data
        })
        .then(response => {
            const contentType = response.headers.get('content-type');
            
            if (contentType && contentType.includes('application/json')) {
                return response.json();
            } else {
                return response.text();
            }
        })
        .then(data => {
            if (typeof data === 'string') {
                responseContainer.innerHTML = data;
            } else {
                console.log("Raw response:", data);
                if(data.choices && data.choices.length > 0 && data.choices[0].message) {
                    const chatbotResponse = data.choices[0].message.content;
                    
                    const userMessageParagraph = document.createElement('p');
                    userMessageParagraph.textContent = `You: ${userMessage}`;
                    
                    const chatbotResponseParagraph = document.createElement('p');
                    chatbotResponseParagraph.textContent = `Chatbot: ${chatbotResponse}`;
                    
                    responseContainer.appendChild(userMessageParagraph);
                    responseContainer.appendChild(chatbotResponseParagraph);
        
                } else {
                    responseContainer.innerText = 'No valid response from the server.';
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            responseContainer.innerText = 'Error sending message.';
        })
        .finally(() => {
            sendButton.disabled = false;
            sendButton.innerText = 'Send';
        });
    
        messageInput.value = '';
    };
});
