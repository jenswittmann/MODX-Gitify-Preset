<figure class="image">
    <img
        data-srcset[[!resizeImage?
            &input=`{$url}`
            &options=`{$sizes ?: '2500,1250,625'}` ]]
        alt="{$alt | jolitypo | htmlent}"
        class="lazyload db {$classnames ?: 'w-100 h-inherit'}"
        {if $attributes}
            {$attributes}
        {/if}
    />
    {if $title}
        <figcaption class="image--caption">
            {$title | jolitypo}
        </figcaption>
    {/if}
</figure>