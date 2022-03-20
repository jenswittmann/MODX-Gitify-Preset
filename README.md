# MODX Gitify Preset

https://user-images.githubusercontent.com/5232770/108606863-14ce2700-73bd-11eb-9289-dbb587677703.mp4

1. add files and folder to your MODX public root
2. create a .modmore.com.key file and add your personal credentials:

```
username: jens_clientname
api_key: modmoreapikey123
```

3. install [MODX](https://modx.com): `Gitify install:modx` <sup>1</sup>
4. install MODX Extras `Gitify package:install --all` (use `--interactive` if you customize .gitify file)
5. login into manager and update all extras (not possible via Gitify now, important to get latest i.e. ContentBlocks)
6. install preset `Gitify build` <sup>2</sup>
    
Gitify Documentation: https://docs.modmore.com/en/Open_Source/Gitify/index.html

-----

1) be sure that you don't have spaces in the full path to the MODX Installation root, for example `/MAMP/My Project/MODX/ > /MAMP/My-Project/MODX/`  
2) if you don't want use `default` for your template foldername, take a search'n replace inside the gitify/ folder `tpl/default > tpl/my-template-name`
