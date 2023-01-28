# SIMPLE MAIL SERVICE

## API Service for Sending Emails

- The API would have an endpoint for sending emails, which would take in parameters such as the recipient's email address, subject, and message.

- When a request to send an email is made to this endpoint, the API would add the email details to a RabbitMQ queue.

- A separate worker process, connected to the same RabbitMQ queue, would then pick up the email details and send the email using an SMTP library.

- After sending the email, the worker process would then add the email details (such as recipient, subject, message, sent timestamp) to a PostgreSQL database for storage and future reference.

- The API could also have endpoints for querying and retrieving the stored emails from the PostgreSQL database.

## Tech Use
Here is a brief description of the technologies used:

- **Docker**: Docker is a platform that allows developers to easily package, deploy, and run applications in containers. This makes it easy to run the application in a variety of environments and ensures consistency across different systems.

- **Docker Compose**: Docker Compose is a tool for defining and running multi-container Docker applications. It allows you to define a set of services that make up your application in a single `docker-compose.yml` file, and then start and stop all the services with a single command.

- **Mailhog**: Mailhog is an email testing tool that captures all email sent to it, instead of delivering the email to real recipients. It allows you to test your application's email functionality without actually sending email to real users.

- **RabbitMQ**: RabbitMQ is a message broker that allows you to send and receive messages between different parts of your application. It is used to handle the sending of emails asynchronously, so that the API service can continue processing other requests while the emails are being sent.

- **Supervisor**: Supervisor is a process control system that allows you to automatically start and stop processes, and to automatically restart processes that have crashed. It can be used to ensure that the services required by the API service are always running.


## List of apps library
- PHP Mailer Library (https://github.com/PHPMailer/PHPMailer) for sending emails
- PHP-JWT (https://github.com/firebase/php-jwt) for handling JSON Web Tokens
- PHP-AMQPLIB (https://github.com/php-amqplib/php-amqplib) for connecting and interacting with RabbitMQ

## How to install

1. Make sure you have installed Docker and Docker Compose on your machine.

2. Clone the API service code from Github using the following command:

```
git clone https://github.com/rohmanie55/6b2ded51d81a4403d8a4bd25fa1e57ee mail-apps
```

3. Navigate to the directory containing the cloned code.

4. Copy .env.example to new file .env

5. Fill .env with your prefered configuration like jwt secret etc

6. In the terminal or command prompt, navigate to the directory containing the code and `docker-compose.yml` file.

 Run the following command to build the images and start the services:

```
docker-compose up --build
```
This command will start the API services. The API service will be available on port 80 of your local machine.

7. To stop the services, press `CTRL + C` in the terminal or command prompt.

## How to use

1. First, you need to make an authentication token by sending a POST request with a JSON body containing a `client_id` and `password` to the endpoint URL `localhost/api/token`.

```bash
curl -X POST -H "Content-Type: application/json" -d '{"client_id":"YOUR_CLIENT_ID", "password":"YOUR_PASSWORD"}' http://localhost/api/token
```

2. The server will respond with a JSON object containing the token fields. Save the token for future requests.

3. To send an email, you will need to make a POST request with a JSON body containing the from, to, subject, and body fields to the endpoint URL localhost/api/mail. You will also need to include the token in the Authorization header of the request.

```bash
curl -X POST -H "Content-Type: application/json" -H "Authorization: Bearer YOUR_ACCESS_TOKEN" -d '{"to":"recipient@example.com", "from":"sender@example.com", "subject":"Your Subject", "body":"Your email body"}' http://localhost/api/mail
```
4. The server will respond with a JSON object containing the message and status fields. If the status is success, the email has been added to the RabbitMQ queue and will be sent as soon as possible.

5. To check the status of an email you can open mailhog web service by open this [url](http://localhost:8025) to your browser

6. also you can check by make GET request to URL localhost/api/mail with token in the Authorization header of the request.
