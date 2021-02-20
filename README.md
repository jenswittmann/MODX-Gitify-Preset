# MODX Gitify Preset

1. add files and folder to your MODX public root
2. create a .modmore.com.key file and add your personal credentials:

```
username: jens_clientname
api_key: modmoreapikey123
```

3. install [MODX](https://modx.com): `Gitify install:modx`
4. install MODX Extras `Gitify package:install --all` (use `--interactive` if you customize .gitify file)
5. login into manager and update all extras (not possible via Gitify now, important to get latest i.e. ContentBlocks)
6. install preset `Gitify build`

Gitify Documentation: https://docs.modmore.com/en/Open_Source/Gitify/index.html
