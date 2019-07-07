self.addEventListener('fetch', function(event) {
    event.respondWith(
        new Response('プッシュ通知は有効になっています')
    );
});

self.addEventListener('push', function(event) {
    console.log('Received a push message', event);
    var title = "更新情報です！！";
    var body = "新しい機能更新がありました！！";

    event.waitUntil(
        self.registration.showNotification(title, {
            body: body,
            icon: 'http://www.cse.ce.nihon-u.ac.jp/~u306065/IMG/mellicon.jpg',
            tag: 'push-notification-tag'
        })
    );
});
self.addEventListener('notificationclick', function(event) {
    event.notification.close();
    clients.openWindow("/");
}, false);