const CACHE_NAME = 'vmehca-v1';
const urlsToCache = [
  './',
  './index.html',
  './css/style.css',
  './css/premium.css',
  './manifest.json',
  './img/ic.png',
  './img/tabicon.png',
  './img/Medical.png',
  './img/chatbo.jpg'
];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => {
        console.log('Opened cache');
        // Use addAll, but gracefully handle missing files
        return Promise.all(urlsToCache.map(url => {
          return fetch(url).then(response => {
            if (!response.ok) {
              throw new Error('Failed to fetch ' + url);
            }
            return cache.put(url, response);
          }).catch(error => {
            console.error('Failed to cache ' + url + ':', error);
          });
        }));
      })
  );
});

self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request)
      .then(response => {
        // Cache hit - return response
        if (response) {
          return response;
        }
        return fetch(event.request);
      })
  );
});

self.addEventListener('activate', event => {
  const cacheWhitelist = ['vmehca-v1'];
  event.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames.map(cacheName => {
          if (cacheWhitelist.indexOf(cacheName) === -1) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
});
