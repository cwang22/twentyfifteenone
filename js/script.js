jQuery(document).ready(function () {
    jQuery('pre').each(function (i, block) {
        hljs.highlightBlock(block)
    })

    mediumZoom('.entry-content img', {margin: 30})
})

if ('serviceWorker' in navigator && !jQuery('body').hasClass('logged-in')) {
    jQuery(document).load(function () {
        navigator.serviceWorker.register('/sw.js')
    })
}