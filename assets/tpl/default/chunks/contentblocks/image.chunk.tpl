<figure class="image">
    <img
        srcset[[!resizeImage?
            &input=`[[+crops.Zuschnitt.url:default=`[[+url]]`]]`
            &options=`[[+sizes:default=`2500,1250,625`]]`
        ]]
        alt="[[+alt:jolitypo:htmlent]]"
        [[+noLazyload:isnt=`1`:then=`
            loading="lazy"
        `]]
        class="db [[+classnames:default=`w-100 h-inherit bg-white`]]"
        [[+attributes]]
    />
    [[+title:notempty=`
        <figcaption class="image--caption f1 tr mt3-m o-40">
            [[+title:jolitypo]]
        </figcaption>
    `]]
</figure>