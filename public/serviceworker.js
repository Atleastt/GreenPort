importScripts('https://storage.googleapis.com/workbox-cdn/releases/6.5.4/workbox-sw.js');

var staticCacheName = "pwa-v" + new Date().getTime();
var filesToCache = [
    '/offline',
    '/css/app.css',
    '/js/app.js',
    '/bukti-pendukung',
    '/upload',          
    '/images/icons/icon-72x72.png',
    '/images/icons/icon-96x96.png',
    '/images/icons/icon-128x128.png',
    '/images/icons/icon-144x144.png',
    '/images/icons/icon-152x152.png',
    '/images/icons/icon-192x192.png',
    '/images/icons/icon-384x384.png',
    '/images/icons/icon-512x512.png',
];

// ---------- Workbox Background Sync setup ----------
// Queue untuk menyimpan request upload yang gagal karena offline
const uploadQueue = new workbox.backgroundSync.Queue('uploadQueue', {
    maxRetentionTime: 24 * 60 // menit, simpan maksimal 24 jam
});

// Tangani semua request POST ke endpoint /upload (atau sesuaikan jika berbeda)
workbox.routing.registerRoute(
    ({request, url}) => request.method === 'POST' && url.pathname.startsWith('/upload'),
    new workbox.strategies.NetworkOnly({
        plugins: [uploadQueue]
    }),
    'POST'
);
// ---------------------------------------------------

// Runtime cache CSS, JS, images (agar /build/assets/* tercache setelah pertama kali diakses)
workbox.routing.registerRoute(
    ({request}) => ['style', 'script', 'image'].includes(request.destination),
    new workbox.strategies.StaleWhileRevalidate({
        cacheName: 'assets-cache'
    })
);

// Cache on install
self.addEventListener("install", event => {
    self.skipWaiting();
    event.waitUntil(
        caches.open(staticCacheName).then(async cache => {
            await Promise.all(
                filesToCache.map(async file => {
                    try {
                        await cache.add(file);
                    } catch (err) {
                        console.warn('SW: skip caching', file, err);
                    }
                })
            );
        })
    );
});

// Clear cache on activate
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames
                    .filter(cacheName => (cacheName.startsWith("pwa-")))
                    .filter(cacheName => (cacheName !== staticCacheName))
                    .map(cacheName => caches.delete(cacheName))
            );
        })
    );
});

// Serve from Cache
self.addEventListener("fetch", event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                return response || fetch(event.request);
            })
            .catch(() => {
                return caches.match('offline');
            })
    )
});