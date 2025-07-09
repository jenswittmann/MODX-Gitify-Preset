<!DOCTYPE html>
<html lang="{$_modx->config.cultureKey}" class="scale-content smooth-scroll">
    <head>
        <base href="/" />
        <link
            rel="preload"
            href="{$_modx->config.tplPath}frontend/styleguide/css/font/yellix-medium.woff2"
            as="font"
        />
        <link rel="stylesheet" href="{$_modx->config.tplPath}frontend/styleguide/css/style.css?v={'getFileHash' | snippet : [ 'f' => $_modx->config.tplPath ~ 'frontend/styleguide/css/style.css' ]}">
        <meta charset="utf-8" />
        <title>{$_modx->resource.pagetitle | jolitypo} — {$_modx->config.site_name | jolitypo}</title>
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, viewport-fit=cover"
        />
        <link rel="icon" type="image/svg+xml" href="{$_modx->config.tplPath}frontend/favicon.svg" />
        <meta
            name="description"
            content="{$_modx->resource.description | jolitypo | htmlent}"
        />
        {var $resourcePropertiesCb = $_modx->resource.properties.contentblocks.linear}
        {var $previewimage = $resourcePropertiesCb.0.crops.Zuschnitt.url ?: $resourcePropertiesCb.0.url}
        {if $previewimage}
            <meta
                property="og:image"
                content="{$previewimage}"
            />
        {/if}
        {if $_modx->hasSessionContext('mgr')}
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/ryersondmp/sa11y@3.2.3/dist/css/sa11y.min.css"/>
            <script src="https://cdn.jsdelivr.net/combine/gh/ryersondmp/sa11y@3.2.3/dist/js/lang/de.umd.js,gh/ryersondmp/sa11y@3.2.3/dist/js/sa11y.umd.min.js"></script>
            <script>
                Sa11y.Lang.addI18n(Sa11yLangDe.strings);
                const sa11y = new Sa11y.Sa11y({
                    checkRoot: "body"
                });
            </script>
        {/if}
    </head>
    <body
        x-data="{
            navOpen: false
        }"
        @keyup.document="(e) => {
            if (e.which === 9) {
                document.documentElement.classList.add('focus-outline');
            }
        }"
        class="curlyframework reset-spacing"
    >
        
        <header class="head">
            
            {'!pdoMenu' | snippet : [
                'startId' => 0,
                'level' => 1,
                'tplOuter' => '@INLINE [[+wrapper]]',
                'tpl' => '@INLINE
                    <li class="[[+classnames]]">
                        <a href="[[+link]]" [[+attributes]]>[[+menutitle]]</a>
                    </li>'
            ]}
            
        </header>
