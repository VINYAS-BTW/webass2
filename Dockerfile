# Use an official PHP runtime as base image
FROM php:8.2-apache

# Copy your project files into the container
COPY . /var/www/html/

# Expose the port Render expects
EXPOSE 10000

# Start the built-in PHP development server
CMD ["php", "-S", "0.0.0.0:10000", "-t", "/var/www/html"]
