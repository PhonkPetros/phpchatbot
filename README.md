PHP Chatbot Project Using ChatGPT API
Overview
Developed by Petros Siomyan, this PHP project presents an innovative chatbot that interfaces with the ChatGPT API. It demonstrates a unique application of real-time user interaction, harnessing the advanced capabilities of ChatGPT.

Key Features
ChatGPT API Integration: Central to the project is its seamless integration with the ChatGPT API. The chatbot, powered by PHP, sends user queries in JSON format to the ChatGPT API and displays the decoded responses in a user-friendly chatbox.
Database Integration: All interactions are stored in a database, enabling future reference and analysis.
Query Counting: Tracks the number of queries processed, useful for data analysis and managing API usage.
Technical Setup
The application is containerized with Docker, ensuring streamlined setup and consistency across environments. The Docker setup includes:

NGINX Webserver: For handling web requests.
PHP FastCGI Process Manager with PDO MySQL Support: Efficient PHP processing and database interactions.
MariaDB: A GPL MySQL fork for database storage.
PHPMyAdmin: Web interface for database management.
Installation
Install Docker Desktop on Windows or Mac, or Docker Engine on Linux.
Clone the project repository.
Usage
Starting the Server: Run docker compose up in the terminal within the project folder to start NGINX. The chatbot is accessible at localhost, and PHPMyAdmin at localhost:8080.
Stopping the Server: Use Ctrl+C or execute docker compose down in the terminal to stop the containers.
Future Enhancements
Enhanced database functionality for in-depth user query analytics.
Improved user interface for a more engaging chat experience.
Author Petros Simonyan