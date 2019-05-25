# docker-hls-sample

## environment
Everywhere only if docker is enabled.

## exec
### create
1. create docker container
```bash
docker-compose up
```

2. POST audio file you'd like to play in streaming
```bash
curl -i -X POST \
   -H "Content-Type:multipart/form-data" \
   -F "audio=@\"{audio_file}\";type={file_type};filename=\"{audio_file_name}\"" \
 'http://front:8080/index.php'
```

### play
1. create docker container
```bash
docker-compose up
```

2. play on browser
check `http://front:8080/index.php?name={audio_file_name}`

3. also, you can fetch stream audio file directly
check `http://storage:8080/{audio_file_name}/playlist.m3u8`
