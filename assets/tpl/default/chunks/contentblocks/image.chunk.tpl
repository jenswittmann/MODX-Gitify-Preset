<figure class="ma0 mb3">
    <picture>
        <source data-srcset="[[toWebp? &input=`[[+url:pthumb=`&w=1000`]]` &options=`75`]]" type="image/webp">
        <img data-src="[[+url:pthumb=`&w=1000`]]" width="[[+width]]" height="[[+height]]" alt="[[+alt:jolitypo:htmlent]]" class="lazyload db w-100 w-[[+imgSize:default=`100`]]-ns h-inherit [[+classnames]]">
    </picture>
    [[+title:notempty=`
        <figcaption class="fs-5 mt2 mb3">
            [[+caption:jolitypo]]
        </figcaption>
    `]]
</figure>