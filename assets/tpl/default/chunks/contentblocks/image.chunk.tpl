<figure class="image">
    <img
        srcset[[!resizeImage?
            &input=`[[+crops.Zuschnitt.url:default=`[[+url]]`]]`
            &options=`[[+sizes:default=`2500,1250,625`]]`
        ]]
        alt="{$alt | jolitypo | htmlent}"
        {if !$noLazyload}
            loading="lazy"
        {/if}
        class="db {$classnames ?: 'w-100 h-inherit bg-white'}"
        {$attributes}
    />
    {if $title}
        <figcaption class="image--caption f1 tc mt3-m">
            {$title | jolitypo}
        </figcaption>
    {/if}
</figure>
