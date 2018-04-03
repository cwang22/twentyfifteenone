jQuery(document).ready(function() {
    jQuery('pre').each(function(i, block) {
        hljs.highlightBlock(block)
    })

    mediumZoom('.entry-content img', {margin: 30})
})
