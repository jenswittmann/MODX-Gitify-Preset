# <img src="https://github.com/user-attachments/assets/110ca05d-7b1c-4117-addc-4fe6db51a302" width="25" alt="MODX Logo" /> MODX Gitify Preset

Install a fresh [MODX3 CMF](https://modx.com) with everything you need to start a new project.

It's a good place to start using [CurlyFramework](https://jenswittmann.github.io/CurlyFramework/) and its [modx.css](https://github.com/jenswittmann/CurlyFramework/blob/6.0.0/dev/css/modx.scss) for a clean [ContentBlocks](https://modmore.com/contentblocks/) interface.

## Features

✅ MODX3 ready  
✅ Best practice system settings  
✅ Fenom parser ready  
✅ Large [.gitify](https://github.com/modmore/Gitify/) for extracting objects  
✅ ContentBlocks basic fields and layout  
✅ ContentBlocks simple manager layout style  
✅ ResizeImage snippet for WebP and srcset support  
✅ Simple form customisation for editor role  
✅ Snippet for SVG embedding  
✅ Snippet for formatting links in Richtext  

**Full Changelog**: https://github.com/jenswittmann/MODX-Gitify-Preset/commits/1.0.0

## Installation

Follow these steps to install the latest MODX3 and install basic [MODX Extras](https://extras.modx.com) via CLI. Setup the features above via Gitify.
Here is a little Screencast: https://youtu.be/UEpvBnX4S-U

1. Add files to your MODX public root:
```
git clone git@github.com:jenswittmann/MODX-Gitify-Preset.git ./site
```
2. Add add your personal modmore credentials to [site/.modmore.com.key](https://github.com/jenswittmann/MODX-Gitify-Preset/blob/main/.modmore.com.key)
3. Install everything in one step <sup>1</sup>:
```
cd site/; gitify modx:install; gitify package:install --all; gitify build
``` 
Bonus: Add CurlyFramework 🧁
```
cd assets/tpl/default/; git clone git@github.com:jenswittmann/CurlyFramework.git ./CurlyFramework
```

<sup>1</sup> Be sure that you don't have spaces in the full path to the MODX root, for example `/MAMP/My Project/MODX/ > /MAMP/My-Project/MODX/`. If you don't want use `default` for your template foldername, take a search'n replace inside the `_gitify/` folder with `tpl/default > tpl/my-template-name` and rename the folder `assets/tpl/default`. When search'n replace inside the MediaSource, be careful to replace the string length also `… ;s:19:"assets/tpl/default/" … > … ;s:28:"assets/tpl/my-template-name/" …`.

## Third party documentation

- [MODX](https://docs.modx.com/)
- [Gitify](https://docs.modmore.com/en/Open_Source/Gitify/)
- [ContentBlocks](https://docs.modmore.com/en/ContentBlocks/v1.x/)
- [CurlyFramework](https://jenswittmann.github.io/CurlyFramework/)
