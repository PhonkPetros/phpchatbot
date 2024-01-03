document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('chatForm');
    const messageInput = document.getElementById('messageInput');
    const responseContainer = document.getElementById('responseContainer');

    form.onsubmit = function(e) {
        e.preventDefault();  // Prevent the default form submission

        // Gather the data to send
        const data = new FormData();
        const userMessage = messageInput.value;
        data.append('message', userMessage);

        fetch('ConstructionAiController.php', {
            method: 'POST',
            body: data
        })
        .then(response => response.json())
        .then(data => {
            console.log("Raw response:", data);
            if(data.choices && data.choices.length > 0 && data.choices[0].message) {
                // Extract the content from the first choice's message
                const chatbotResponse = data.choices[0].message.content;
                
                // Create a new paragraph element for the user message
                const userMessageParagraph = document.createElement('p');
                userMessageParagraph.textContent = `You: ${userMessage}`;
                
                // Create a new paragraph element for the chatbot response
                const chatbotResponseParagraph = document.createElement('p');
                chatbotResponseParagraph.textContent = `Chatbot: ${chatbotResponse}`;
                
                // Append both paragraphs to the responseContainer
                responseContainer.appendChild(userMessageParagraph);
                responseContainer.appendChild(chatbotResponseParagraph);
            } else {
                responseContainer.innerText = 'No valid response from the server.';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            responseContainer.innerText = 'Error sending message.';
        });

        // Clear the input field after sending the message
        messageInput.value = '';
    };
});
