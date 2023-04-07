import './bootstrap';

import { createApp } from 'vue';

import Posts from './components/Posts.vue';
import To_Do_List from './components/To_Do_List.vue';

import axios, * as others from 'axios';

window.axios = axios;

const form = document.querySelector("form");

const app = createApp({});

app.component('posts',Posts);

app.component('to_do_list',To_Do_List);

app.mount("#app");