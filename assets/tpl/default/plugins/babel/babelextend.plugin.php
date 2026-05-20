<?php
$eventName = $modx->event->name;
$babelLanguageLinksTv = $modx->getOption('babel.babelTvName');
$connectedResourcesTv = $resource?->getTVValue($babelLanguageLinksTv);
$ids = [];

foreach (explode(';', $connectedResourcesTv) as $item) {
    list($contextKey, $id) = explode(':', $item);
    $ids[$contextKey] = $id;
}

if (count($ids) < 2) {
    return;
}

switch ($eventName) {
    case 'OnDocFormDelete':
        foreach ($ids as $contextKey => $id) {
            $resource = $modx->getObject('modResource', $id);
            if (!$resource) {
                continue;
            }
            $resource->set('deleted', 1);
            $resource->set('deletedon', time());
            $resource->set('deletedby', $modx->user->get('id'));
            $resource->save();
        }
        break;
    case 'OnResourceUndelete':
        foreach ($ids as $contextKey => $id) {
            $resource = $modx->getObject('modResource', $id);
            if (!$resource) {
                continue;
            }
            $resource->set('deleted', 0);
            $resource->set('deletedon', null);
            $resource->set('deletedby', null);
            $resource->save();
        }
        break;
    case 'OnDocFormPrerender':
        $buttons = [];
        foreach ($ids as $contextKey => $id) {
            $langName = $contextKey == 'web' ? 'de' : $contextKey;
            $classNames = $contextKey == $modx->resource->context_key ? 'is-active' : '';
            $buttons[] = <<<html
                <li>
                    <a
                        href="?a=resource/update&id={$id}"
                        class="x-btn x-btn-text x-btn-noicon {$classNames}"
                    >
                        <span>{$langName}</span>
                    </a>
                </li>
            html;
        }
        $buttonGroup = implode('', $buttons);
        $code = <<<html
            <style>
                .babel_extend_switchbuttons_parent {
                    display: flex !important;
                    gap: 3px;

                    #babel-language-select {
                        opacity: .5;
                        
                        .x-btn-arrow {
                            padding-right: 8px;
                        }

                        button {
                            overflow: hidden;
                            width: 0;
                            padding: 0;
                            border: 0;
                        }
                    }
                }
                .babel_extend_switchbuttons {
                    height: 100%;
                    list-style: none;
                    display: flex !important;
                    flex-direction: row;
                    gap: 1px;

                        li {
                            height: 100%;
                        
                                a {
                                    display: flex !important;
                                    align-items: center;
                                    height: 100%;
                                    text-transform: uppercase;
                                    padding: 0 1em;
                                    border-radius: 0;

                                    &.is-active {
                                        color: white;
                                        background-color: rgba(0, 0, 0, 0.4);
                                    }
                                }

                                &:first-child a {
                                    border-radius: 4px 0 0 4px;
                                }
                                
                                &:last-child a {
                                    border-radius: 0 4px 4px 0;
                                }
                        }
                    }
                }
            </style>
            <div id="babel_extend_switchbuttons"><ul class="babel_extend_switchbuttons">{$buttonGroup}</ul></div>
            <script>
                Ext.onReady(function() {
                    let switchButtons = document.querySelector('#babel_extend_switchbuttons'),
                        toolbar = document.querySelector('#babel-language-select');
                    toolbar.before(switchButtons);
                    toolbar.parentNode.classList.add('babel_extend_switchbuttons_parent');
                });
            </script>
        html;
        $modx->event->output($code);
        break;
}
