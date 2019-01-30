<?php get_header(); ?>
<section id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <header class="page-header">
            <div id="algolia-search-box"></div>
        </header>

        <div id="algolia-hits"></div>
        <nav id="algolia-pagination" class="navigation pagination"></nav>
    </main>
</section>


<script type="text/html" id="tmpl-instantsearch-hit">
        <# if ( data.images.thumbnail ) { #>
        <div class="post-thumbnail">
            <img src="{{ data.images.thumbnail.url }}" alt="{{ data.post_title }}" title="{{ data.post_title }}"
                 itemprop="image"/>
        </div>
        <# } #>

        <header class="entry-header">
            <h2 class="entry-title">
                <a href="{{ data.permalink }}">
                    {{{ data._highlightResult.post_title.value }}}
                </a>
            </h2>
        </header>
        <div class="entry-summary">
            <p>
                <# if ( data._snippetResult['content'] ) { #>
                <span class="suggestion-post-content">{{{ data._snippetResult['content'].value }}}</span>
                <# } #>
            </p>
        </div>
</script>


<script type="text/javascript">
    jQuery(function () {
        if (jQuery('#algolia-search-box').length > 0) {

            if (algolia.indices.searchable_posts === undefined && jQuery('.admin-bar').length > 0) {
                alert('It looks like you haven\'t indexed the searchable posts index. Please head to the Indexing page of the Algolia Search plugin and index it.')
            }

            /* Instantiate instantsearch.js */
            var search = instantsearch({
                appId: algolia.application_id,
                apiKey: algolia.search_api_key,
                indexName: algolia.indices.searchable_posts.name,
                urlSync: {
                    mapping: {'q': 's'},
                    trackedParameters: ['query']
                },
                searchParameters: {
                    facetingAfterDistinct: true,
                    highlightPreTag: '__ais-highlight__',
                    highlightPostTag: '__/ais-highlight__'
                }
            })

            /* Search box widget */
            search.addWidget(
                instantsearch.widgets.searchBox({
                    container: '#algolia-search-box',
                    placeholder: 'Search for...',
                    wrapInput: false,
                    poweredBy: algolia.powered_by_enabled
                })
            )

            /* Hits widget */
            search.addWidget(
                instantsearch.widgets.hits({
                    container: '#algolia-hits',
                    hitsPerPage: 10,
                    templates: {
                        empty: 'Sorry, but nothing matched "<strong>{{query}}</strong>". Please try again with some different keywords.',
                        item: wp.template('instantsearch-hit')
                    },
                    cssClasses: {
                        empty: 'page-content',
                        item: 'hentry'
                    },
                    transformData: {
                        item: function (hit) {
                            for (key in hit._highlightResult) {
                                // We do not deal with arrays.
                                if (!hit._highlightResult.hasOwnProperty(key) || typeof hit._highlightResult[key].value !== 'string') {
                                    continue
                                }
                                hit._highlightResult[key].value = _.escape(hit._highlightResult[key].value)
                                hit._highlightResult[key].value = hit._highlightResult[key].value.replace(/__ais-highlight__/g, '<em>').replace(/__\/ais-highlight__/g, '</em>')
                            }

                            for (key in hit._snippetResult) {
                                // We do not deal with arrays.
                                if (!hit._snippetResult.hasOwnProperty(key) || typeof hit._snippetResult[key].value !== 'string') {
                                    continue
                                }

                                hit._snippetResult[key].value = _.escape(hit._snippetResult[key].value)
                                hit._snippetResult[key].value = hit._snippetResult[key].value.replace(/__ais-highlight__/g, '<em>').replace(/__\/ais-highlight__/g, '</em>')
                            }

                            return hit
                        }
                    }
                })
            )

            /* Pagination widget */
            search.addWidget(
                instantsearch.widgets.pagination({
                    container: '#algolia-pagination',
                    showFirstLast: false,
                    cssClasses: {
                        root: 'nav-links',
                        item: 'page-numbers',
                        active: 'current'
                    }
                })
            )

            /* Start */
            search.start()

            jQuery('#algolia-search-box input').attr('type', 'search').select()
        }
    })
</script>

<?php get_footer(); ?>
