<template>
    <v-menu offset-y>
      <template v-slot:activator="{ on }">
        <v-badge>
            <template v-slot:badge>{{ unreadCount }}</template>
            <v-icon v-on="on">mdi-bell</v-icon>
        </v-badge>
      </template>
      <v-list>
        <div v-if="unreadNotification.length > 0">
            <v-list-item v-for="(item, index) in unreadNotification" :key="item.id">
            <v-list-item-title @click="readIt(index, item.id)">
                <router-link :to="{ path: item.link }">{{ item.message }}</router-link>
            </v-list-item-title>
            </v-list-item>
        </div>
        <div v-else>
            <v-list-item>
            <v-list-item-title>
                No notification
            </v-list-item-title>
            </v-list-item>
        </div>
      </v-list>
    </v-menu>
</template>

<script>
export default {
    data() {
        return {
            unreadNotification: [],
            unreadCount: 0,
        }
    },
    computed: {
        userId() {
            return this.$store.getters['auth/userId'];
        }
    },
    created() {
        this.getUnreadNotificaton();

        Echo.private('App.User.' + this.userId)
            .notification((notification) => {
                 this.unreadNotification.unshift({
                            id: notification.id,
                            link: notification.link,
                            message:  notification.message
                        });
                this.unreadCount++;
            });
    },
    methods: {
        getUnreadNotificaton() {
            axios.get('/api/notifications/unread')
                .then(res => {
                    this.unreadCount = res.data.data.unreadCount;

                    let unreadData = res.data.data.unread;
                    for(let i = 0; i < unreadData.length; i++) {
                        this.unreadNotification.push({
                            id: unreadData[i].id,
                            link: unreadData[i].data.link,
                            message:  unreadData[i].data.message
                        });
                    }
                })
                .catch(error => console.log(error))
        },
        readIt(index, notificationId) {
            axios.post(`/api/notifications/read/${notificationId}`)
                .then(res => {
                    this.unreadCount--;
                    this.unreadNotification.splice(index, 1);
                })
                .catch(error => console.log(error))
        }
    }
}
</script>

<style>

</style>