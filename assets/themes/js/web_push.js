var WebPush = {};
WebPush.applicationServerPublicKey = 'BO0Uv8pCHCP-8Hr21SQXToo-HZJ93pFT0ZSDXUkHaLC8igENvH-XFxY1BPf2MhXn1faIIdUEsKbr4ywqWcZTtw8';
WebPush.options = {};
WebPush.subscription = '';
WebPush.subscribed = false;
WebPush.subscribe = function() {
    if (Notification.permission === 'denied') {
        return;
    }

    navigator.serviceWorker.ready.then(function (serviceWorkerRegistration) {
        serviceWorkerRegistration.pushManager.getSubscription()
            .then(function(subscription) {
                if (subscription) {
                    WebPush.subscribed = true;
                    WebPush.subscription = JSON.stringify(subscription);

                    if (typeof WebPush.options.subscribe === "function" && WebPush.subscribed) {
                        WebPush.options.subscribe();
                    }
                }
            })
            .catch(function(err) {
                console.warn('Error during getSubscription()', err);
            });

        serviceWorkerRegistration.pushManager.subscribe({
            userVisibleOnly: true,
            applicationServerKey: urlB64ToUint8Array(WebPush.applicationServerPublicKey)
        }).then(function (subscription) {
            WebPush.subscription = JSON.stringify(subscription);
            if (typeof WebPush.options.subscribe === "function" && !WebPush.subscribed) {
                // if (typeof WebPush.options.subscribe === "function") {
                WebPush.options.subscribe();
            }
        }).catch(function (e) {
            if (Notification.permission === 'denied') {
                if (typeof WebPush.options.denied === "function") {
                    WebPush.options.denied();
                }
                console.warn('Permission for Notifications was denied');
            } else {
                console.error('Unable to subscribe to push.', e);
            }
        });
    });
};
WebPush.unsubscribe = function() {
    if (Notification.permission === 'denied') {
        return;
    }

    navigator.serviceWorker.ready.then(function(serviceWorkerRegistration) {
        serviceWorkerRegistration.pushManager.getSubscription().then(
            function(pushSubscription) {
                if (!pushSubscription) {
                    return;
                }

                var subscriptionId = pushSubscription.subscriptionId;
                pushSubscription.unsubscribe().then(function(successful) {
                    if (typeof WebPush.options.unsubscribe === "function") {
                        WebPush.options.unsubscribe();
                        WebPush.subscribed = false;
                    }
                }).catch(function(e) {
                    console.log('Unsubscription error: ', e);
                });
            }).catch(function(e) {
            console.error('Error thrown while unsubscribing from push messaging.', e);
        });
    });
};
WebPush.initialiseState = function() {
    if (!('showNotification' in ServiceWorkerRegistration.prototype)) {
        if (typeof WebPush.options.notSupport === "function") {
            WebPush.options.notSupport();
        }

        console.warn('Notifications aren\'t supported.');
        return;
    }

    if (Notification.permission === 'denied') {
        console.warn('The user has blocked notifications.');
        return;
    }

    if (!('PushManager' in window)) {
        if (typeof WebPush.options.notSupport === "function") {
            WebPush.options.notSupport();
        }

        console.warn('Push messaging isn\'t supported.');
        return;
    }
};
WebPush.init = function(options) {
    WebPush.options = options;

    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/service-worker.js')
            .then(WebPush.initialiseState);
    } else {
        if (typeof WebPush.options.notSupport === "function") {
            WebPush.options.notSupport();
        }

        console.warn('Service workers aren\'t supported in this browser.');
    }
};
WebPush.isSupport = function() {
    if ('serviceWorker' in navigator && 'showNotification' in ServiceWorkerRegistration.prototype) {
        return true;
    }

    return false;
}

function urlB64ToUint8Array(base64String) {
    var padding = '='.repeat((4 - base64String.length % 4) % 4);
    var base64 = (base64String + padding)
        .replace(/\-/g, '+')
        .replace(/_/g, '/');

    var rawData = window.atob(base64);
    var outputArray = new Uint8Array(rawData.length);

    for (var i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
}