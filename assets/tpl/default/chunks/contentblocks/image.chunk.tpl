{var $url = $crops.Zuschnitt.url ?: $url}

{if $url}
    <figure class="image">
        <img
            srcset[[!resizeImage?
                &input=`{$url}`
                &options=`{$sizes ?: '2500,1250,625'}`
            ]]
            alt="{$alt | jolitypo | htmlent}"
            {if !$noLazyload}
                loading="lazy"
            {/if}
            class="db {$classnames ?: 'w-100 h-inherit bg-white'}"
            {$attributes}
        />
        {if $title}
            <figcaption class="image--caption f1 mt3-m">
                {$title | jolitypo}
            </figcaption>
        {/if}
    </figure>
{/if}
