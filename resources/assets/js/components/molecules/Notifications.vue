<template>
    <div class="dropdown-menu">
        <a class="dropdown-item" :href="'/' + notification.data.follower.username" v-for="(notification, index) in notifications" :key="index">
            @{{ notification.data.follower.username }} te ha seguido!
        </a>
    </div>
</template>

<script>
/* JavaScript dependencies */
import Axios from 'axios';
import Echo from 'laravel-echo';

export default {
    name: 'Notifications',
    props: {
        user: {
            type: Object,
            default() {
                return {};
            },
        },
    },
    data() {
        return {
            notifications: [],
        };
    },
    mounted() {
        Axios.get('/api/notifications').then((response) => {
            this.notifications = response.data;

            Echo.private(`App.User.${this.user}`).notification((notification) => {
                this.notifications.unshift(notification);
            });
        });
    },
};
</script>
