jQuery(document).ready(function ($) {
    $('pre').each(function (i, block) {
        hljs.highlightBlock(block)
    })

    $('.spoiler .title').click(function () {
        $(this).next().slideToggle()
    })

    mediumZoom('.entry-content img', {margin: 30})
})

if ('serviceWorker' in navigator) {
    window.addEventListener('load', function () {
        navigator.serviceWorker.register('/sw.js')
    })
}
