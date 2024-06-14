# MODX Gitify Preset

## Steps

1. Add files and folder to your MODX public root.
2. Create a [.modmore.com.key](https://github.com/jenswittmann/MODX-Gitify-Preset/blob/main/.modmore.com.key) file and add your personal credentials.
3. Install [MODX](https://modx.com): `gitify modx:install` <sup>1</sup>
4. install MODX Extras: `gitify package:install --all` or `gitify package:install --interactive`
5. Unstall Preset: `gitify build` <sup>2</sup>

<sup>1</sup> Be sure that you don't have spaces in the full path to the MODX root, for example `/MAMP/My Project/MODX/ > /MAMP/My-Project/MODX/`.  
<sup>2</sup> If you don't want use `default` for your template foldername, take a search'n replace inside the `_gitify/` folder with `tpl/default > tpl/my-template-name` and rename the folder `assets/tpl/default`. When search'n replace inside the MediaSource, be careful to replace the string length also `… ;s:19:"assets/tpl/default/" … > … ;s:28:"assets/tpl/my-template-name/" …`.

## Links

Gitify Documentation: https://docs.modmore.com/en/Open_Source/Gitify/index.html

## Screencast

https://user-images.githubusercontent.com/5232770/108606863-14ce2700-73bd-11eb-9289-dbb587677703.mp4
