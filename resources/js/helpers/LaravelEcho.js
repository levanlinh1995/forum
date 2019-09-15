/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
import Echo from 'laravel-echo';
window.Pusher = require('pusher-js');

class LaravelEcho {
    init(token = '') {
        return new Echo({
            broadcaster: 'pusher',
            key: '53a91dcc794a3f63fcce',
            cluster: 'ap1',
            encrypted: true,
            auth: {
                headers: {
                    Authorization: `Bearer ${token}`,
                }
            }
        });
    }
}

export default new LaravelEcho();