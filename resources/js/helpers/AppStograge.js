class AppStorage {
    storeToken(token) {
        localStorage.setItem('token', token);
    }

    store(token) {
        this.storeToken(token);
    }

    getToken() {
        return localStorage.getItem('token');
    }

    clear() {
        localStorage.removeItem('token');
    }
}

export default new AppStorage()