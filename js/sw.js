importScripts('https://storage.googleapis.com/workbox-cdn/releases/3.4.1/workbox-sw.js')
workbox.routing.registerRoute(/(zh|en)\/.*/, workbox.strategies.staleWhileRevalidate())