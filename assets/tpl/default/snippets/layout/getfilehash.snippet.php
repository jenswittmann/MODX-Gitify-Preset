<?php
if (file_exists(MODX_BASE_PATH.$f)) {
    return substr(hash_file('md5', $f), 0, 3);
}