<template>
<div>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="d-flex" style="align-items: center;">
            <img width="48px;" src="images/eternum_ico.png">
            <router-link class="ml-2 navbar-brand" :to="{ name: 'home'}">Eternum Club</router-link>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'posts' }">Eventos</router-link>
                </li>
                <li class="nav-item" v-if="user?.role.name === 'organizer'">
                    <a class="nav-link" href="/dashboard/posts">Panel de eventos</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <search-component></search-component>
                <div v-if="user">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ user.name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#" @click="logout">
                                Cerrar sesión
                            </a>

                            <form id="logout-form" action="logout" method="POST" style="display: none;">
                                <input type="hidden" name="_token" :value="token">
                            </form>
                        </div>
                    </li>
                </div>
                <div class="d-flex" v-else>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Iniciar sesión</a>
                    </li>
                </div>
            </ul>
        </div>
    </nav>
</div>
</template>

<script>
import SearchComponent from './SearchComponent'
import { mapState } from 'vuex'
export default {
    components: { SearchComponent },
    computed: {
        ...mapState([
            'user'
        ])
    },
    data() {
        return {
            token: ''
        }
    },
    methods:{
        logout() {
            document.getElementById('logout-form').submit();
        }
    },
    mounted(){
        this.token = $('meta[name="csrf-token"]').attr('content')
    }
}
</script>

<style lang="css" scoped>
</style>
