self.addEventListener('push', function(event) {
  const notificationPromise = self.registration.showNotification(myObject.title, options);
  event.waitUntil(notificationPromise);
});

self.addEventListener('notificationclick', function(event) {
  event.notification.close();
  event.waitUntil(
    clients.openWindow(event.notification.notification.data.url)
  );
});
