# NOTE:
This is currently in the works and is an incomplete solution, only Task-1 of 2 has been committed. Check the branches for progress!

# Cartoon-PHP-Test
This is a test application for the Cartoon Cloud developer assesment test.
Please check out the [REQUIREMENTS](./REQUIREMENTS.md) file for the full test details.

## Requirements
* Install [Docker/Docker Desktop ](https://www.docker.com/products/docker-desktop)
* Install [VSCode](https://code.visualstudio.com/)
* Install the [Remote Container Plugin](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-containers)
* Re-open this code in Remote Container or press ``CTRL+SHIFT+P`` then search and select ``Remote Containers: Open Folder in Container``

## Running
1. Open VSCode terminal window (CTRL+SHIFT+`) 
2. Run bash script as ``sh start.sh``
3. Open the browser when prompted
4. Press CTRL + C to stop

## Manual Start using laravel artisan
1. Open VSCode terminal window (CTRL+SHIFT+`) 
2. cd ./test-app
3. composer update
4. php artisan db:create
5. php artisan migrate
6. php artisan db:seed --class=UserSeeder
7. php artisan serve

## Testing
You may use curl to test the API.

### GET /api/check
To check for authentication and connection

```curl -u demo:pwd1234 -i -H 'Accept:application/json' http://localhost:8000/api/check```

