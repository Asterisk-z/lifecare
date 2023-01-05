<template>
    <div class="side-bar">
        <ul>
            <li class="side-bar-logo">
                <a href="#" @click="dashboard">
                    <img :src="publicPath+'/uploads/logo/'+appLogo" alt="">
                </a>
            </li>
            <li :class="{'active-side-bar': route == '/dashboard'}">
                <a href="#" @click="dashboard">
                    <i class="la la-desktop la-3x"></i>
                    <div>{{ trans('lang.dashboard') }}</div>
                </a>
            </li>
            <li :class="{'active-side-bar': route == '/appointment'}">
                <a href="#" @click="dashboard">
                    <i class="la la-desktop la-3x"></i>
                    <div>{{ "Appointments" }}</div>
                </a>
            </li>
            <li :class="{'active-side-bar': route == '/chat'}">
                <a href="#" @click="dashboard">
                    <i class="la la-desktop la-3x"></i>
                    <div>{{ "Chats" }}</div>
                </a>
            </li>
            <li :class="{'active-side-bar': route == '/payment'}">
                <a href="#" @click="dashboard">
                    <i class="la la-desktop la-3x"></i>
                    <div>{{ "Payments" }}</div>
                </a>
            </li>
            <li :class="{'active-side-bar': route == '/prescription'}">
                <a href="#" @click="dashboard">
                    <i class="la la-desktop la-3x"></i>
                    <div>{{ "Prescription" }}</div>
                </a>
            </li>
            <li :class="{'active-side-bar': route == '/feedback'}">
                <a href="#" @click="dashboard">
                    <i class="la la-desktop la-3x"></i>
                    <div>{{ "Feedback" }}</div>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
    import axiosGetPost from '../../helper/axiosGetPostCommon';

    export default {
        extends: axiosGetPost,
        props: ['route'],
        methods: {
            dashboard() {
                let instance = this;
                instance.redirect("/dashboard");
            }
        }
    }
</script>