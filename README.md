# habbo-rcon-server
The backend application for habbo-rcon-client

### Setup
1. Download this repo and extract it.
2. Rename `.env.example` to `.env` and change the `HOST` and `PORT`. 

- `HOST` must be the server where your emulator is running.
- `PORT` must be the port used by your emulator for RCON, usually `3001`.

The only thing left is to host it.
Setup your webserver to use the `src` folder as the root directory.
