<!doctype html>
<html lang="en">

<head>
    @include('layouts.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
     data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
@include('layouts.sidebar')
<!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
        <!--  Header Start -->
    @include('layouts.navbar')
    <!--  Header End -->
        {{--        <div class="container-fluid">--}}
        {{--            <div class="card">--}}
        {{--                <div class="card-body">--}}
        {{--                    <h5 class="card-title fw-semibold mb-4">Sample Page</h5>--}}
        {{--                    <p class="mb-0">This is a sample page </p>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        @yield('main-body')
    </div>
    <!-- Notification Permission Popup -->
    <div id="notification-popup" style="display: none; position: fixed; top: 30%; left: 50%; transform: translate(-50%, -50%);
    background: grey; color:white; padding: 50px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center; z-index: 1000;">
        <p>Enable notifications to receive important updates.</p>
        <button id="allow-notifications" style="background: green; color: white; padding: 8px 12px; border: none; cursor: pointer; margin:10px">Allow</button>
        <button id="deny-notifications" style="background: red; color: white; padding: 8px 12px; border: none; cursor: pointer;">Deny</button>
    </div>
</div>
@include('layouts.script')
</body>
<script type="module">
    // Import Firebase modules
    import {initializeApp} from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
    import {getMessaging, getToken, onMessage} from "https://www.gstatic.com/firebasejs/10.7.1/firebase-messaging.js";

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
    const app = initializeApp(firebaseConfig);
    const messaging = getMessaging(app);

    // firebase.initializeApp(firebaseConfig);
    // const messaging = firebase.messaging();

    // ✅ Register the service worker
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/firebase-messaging-sw.js')
            .then(registration => {
                console.log("Service Worker registered:", registration);
            })
            .catch(error => {
                console.error("Service Worker registration failed:", error);
            });
    }
    const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : null;
    // Request permission for notifications
    function requestPermission() {
        console.log("request permission");
        Notification.requestPermission().then(permission => {
            if (permission === "granted") {
                getToken(messaging, {vapidKey: "BEZc8UGo5KayhH9V-duLp5dVy0WOOLj33ONdZsmBXDmRa4ZMQrNEJUZk5SmXqHbNZjcH_A7vPUmqAoIt2_zr-2g"}).then(token => {
                   console.log(token);
                    fetch('/update-fcm-token', {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": csrfToken || ""
                        },
                        body: JSON.stringify({fcm_token: token})
                    })
                        .then(response => response.json())
                        .then(data => {
                            console.log("✅ Token saved successfully:", data);
                            sessionStorage.setItem('fcm_token', token); // Save in sessionStorage for quick access
                        })
                        .catch(error => console.error("❌ Error saving token:", error));;
                });
            }
        });
    }

    // Listen for incoming messages
    // Listen for incoming messages
    onMessage(messaging, (payload) => {
        console.log("Foreground message received:", payload);

        new Notification(payload.data.title, {
            body: payload.data.body,
            icon: payload.data.icon
        });
    });
    function checkNotificationStatus() {
        if (Notification.permission === "denied") {
            alert("You've blocked notifications! To enable them, go to Chrome Settings > Privacy and Security > Site Settings > Notifications.");
        }
    }

    // Show popup for notification permission
    window.onload = function () {
        const popup = document.getElementById('notification-popup');
        if (Notification.permission !== "granted") {
            popup.style.display = 'block';
        }

        if (Notification.permission === "default") {
            popup.style.display = 'block';
        } else if (Notification.permission === "denied") {
            checkNotificationStatus();
        }

        document.getElementById('allow-notifications').addEventListener('click', function () {
            popup.style.display = 'none';
            requestPermission();
        });

        document.getElementById('deny-notifications').addEventListener('click', function () {
            popup.style.display = 'none';
        });
    };
    // requestPermission();
</script>


</html>