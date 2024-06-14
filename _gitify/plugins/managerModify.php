id: 12
source: 2
name: managerModify
category: 9
plugincode: "$scripts = [];\n$resource = $modx->controller->resource;\n$templateSeclectAllowed = '\n    [1, \"Standard\"]\n';\n\nif ($resource) {\n    $templateId = $resource->get(\"template\");\n}\n\nif ($templateId) {\n    # add template id css class\n    $scripts[] =\n        '\n        \twindow.addEventListener(\"load\", function(event) {\n            \tdocument.querySelector(\"body\").classList.add(\"template-id-' .\n        $templateId .\n        '\");\n            });    \t\n        ';\n\n    # show dropdown when creating new resource (thanks https://github.com/bequadrat/modx-template-select)\n    $scripts[] =\n        '\n        MODx.combo.curlytemplates = function (config) {\n            config = config || {};\n            Ext.applyIf(config, {\n                store: new Ext.data.ArrayStore({\n                    id: 0,\n                    fields: [\"templateid\", \"templatename\"],\n                    data: [\n                        ' .\n        $templateSeclectAllowed .\n        '\n                    ],\n                }),\n                mode: \"local\",\n                displayField: \"templatename\",\n                valueField: \"templateid\",\n            });\n            MODx.combo.curlytemplates.superclass.constructor.call(this, config);\n        };\n        Ext.extend(MODx.combo.curlytemplates, MODx.combo.ComboBox);\n        Ext.reg(\"modx-combo-curlytemplates\", MODx.combo.curlytemplates);\n        \n        MODx.addListener(\"beforeLoadPage\", function (url) {\n            if (url.match(/resource\\/create/) && !url.match(/template=/)) {\n                var myId = Ext.id();\n                var templateSelectWindow = new MODx.Window({\n                    resizable: false,\n                    modal: true,\n                    maximizable: false,\n                    autoHeight: true,\n                    allowDrop: false,\n                    collapsible: false,\n                    width: \"400\",\n                    title: \"Template\",\n                    buttons: [\n                        {\n                            text: _(\"ok\"),\n                            cls: \"primary-button\",\n                            scope: this,\n                            handler: function () {\n                                MODx.loadPage(\n                                    url + \"&template=\" + Ext.getCmp(myId).getValue()\n                                );\n                            },\n                        },\n                    ],\n                    items: {\n                        xtype: \"panel\",\n                        layout: \"form\",\n                        id: \"template-select-panel\",\n                        items: {\n                            xtype: \"modx-combo-curlytemplates\",\n                            id: myId,\n                            width: \"100%\",\n                            hideLabel: true,\n                            value: 1,\n                        },\n                    },\n                    listeners: {\n                        success: function () {},\n                    },\n                });\n                templateSelectWindow.show();\n                return false;\n            }\n        });\n        \n        document.addEventListener(\"DOMContentLoaded\", function () {\n            let link = document.querySelector(\"#new_resource a\");\n            link.addEventListener(\"click\", function (e) {\n                e.preventDefault();\n                //MODx.loadPage(this.getAttribute(\"href\"));\n            });\n        });\n    ';\n}\n\n$script = \"<script>\" . implode(\"\", $scripts) . \"</script>\";\n\nif (!$modx->user->isMember(\"Administrator\")) {\n    $modx->regClientCSS(\n        MODX_BASE_URL .\n            $modx->getOption(\"tplPath\") .\n            \"frontend/styleguide/css/modx.css\"\n    );\n    $modx->regClientStartupHTMLBlock($script);\n}"
properties: 'a:0:{}'
static: 1
static_file: /plugins/layout/managermodify.plugin.php

-----


$scripts = [];
$resource = $modx->controller->resource;
$templateSeclectAllowed = '
    [1, "Standard"]
';

if ($resource) {
    $templateId = $resource->get("template");
}

if ($templateId) {
    # add template id css class
    $scripts[] =
        '
        	window.addEventListener("load", function(event) {
            	document.querySelector("body").classList.add("template-id-' .
        $templateId .
        '");
            });    	
        ';

    # show dropdown when creating new resource (thanks https://github.com/bequadrat/modx-template-select)
    $scripts[] =
        '
        MODx.combo.curlytemplates = function (config) {
            config = config || {};
            Ext.applyIf(config, {
                store: new Ext.data.ArrayStore({
                    id: 0,
                    fields: ["templateid", "templatename"],
                    data: [
                        ' .
        $templateSeclectAllowed .
        '
                    ],
                }),
                mode: "local",
                displayField: "templatename",
                valueField: "templateid",
            });
            MODx.combo.curlytemplates.superclass.constructor.call(this, config);
        };
        Ext.extend(MODx.combo.curlytemplates, MODx.combo.ComboBox);
        Ext.reg("modx-combo-curlytemplates", MODx.combo.curlytemplates);
        
        MODx.addListener("beforeLoadPage", function (url) {
            if (url.match(/resource\/create/) && !url.match(/template=/)) {
                var myId = Ext.id();
                var templateSelectWindow = new MODx.Window({
                    resizable: false,
                    modal: true,
                    maximizable: false,
                    autoHeight: true,
                    allowDrop: false,
                    collapsible: false,
                    width: "400",
                    title: "Template",
                    buttons: [
                        {
                            text: _("ok"),
                            cls: "primary-button",
                            scope: this,
                            handler: function () {
                                MODx.loadPage(
                                    url + "&template=" + Ext.getCmp(myId).getValue()
                                );
                            },
                        },
                    ],
                    items: {
                        xtype: "panel",
                        layout: "form",
                        id: "template-select-panel",
                        items: {
                            xtype: "modx-combo-curlytemplates",
                            id: myId,
                            width: "100%",
                            hideLabel: true,
                            value: 1,
                        },
                    },
                    listeners: {
                        success: function () {},
                    },
                });
                templateSelectWindow.show();
                return false;
            }
        });
        
        document.addEventListener("DOMContentLoaded", function () {
            let link = document.querySelector("#new_resource a");
            link.addEventListener("click", function (e) {
                e.preventDefault();
                //MODx.loadPage(this.getAttribute("href"));
            });
        });
    ';
}

$script = "<script>" . implode("", $scripts) . "</script>";

if (!$modx->user->isMember("Administrator")) {
    $modx->regClientCSS(
        MODX_BASE_URL .
            $modx->getOption("tplPath") .
            "frontend/styleguide/css/modx.css"
    );
    $modx->regClientStartupHTMLBlock($script);
}