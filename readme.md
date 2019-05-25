# docker-hls-sample
Sample code of create / play audio in streaming using HTTP Live Streaming (HLS) on docker

## environment
Everywhere only if docker is enabled.

## exec
### create
1. create docker container
```bash
docker-compose up
```

2. POST audio file you'd like to play in streaming

**only m4a file is allowed.**

```bash
curl -i -X POST \
   -H "Content-Type:multipart/form-data" \
   -F "audio=@\"{audio_file}\";type=audio/x-m4a;filename=\"{audio_file_name}\"" \
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

## reference
https://qiita.com/mochizukikotaro/items/b398076cb57492980447
https://qiita.com/bossunn24/items/85ca5c3bfbba07b4e0cc
https://qiita.com/okumurakengo/items/5627326ee833a3a5ea03
https://heartbeats.jp/hbblog/2012/04/nginx05.html
https://koni.hateblo.jp/entry/2017/01/28/150522
https://qiita.com/takecian/items/639deeae094466de6546
http://blogs.rastafactory.co.jp/art/2013/01/28/php-%E3%82%A2%E3%83%83%E3%83%97%E3%83%AD%E3%83%BC%E3%83%89%E3%81%AE%E3%83%95%E3%82%A1%E3%82%A4%E3%83%AB%E3%82%B5%E3%82%A4%E3%82%BA%E3%81%AB%E3%81%A4%E3%81%84%E3%81%A6/
https://heartbeats.jp/hbblog/2012/04/nginx04.html
https://gray-code.com/php/get-kind-of-file/
https://www.javadrive.jp/phpappli/keijiban/index3.html
https://qiita.com/Quantum/items/7e6e3e7a3bdf605c306a
https://qiita.com/momoto/items/b34fb9b908ffb26c76a4
https://qiita.com/tukiyo3/items/4162bd793be47d8651a8
https://blog.sioyaki.com/entry/2018/04/20/102344
http://ysklog.net/php/2873.html
http://omega.lid-inc.com/%E3%80%90php%E3%80%91%E3%80%80%E6%8C%87%E5%AE%9A%E3%83%87%E3%82%A3%E3%83%AC%E3%82%AF%E3%83%88%E3%83%AA%E3%83%95%E3%82%A9%E3%83%AB%E3%83%80%E3%82%92%E3%82%B5%E3%83%96%E3%83%87%E3%82%A3%E3%83%AC/

