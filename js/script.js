jQuery(document).ready(function () {
    jQuery('pre').each(function (i, block) {
        hljs.highlightBlock(block)
    })

    mediumZoom('.entry-content img', {margin: 30})
})

if ('serviceWorker' in navigator){
    window.addEventListener('load', function () {
        navigator.serviceWorker.register('/sw.js')
    }) 
}
