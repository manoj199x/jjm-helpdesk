
// importScripts('https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js');
// importScripts('https://www.gstatic.com/firebasejs/10.7.1/firebase-messaging.js');
importScripts('https://www.gstatic.com/firebasejs/10.7.1/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/10.7.1/firebase-messaging-compat.js');

// Firebase config (use the same config as in your main script)
const firebaseConfig = {
    apiKey: "AIzaSyCeuXJMiUhw7e1SzKEx5T1z6CvtVlPvlqY",
    authDomain: "jjm-helpdesk.firebaseapp.com",
    projectId: "jjm-helpdesk",
    storageBucket: "jjm-helpdesk.firebasestorage.app",
    messagingSenderId: "805756792625",
    appId: "1:805756792625:web:7a00e1aaef170178a98a10",
    measurementId: "G-HKESWYDY2M"
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);

// Initialize Messaging
const messaging = firebase.messaging();

// Handle background messages
messaging.onBackgroundMessage(function(payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);

    // Show a notification
    self.registration.showNotification(payload.notification.title, {
        body: payload.notification.body,
        icon: payload.notification.icon,
        data: { url: payload.notification.click_action },
    });
});

// Handle notification click
self.addEventListener('notificationclick', function(event) {
    event.notification.close();
    event.waitUntil(
        clients.openWindow(event.notification.data.url)
    );
});