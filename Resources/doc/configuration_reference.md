IBMediaProxyBundle Configuration Reference
==========================================

All available configuration options are listed below with their default values.

``` yaml
# app/config/config.yml
ib_media_proxy:
    algorithm: sha1 # hashing algorithm to use [optional - default=sha1]
    secret: ThisTokenIsNotSecretChangeIt # secret for hashing - please set a value here!
    ignore_https: true # flag if https domains shall be ignored [optional - default=false]
    prefix_path: https://my.cdn # path which is generated before local pathes [optional]
```