# NOTE:


This is currently is a work in progress.


# Cartoon-PHP-Test

This is a test application for the Cartoon Cloud developer assesment test.
Please check out the [REQUIREMENTS](./REQUIREMENTS.md) file for the full test details.


## Requirements

This project on [devcontainers]{https://code.visualstudio.com/docs/remote/containers} which allows replication of development environments, the following are requirements for running in Windows 10 environment.

* Install [Docker/Docker Desktop ](https://www.docker.com/products/docker-desktop)
* Install [VSCode](https://code.visualstudio.com/)
* Install the [Remote Container Plugin](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-containers)
* Re-open this code in Remote Container or press ``CTRL+SHIFT+P`` then search and select ``Remote Containers: Open Folder in Container``

Note: If you are using WLS2 see https://docs.docker.com/desktop/windows/wsl/


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

To check output of test code
```curl -u demo:pwd1234 -i -H 'Accept:application/json' http://localhost:8000/api/test```