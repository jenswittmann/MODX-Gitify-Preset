id: 21
source: 2
name: getFileHash
category: 9
properties: 'a:0:{}'
static: 1
static_file: snippets/layout/getfilehash.snippet.php

-----


if (file_exists(MODX_BASE_PATH.$f)) {
    return substr(hash_file('md5', $f), 0, 3);
}