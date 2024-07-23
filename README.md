# MODX Gitify Preset

Follow these steps to install the latest [MODX3 CMF](https://modx.com) and basic [MODX Extras](https://extras.modx.com) via CLI. Then you can set some basic settings to start developing: Best Practive System Settings, cleaner Form Customisation, some useful Snippets, some ContentBlocks Fields and a basic User Role for Editors. Have a look at the [_gitify/](https://github.com/jenswittmann/MODX-Gitify-Preset/tree/main/_gitify) folder.

## Installation

Here is a little Screencast: https://youtu.be/UEpvBnX4S-U

1. Add files to your MODX public root: `git clone git@github.com:jenswittmann/MODX-Gitify-Preset.git`
2. Create a [.modmore.com.key](https://github.com/jenswittmann/MODX-Gitify-Preset/blob/main/.modmore.com.key) file and add your personal credentials.
3. Install MODX: `gitify modx:install` <sup>1</sup>
4. Install MODX Extras: `gitify package:install --all` or `gitify package:install --interactive`
5. Install Preset: `gitify build` <sup>2</sup>

<sup>1</sup> Be sure that you don't have spaces in the full path to the MODX root, for example `/MAMP/My Project/MODX/ > /MAMP/My-Project/MODX/`.  
<sup>2</sup> If you don't want use `default` for your template foldername, take a search'n replace inside the `_gitify/` folder with `tpl/default > tpl/my-template-name` and rename the folder `assets/tpl/default`. When search'n replace inside the MediaSource, be careful to replace the string length also `… ;s:19:"assets/tpl/default/" … > … ;s:28:"assets/tpl/my-template-name/" …`.

## Third party documentation

- [MODX](https://docs.modx.com/)
- [Gitify](https://docs.modmore.com/en/Open_Source/Gitify/)
- [ContentBlocks](https://docs.modmore.com/en/ContentBlocks/v1.x/)
- [CurlyFramework](https://jenswittmann.github.io/CurlyFramework/)
