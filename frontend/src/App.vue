<template>
  <div id="app">
    <img src="https://cdn.prod.website-files.com/5f9bca5bacf2ceed0506484d/5fa00e9b9031c60c8ad9cc48_Logo.svg" loading="lazy" alt="" class="logo">
    <h1>Кельник Студиос</h1>
    <nav>
      <router-link to="/">Статьи</router-link> |
      <router-link to="/article/new">Новая статья</router-link>
    </nav>
    <router-view />
  </div>
</template>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  max-width: 1200px;
  margin: 0 auto;
  padding: 2rem;
}

nav {
  margin-bottom: 2rem;
  padding-bottom: 1rem;
  border-bottom: 1px solid #eee;
}

nav a {
  color: #2c3e50;
  text-decoration: none;
  margin-right: 1rem;
}

nav a.router-link-exact-active {
  color: #4CAF50;
  font-weight: bold;
}
</style>
