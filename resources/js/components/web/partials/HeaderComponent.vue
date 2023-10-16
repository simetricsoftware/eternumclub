<template>
    <div>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-custom">
        <div class="d-flex" style="align-items: center;">
          <router-link class="ml-2 navbar-brand" :to="{ name: 'home' }">
            <img width="100px;" src="/images/simetric.png">
          </router-link>
        </div>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarsExampleDefault"
          aria-controls="navbarsExampleDefault"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
  
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <router-link class="nav-linked" :to="{ name: 'posts' }">Eventos</router-link>
            </li>
            <li class="nav-item" v-if="user?.role.name === 'organizer'">
              <a class="nav-link" href="/dashboard/posts">Panel de eventos</a>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto">
            <search-component></search-component>
            <div v-if="user">
              <li class="nav-item dropdown">
                <a
                  id="navbarDropdown"
                  class="nav-link dropdown-toggle"
                  href="#"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
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
                <a class="nav-linked" href="/login">Iniciar sesión</a>
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
.nav-item {
  font-size: 20px; /* Tamaño de fuente deseado */
  
  /* Puedes ajustar otros estilos como color, margen, relleno, etc. según tus preferencias */
}

.nav-linked {
  text-decoration: none; /* Quitar decoración */
  font-size: 20px; /* Tamaño de fuente de 20px */
  color: #01c4e7; /* Color azul (#01c4e7) */
  font-weight: bold; /* Negrita */
}

/* Para cambiar el tamaño de fuente de los elementos de la barra de navegación desplegable, si es necesario */
.dropdown-item {
  font-size: 16px; /* Tamaño de fuente deseado para elementos desplegables */
}

.bg-custom{
background-color:#000000;
}
</style>

