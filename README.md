# PHP Chatbot Project Using ChatGPT API

## Overview
Developed by Petros Siomyan, this innovative PHP project integrates with the ChatGPT API, offering real-time user interaction and leveraging the advanced capabilities of ChatGPT.

## Key Features

### ChatGPT API Integration
- Integration with ChatGPT API.
- Real-time processing of user queries.
- Displaying responses in a user-friendly chat interface.

### Database Integration
- Persistent storage of interactions for future reference.
- Enhanced data analysis capabilities.

### Query Counting
- Monitoring the number of processed queries.
- Useful for API usage management and data analysis.

## Technical Setup

### Docker Containerization
- Ensures consistency across different environments.

#### Included Components
- NGINX Webserver for handling web requests.
- PHP FastCGI Process Manager with PDO MySQL support for efficient processing and database interaction.
- MariaDB, a GPL MySQL fork, for database storage.
- PHPMyAdmin for database management via a web interface.

## Installation

### Requirements
- Docker Desktop for Windows or Mac, or Docker Engine for Linux.

### Steps
- Clone the project repository.

## Usage

### Starting the Server
- Instructions to run `docker compose up`.
- Accessing the chatbot at localhost.
- Accessing PHPMyAdmin at localhost:8080.

### Stopping the Server
- How to stop the server using Ctrl+C or `docker compose down`.

## Future Enhancements

### Enhanced Database Functionality
- For in-depth analytics of user queries.

### Improved User Interface
- Aimed at a more engaging user experience.

## Author
- Petros Siomyan
