# PHP Project with Docker

This is a PHP project set up with Docker and MySQL. The application is configured to run using Docker Compose. Below are the steps for setting up and running the project.

## Requirements

- **Docker**: Ensure Docker is installed on your system. You can download and install Docker from the official website: [Docker Install](https://www.docker.com/get-started).
- **Docker Compose**: Docker Compose is used to run multi-container Docker applications. It should be installed along with Docker, but if not, follow the installation instructions here: [Install Docker Compose](https://docs.docker.com/compose/install/).

## Getting Started

### 1. Clone the Repository

Start by cloning the repository to your local machine:

```bash
git clone https://github.com/your-username/php-project.git
cd php-project
```

### 2. Configure Environment Variables
Ensure that your environment is set up correctly. You may need to adjust the .env or any configuration files if required. The docker-compose.yml file and config.php should be ready to use.

### 3. Build and Run the Containers
Use the following command to build the Docker images and start the application:

```bash
docker-compose up --build
```

This will:

Build the PHP and MySQL containers.
Start both the PHP app and MySQL container using Docker Compose.
Map MySQL to port 3337 and make your app available on localhost:9000.

### 4. Access the Application
After the containers are up and running, open your browser and go to:

```bash
http://localhost:9000
```
This will load the PHP application in your web browser.

### 5. Interacting with MySQL
You can interact with the MySQL database by connecting to it through the Docker container. Use the following command to access the MySQL container:

```bash
docker exec -it kamal_mysql mysql -u kamal -p
```
When prompted, enter the password salam.

## Stopping the Containers
To stop the running containers, use the following command:

```bash
docker-compose down
```
