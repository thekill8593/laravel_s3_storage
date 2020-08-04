
## Laravel project to upload files to S3

This project shows an example of how to upload, get and delete files in the cloud using Amazon S3, there's also a VUE component to upload the files with Javascript and a progress bar.


## How to run

1. Clone this repository
2. Run docker-compose
3. Install laravel dependencies in app container
4. Install client dependencies in app container
5. Create database in db container (postgres)
6. Create .env file from .env.example and set your environment variables for database and AWS
7. Migrate database
8. Enjoy

Note: Maximum file size to upload is set to 100MB but you can easily change that in the php/local.ini file.