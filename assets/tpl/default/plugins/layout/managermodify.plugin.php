<?php
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