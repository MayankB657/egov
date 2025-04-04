self.addEventListener("push", (event) => {
    notification = event.data.json();
    event.waitUntil(self.registration.showNotification(notification.title , {
        body: notification.body,
        icon: "../images/logo.svg",
        data: {
            notifURL: notification.url
        }
    }));
});

self.addEventListener("notificationclick",  (event) => {
    event.waitUntil(clients.openWindow(event.notification.data.notifURL));
});
